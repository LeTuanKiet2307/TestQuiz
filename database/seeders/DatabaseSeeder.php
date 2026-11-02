<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\QuizSet;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo tài khoản Admin & Normal Users
        $admin = User::updateOrCreate(
            ['email' => 'admin@ocean.io'],
            [
                'name' => 'Captain Nemo (Admin)',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'total_score' => 14500,
                'quizzes_completed' => 4,
            ]
        );

        $user1 = User::updateOrCreate(
            ['email' => 'explorer@ocean.io'],
            [
                'name' => 'Sylvia Earle',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'total_score' => 18200,
                'quizzes_completed' => 5,
            ]
        );

        User::updateOrCreate(
            ['email' => 'cousteau@ocean.io'],
            [
                'name' => 'Jacques Cousteau',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'total_score' => 15900,
                'quizzes_completed' => 4,
            ]
        );

        // 2. Tạo Bộ Đề #1: Mariana Trench & Hadal Zone
        $set1 = QuizSet::create([
            'title' => 'The Mariana Trench & Hadalpelagic Secrets',
            'topic' => 'Mariana Trench',
            'ocean_zone' => 'Hadalpelagic Zone (6,000m - 11,000m)',
            'source_url' => 'https://en.wikipedia.org/wiki/Mariana_Trench',
            'is_active' => true,
            'created_by' => $admin->id,
            'reading_passage' => "The Mariana Trench is an oceanic trench located in the western Pacific Ocean, about 200 kilometres (124 mi) east of the Mariana Islands; it is the deepest oceanic trench on Earth. It is crescent-shaped and measures about 2,550 km (1,580 mi) in length and 69 km (43 mi) in width.\n\nThe maximum known depth is 10,984 ± 25 metres (36,037 ± 82 ft; 6.825 ± 0.016 mi) at the southern end of a small slot-shaped valley in its floor known as the Challenger Deep. At the bottom of the trench, the water column above exerts a pressure of 1,086 bar (15,750 psi), more than 1,071 times the standard atmospheric pressure at sea level. At this pressure, the density of water is increased by 4.96%. The temperature at the bottom is 1 to 4 °C (34 to 39 °F).\n\nDespite these extreme conditions, life thrives in the Challenger Deep. Expeditions have discovered xenophyophores (giant single-celled organisms), amphipods, holothurians (sea cucumbers), and the Mariana snailfish (Pseudoliparis swirei), which holds the record for the deepest-living fish species ever captured at around 8,000 meters, as fish cells cannot stabilize proteins using TMAO (trimethylamine N-oxide) below roughly 8,400 meters.",
        ]);

        $questionsSet1 = [
            [
                'question_text' => 'What is the name of the deepest known point within the Mariana Trench?',
                'options' => ['Horizon Deep', 'Challenger Deep', 'Sirena Deep', 'Tonga Trench'],
                'correct_option_index' => 1,
                'explanation' => 'Challenger Deep, located at the southern end of the Mariana Trench, reaches a maximum known depth of approximately 10,984 meters.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'Approximately how many times greater is the pressure at the bottom of the Mariana Trench compared to standard sea-level atmospheric pressure?',
                'options' => ['About 100 times', 'About 500 times', 'More than 1,070 times', 'Over 10,000 times'],
                'correct_option_index' => 2,
                'explanation' => 'The water column exerts a pressure of 1,086 bar, which is more than 1,071 times standard atmospheric pressure.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'What is the ambient water temperature at the bottom of the Mariana Trench?',
                'options' => ['-15 to -5 °C', '1 to 4 °C', '15 to 20 °C', '0 °C (Frozen Solid)'],
                'correct_option_index' => 1,
                'explanation' => 'Despite extreme depths without sunlight, hydrothermal activity and deep ocean physics keep the water temperature between 1 and 4 °C.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'Which organism holds the record as one of the deepest-living fish species found in the Mariana Trench at around 8,000m?',
                'options' => ['Coelacanth', 'Mariana Snailfish', 'Vampire Squid', 'Goblin Shark'],
                'correct_option_index' => 1,
                'explanation' => 'The Mariana snailfish (Pseudoliparis swirei) thrives around 8,000 meters depth.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'Why are bony fish physiologically unable to survive below approximately 8,400 meters?',
                'options' => [
                    'There is zero dissolved oxygen below 8,400m',
                    'Their cellular TMAO molecules can no longer stabilize proteins against extreme pressure',
                    'Water density increases by 50%, preventing swimming',
                    'The water reaches boiling point everywhere below 8,400m'
                ],
                'correct_option_index' => 1,
                'explanation' => 'Fish use TMAO (trimethylamine N-oxide) to keep proteins from collapsing under pressure, which hits a biological threshold around 8,400 meters.',
                'time_limit' => 20,
            ],
        ];

        foreach ($questionsSet1 as $q) {
            Question::create(array_merge($q, ['quiz_set_id' => $set1->id]));
        }

        // 3. Tạo Bộ Đề #2: Bioluminescence & The Twilight/Midnight Zones
        $set2 = QuizSet::create([
            'title' => 'Bioluminescence in the Mesopelagic & Bathypelagic Zones',
            'topic' => 'Bioluminescence',
            'ocean_zone' => 'Bathypelagic Zone (1,000m - 4,000m)',
            'source_url' => 'https://en.wikipedia.org/wiki/Bioluminescence',
            'is_active' => true,
            'created_by' => $admin->id,
            'reading_passage' => "Bioluminescence is the production and emission of light by a living organism. It is a form of chemiluminescence that occurs widely in marine vertebrates and invertebrates. In the ocean's Mesopelagic (Twilight, 200m–1000m) and Bathypelagic (Midnight, 1000m–4000m) zones, researchers estimate that over 76% of marine animals are capable of producing their own light.\n\nThe chemical reaction that creates bioluminescence requires two primary chemicals: a light-emitting molecule called luciferin and an enzyme catalyst called luciferase. When luciferin reacts with oxygen in the presence of luciferase, oxyluciferin is formed and energy is released in the form of cold light (meaning less than 20% of the light generates thermal radiation).\n\nMost marine light-emission is in the blue and green light spectrum, with wavelengths between 440 and 490 nanometers. These wavelengths travel farthest through seawater. However, certain dragonfish in the genus Malacosteus (stoplight loosejaw) have evolved the rare ability to emit red and infrared bioluminescence, allowing them to illuminate prey that cannot perceive red light in the deep sea.",
        ]);

        $questionsSet2 = [
            [
                'question_text' => 'Which two primary biochemical components are required for most marine bioluminescence reactions?',
                'options' => [
                    'Chlorophyll and Carotene',
                    'Luciferin and Luciferase',
                    'Hemoglobin and Melanin',
                    'Collagen and Keratin'
                ],
                'correct_option_index' => 1,
                'explanation' => 'The substrate luciferin is oxidized in the presence of the catalytic enzyme luciferase to emit light.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'Why is most marine bioluminescence concentrated in the blue-green spectrum (440–490 nm)?',
                'options' => [
                    'Blue-green wavelengths transmit farthest through seawater',
                    'Marine organisms lack genes for any other pigments',
                    'Blue light heats up the surrounding freezing water',
                    'Predators are completely blind to blue light'
                ],
                'correct_option_index' => 0,
                'explanation' => 'Water absorbs longer wavelengths (like red and orange) quickly, whereas blue-green wavelengths penetrate deepest and travel farthest.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'Why is bioluminescence often referred to as "cold light"?',
                'options' => [
                    'It only functions in water below 4 °C',
                    'Less than 20% of the emitted light generates thermal radiation (heat)',
                    'It freezes water molecules upon contact',
                    'It requires ice crystals to reflect'
                ],
                'correct_option_index' => 1,
                'explanation' => 'Bioluminescence is highly efficient chemiluminescence; less than 20% of the energy is wasted as heat.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'Which deep-sea predator possesses the rare evolutionary ability to emit red bioluminescence as a secret sniper scope?',
                'options' => [
                    'Blue Whale',
                    'Stoplight Loosejaw (Malacosteus dragonfish)',
                    'Clownfish',
                    'Portuguese Man o\' War'
                ],
                'correct_option_index' => 1,
                'explanation' => 'Dragonfish in the genus Malacosteus produce red light to spot prey that cannot see red wavelengths.',
                'time_limit' => 20,
            ],
            [
                'question_text' => 'Roughly what percentage of marine animals in the water column are estimated to be bioluminescent?',
                'options' => ['Less than 5%', 'Around 25%', 'Over 76%', 'Exactly 100%'],
                'correct_option_index' => 2,
                'explanation' => 'Studies by MBARI found that roughly 76% of macroscopic organisms observed in the deep water column produce light.',
                'time_limit' => 20,
            ],
        ];

        foreach ($questionsSet2 as $q) {
            Question::create(array_merge($q, ['quiz_set_id' => $set2->id]));
        }
    }
}