@extends('layouts.app')

@section('title', 'Explorer Bento Dashboard | AbyssalMind')

@section('content')
<div class="container">
    <div class="bento-dashboard-grid">

        <!-- LEFT COLUMN: USER PROFILE, STATS, START QUIZ & REVIEW MISTAKES -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="bento-card">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;">
                    <div style="width: 64px; height: 64px; border-radius: 16px; background: linear-gradient(135deg, #00f2fe, #0284c7); display:flex; align-items:center; justify-content:center; font-size: 2rem; color:#021024; font-weight: 800;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <span style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--cyan-glow); font-weight: 700;">
                            {{ $user->isAdmin() ? '👑 Fleet Admiral (Admin)' : '🤿 Deep Sea Explorer' }}
                        </span>
                        <h2 style="font-size: 1.4rem;">{{ $user->name }}</h2>
                        <div style="font-size: 0.88rem; color: var(--text-muted);">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="stat-grid-2">
                    <div class="stat-tile">
                        <div style="font-size: 0.78rem; color: var(--text-muted);">TOTAL SCORE</div>
                        <div class="value">{{ number_format($user->total_score) }}</div>
                    </div>
                    <div class="stat-tile">
                        <div style="font-size: 0.78rem; color: var(--text-muted);">GLOBAL RANK</div>
                        <div class="value">#{{ $globalRank }}</div>
                    </div>
                </div>

                <!-- Prominent Start Quiz Button -->
                <a href="{{ route('quiz.play') }}" class="btn btn-primary" style="width: 100%; padding: 1.05rem; font-size: 1.08rem; margin-bottom: 0.9rem;">
                    🚀 START NEW OCEAN QUIZ
                </a>

                <!-- Targeted Review Mistakes Button -->
                <a href="{{ route('quiz.mistakes') }}" class="btn btn-warning" style="width: 100%; padding: 0.9rem;">
                    🎯 Review Mistakes ({{ $mistakeCount }} in last 5 dives)
                </a>
            </div>

            <div class="bento-card" style="background: rgba(14, 165, 233, 0.08);">
                <h3 style="font-size: 1.05rem; margin-bottom: 0.5rem;">⚡ Speed Scoring Mechanics</h3>
                <p style="font-size: 0.88rem; color: var(--text-muted);">
                    Each quiz begins with a <strong>3-minute Reading Phase</strong> followed by a high-focus <strong>Kahoot Quiz Phase</strong>. Faster correct answers earn up to <strong>1,000 points</strong> per question!
                </p>
            </div>
        </div>

        <!-- RIGHT COLUMN: LAST 5 QUIZ ATTEMPTS (COLLAPSIBLE BREAKDOWN CARDS) -->
        <div class="bento-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <div>
                    <h2 style="font-size: 1.45rem;">📜 Recent 5 Expedition Logs</h2>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Click any attempt card below to inspect question-by-question telemetry</p>
                </div>
                <span class="zone-depth-pill">Total Dives: {{ $user->quizzes_completed }}</span>
            </div>

            @forelse($recentAttempts as $index => $attempt)
                <details class="attempt-collapse" {{ $index === 0 ? 'open' : '' }}>
                    <summary>
                        <div>
                            <div style="font-size: 1.05rem; color: var(--cyan-glow);">
                                {{ $attempt->quizSet->title ?? 'Ocean Expedition Set' }}
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 400; margin-top: 0.2rem;">
                                🕒 {{ $attempt->created_at->diffForHumans() }} • 🌊 {{ $attempt->quizSet->ocean_zone ?? 'Deep Ocean' }}
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-family: 'JetBrains Mono', monospace; font-size: 1.15rem; color: #4ade80;">
                                +{{ number_format($attempt->score) }} pts
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">
                                {{ $attempt->correct_count }}/{{ $attempt->total_questions }} Correct ▾
                            </div>
                        </div>
                    </summary>

                    <div class="attempt-breakdown">
                        @foreach($attempt->answers as $ans)
                            @php
                                $q = $ans->question;
                                $options = $q ? $q->options : [];
                                $userChoiceText = ($ans->selected_option_index !== null && isset($options[$ans->selected_option_index]))
                                    ? $options[$ans->selected_option_index]
                                    : '⏱️ Timed Out / No Answer';
                                $correctChoiceText = ($q && isset($options[$q->correct_option_index]))
                                    ? $options[$q->correct_option_index]
                                    : 'N/A';
                            @endphp
                            <div class="breakdown-item {{ $ans->is_correct ? '' : 'wrong' }}">
                                <div style="display:flex; justify-content:space-between; gap:1rem; font-weight:600; font-size:0.95rem;">
                                    <span>{{ $q->question_text ?? 'Deleted Question' }}</span>
                                    <span style="font-family:'JetBrains Mono',monospace; white-space:nowrap; color: {{ $ans->is_correct ? '#4ade80' : '#f87171' }};">
                                        {{ $ans->is_correct ? '+' . $ans->points_earned . ' pts' : '0 pts' }} ({{ number_format($ans->time_taken, 1) }}s)
                                    </span>
                                </div>
                                <div style="font-size: 0.85rem; margin-top: 0.45rem; color: #cbd5e1;">
                                    <span>Your Answer: <strong style="color: {{ $ans->is_correct ? '#4ade80' : '#fca5a5' }}">{{ $userChoiceText }}</strong></span>
                                    @if(!$ans->is_correct)
                                        <span style="margin-left: 1rem;">| Correct Answer: <strong style="color: #4ade80;">{{ $correctChoiceText }}</strong></span>
                                    @endif
                                </div>
                                @if($q && $q->explanation)
                                    <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.35rem; font-style: italic;">
                                        💡 {{ $q->explanation }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </details>
            @empty
                <div style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 0.75rem;">🌊</div>
                    <p>You haven't completed any ocean dives yet.</p>
                    <a href="{{ route('quiz.play') }}" class="btn btn-primary" style="margin-top: 1rem;">Start Your First Quiz</a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection