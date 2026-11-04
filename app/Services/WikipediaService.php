<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

class WikipediaService
{
    private const API_URL = 'https://vi.wikipedia.org/w/api.php';

    private function query(array $parameters): array
    {
        try {
            $response = Http::acceptJson()->withUserAgent(config('services.wikipedia.user_agent'))
                ->connectTimeout(6)->timeout(20)
                ->retry(3, 300, function (Throwable $e) {
                    if ($e instanceof ConnectionException) {
                        return true;
                    }

                    return $e instanceof RequestException
                        && in_array($e->response?->status(), [429, 500, 502, 503, 504], true);
                }, throw: false)
                ->get(self::API_URL, $parameters + [
                    'action' => 'query', 'format' => 'json', 'formatversion' => 2, 'maxlag' => 5,
                ]);
        } catch (HttpClientException $e) {
            Log::warning('Không gọi được Wikipedia API', ['error' => $e->getMessage()]);

            throw new RuntimeException('Chưa kết nối được Wikipedia. Hãy thử lại hoặc nhập bài thủ công.');
        }

        if ($response->failed()) {
            Log::warning('Wikipedia API trả về HTTP lỗi', ['status' => $response->status(), 'body' => mb_substr($response->body(), 0, 300)]);

            throw new RuntimeException($response->status() === 429
                ? 'Wikipedia đang giới hạn truy cập, vui lòng thử lại sau ít phút.'
                : 'Chưa kết nối được Wikipedia (HTTP '.$response->status().'). Hãy thử lại hoặc nhập bài thủ công.');
        }

        $data = $response->json();
        if (! is_array($data)) {
            Log::warning('Wikipedia API trả về dữ liệu không phải JSON', ['body' => mb_substr($response->body(), 0, 300)]);

            throw new RuntimeException('Wikipedia chưa trả về dữ liệu hợp lệ. Vui lòng thử lại sau.');
        }
        if (isset($data['error'])) {
            $code = $data['error']['code'] ?? 'unknown';
            Log::warning('Wikipedia API báo lỗi', ['code' => $code, 'info' => $data['error']['info'] ?? null]);

            throw new RuntimeException($code === 'maxlag'
                ? 'Wikipedia đang quá tải, vui lòng thử lại sau vài giây.'
                : 'Wikipedia báo lỗi: '.($data['error']['info'] ?? $code));
        }

        return $data;
    }

    public function search(string $keyword): array
    {
        $data = $this->query(['list' => 'search', 'srsearch' => $keyword, 'srnamespace' => 0, 'srlimit' => 10]);

        return array_map(fn ($page) => [
            'id' => (int) $page['pageid'], 'title' => $page['title'],
            'snippet' => html_entity_decode(strip_tags($page['snippet'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        ], $data['query']['search'] ?? []);
    }

    public function article(int $pageId): array
    {
        $data = $this->query(['prop' => 'extracts', 'explaintext' => 1, 'pageids' => $pageId]);
        $page = $data['query']['pages'][0] ?? [];
        if (isset($page['missing']) || empty($page['extract']) || ($page['ns'] ?? 0) !== 0) {
            throw new RuntimeException('Bài này không có nội dung văn bản phù hợp để lưu.');
        }

        return [
            'wiki_page_id' => $pageId, 'title' => mb_substr($page['title'], 0, 200),
            'content' => mb_substr($page['extract'], 0, 100000),
            'source_name' => mb_substr('Wikipedia tiếng Việt · '.$page['title'], 0, 255),
            'source_url' => 'https://vi.wikipedia.org/?curid='.$pageId,
            'license' => 'CC BY-SA · xem giấy phép và lịch sử tác giả tại bài nguồn',
        ];
    }
}
