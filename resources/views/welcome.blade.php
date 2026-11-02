@extends('layouts.app')

@section('title', 'Explore the Ocean Depths | AbyssalMind')

@section('content')
<div class="ocean-scroll-wrapper" id="oceanWrapper">

    <!-- Sticky Vertical Depth Indicator Bar on the Left -->
    <aside class="depth-sidebar">
        <div class="depth-readout-box">
            <div style="font-size: 0.72rem; color: var(--text-muted); text-transform: uppercase;">Current Sonar Depth</div>
            <div class="depth-meter-number" id="currentDepthDisplay">0m</div>
            <div class="depth-zone-badge" id="currentZoneName">Epipelagic Zone</div>
        </div>

        <ul class="depth-scale-list">
            <li class="depth-scale-item active" data-target="zone-0" onclick="scrollToZone('zone-0')">
                <strong>0m</strong> — Sunlit Zone
            </li>
            <li class="depth-scale-item" data-target="zone-200" onclick="scrollToZone('zone-200')">
                <strong>200m</strong> — Twilight Zone
            </li>
            <li class="depth-scale-item" data-target="zone-1000" onclick="scrollToZone('zone-1000')">
                <strong>1,000m</strong> — Midnight Zone
            </li>
            <li class="depth-scale-item" data-target="zone-4000" onclick="scrollToZone('zone-4000')">
                <strong>4,000m</strong> — Abyssal Zone
            </li>
            <li class="depth-scale-item" data-target="zone-6000" onclick="scrollToZone('zone-6000')">
                <strong>6,000m+</strong> — Hadal Trench
            </li>
        </ul>
    </aside>

    <!-- ZONE 1: 0m SUNLIT ZONE -->
    <section class="ocean-zone-section" id="zone-0" data-depth="0" data-zone="Sunlit Zone (Epipelagic)">
        <div class="zone-card">
            <div class="zone-header">
                <span class="zone-depth-pill">DEPTH: 0m – 200m</span>
                <span style="color: #bae6fd; font-weight: 600;">☀️ Photosynthesis & Coral Reefs</span>
            </div>
            <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">The Sunlit Zone (Epipelagic)</h1>
            <p style="color: #e0f2fe; font-size: 1.08rem;">
                Welcome to the surface layer of the ocean where sunlight penetrates freely, driving photosynthesis in phytoplankton—the microscopic organisms that generate over 50% of Earth's oxygen and support 90% of all marine life.
            </p>
            <div class="creature-showcase">
                <div class="creature-box">
                    <div style="font-size: 2rem;">🐢</div>
                    <strong>Green Sea Turtle</strong>
                    <span style="font-size: 0.85rem; color: #cbd5e1;">Navigates across entire ocean basins using Earth's magnetic field lines.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🐬</div>
                    <strong>Bottlenose Dolphin</strong>
                    <span style="font-size: 0.85rem; color: #cbd5e1;">Uses sophisticated biological echolocation clicks to hunt and communicate.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🦈</div>
                    <strong>Great White Shark</strong>
                    <span style="font-size: 0.85rem; color: #cbd5e1;">Detects electromagnetic fields of prey via Ampullae of Lorenzini.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ZONE 2: 200m TWILIGHT ZONE -->
    <section class="ocean-zone-section" id="zone-200" data-depth="200" data-zone="Twilight Zone (Mesopelagic)">
        <div class="zone-card">
            <div class="zone-header">
                <span class="zone-depth-pill">DEPTH: 200m – 1,000m</span>
                <span style="color: #7dd3fc; font-weight: 600;">🌗 Diel Vertical Migration</span>
            </div>
            <h2 style="font-size: 2.2rem; margin-bottom: 1rem;">The Twilight Zone (Mesopelagic)</h2>
            <p style="color: #cbd5e1; font-size: 1.05rem;">
                Sunlight fades rapidly into a dim blue-green glow insufficient for photosynthesis. Every night, trillions of organisms ascend from this zone to the surface to feed in the largest animal migration on planet Earth.
            </p>
            <div class="creature-showcase">
                <div class="creature-box">
                    <div style="font-size: 2rem;">🦑</div>
                    <strong>Cockatoo Squid</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Nearly transparent glass squid with upward-looking eyes to spot silhouettes.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🐟</div>
                    <strong>Lanternfish (Myctophid)</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Accounts for up to 65% of all deep-sea fish biomass; uses counter-illumination.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🐋</div>
                    <strong>Sperm Whale (Diving)</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Holds its breath for 90 minutes while diving into the twilight zone to hunt squid.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ZONE 3: 1000m MIDNIGHT ZONE -->
    <section class="ocean-zone-section" id="zone-1000" data-depth="1000" data-zone="Midnight Zone (Bathypelagic)">
        <div class="zone-card">
            <div class="zone-header">
                <span class="zone-depth-pill">DEPTH: 1,000m – 4,000m</span>
                <span style="color: #38bdf8; font-weight: 600;">🌌 Eternal Darkness & Bioluminescence</span>
            </div>
            <h2 style="font-size: 2.2rem; margin-bottom: 1rem;">The Midnight Zone (Bathypelagic)</h2>
            <p style="color: #cbd5e1; font-size: 1.05rem;">
                Not a single photon of sunlight reaches 1,000 meters. The only light here is produced biologically through luciferin-luciferase reactions. Crushing pressure exceeds 100 atmospheres, and temperatures hover near 4 °C.
            </p>
            <div class="creature-showcase">
                <div class="creature-box">
                    <div style="font-size: 2rem;">🏮</div>
                    <strong>Deep Sea Anglerfish</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Waves a bioluminescent esca (lure) filled with symbiotic bacteria to attract prey.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🧛</div>
                    <strong>Vampire Squid</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Thrives in oxygen-minimum zones and feeds gently on falling marine snow.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🐉</div>
                    <strong>Stoplight Loosejaw</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Emits covert infrared/red bioluminescence invisible to its deep-sea prey.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ZONE 4: 4000m ABYSSAL ZONE -->
    <section class="ocean-zone-section" id="zone-4000" data-depth="4000" data-zone="Abyssal Zone (Abyssopelagic)">
        <div class="zone-card">
            <div class="zone-header">
                <span class="zone-depth-pill">DEPTH: 4,000m – 6,000m</span>
                <span style="color: #93c5fd; font-weight: 600;">🌋 Hydrothermal Vents & Chemosynthesis</span>
            </div>
            <h2 style="font-size: 2.2rem; margin-bottom: 1rem;">The Abyssal Zone (Abyssopelagic)</h2>
            <p style="color: #cbd5e1; font-size: 1.05rem;">
                Covering over 60% of Earth's surface, the abyssal plains are vast, freezing expanses of sediment. Around volcanic hydrothermal vents ("Black Smokers"), ecosystems run entirely on chemosynthesis rather than sunlight.
            </p>
            <div class="creature-showcase">
                <div class="creature-box">
                    <div style="font-size: 2rem;">🐙</div>
                    <strong>Dumbo Octopus (Grimpoteuthis)</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">The deepest-living octopus, flapping ear-like fins gracefully above the seafloor.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🧪</div>
                    <strong>Giant Tube Worms (Riftia)</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Lacks a digestive tract; relies on bacteria converting toxic hydrogen sulfide.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🔭</div>
                    <strong>Tripod Fish (Bathypterois)</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Stands motionless on the abyssal mud using three elongated fin rays.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ZONE 5: 6000m+ HADAL TRENCH -->
    <section class="ocean-zone-section" id="zone-6000" data-depth="10984" data-zone="Hadal Zone (Mariana Trench)">
        <div class="zone-card" style="border-color: var(--cyan-glow);">
            <div class="zone-header">
                <span class="zone-depth-pill">DEPTH: 6,000m – 10,984m</span>
                <span style="color: var(--cyan-glow); font-weight: 700;">⚓ Challenger Deep Bottom Reached</span>
            </div>
            <h2 style="font-size: 2.2rem; margin-bottom: 1rem;">The Hadalpelagic Zone (Trench Bottom)</h2>
            <p style="color: #cbd5e1; font-size: 1.05rem;">
                You have reached Challenger Deep at 10,984 meters. Pressure here exceeds 1,071 atmospheres—equivalent to 50 jumbo jets stacked on your shoulders. Are you ready to test your mastery of the deep ocean?
            </p>
            <div class="creature-showcase">
                <div class="creature-box">
                    <div style="font-size: 2rem;">🐟</div>
                    <strong>Mariana Snailfish</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Survives down to 8,000m with flexible bones, open skull, and high TMAO levels.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🦐</div>
                    <strong>Supergiant Amphipod</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Uses aluminum hydroxide gel on its exoskeleton to prevent shell dissolution.</span>
                </div>
                <div class="creature-box">
                    <div style="font-size: 2rem;">🦠</div>
                    <strong>Xenophyophores</strong>
                    <span style="font-size: 0.85rem; color: #94a3b8;">Giant single-celled organisms reaching 20 cm across at the bottom of Challenger Deep.</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Bottom Login / Register Bar -->
    <div class="fixed-bottom-auth-bar">
        <div style="display: flex; align-items: center; gap: 0.85rem;">
            <span style="font-size: 1.4rem;">🧭</span>
            <div>
                <div style="font-weight: 700; font-size: 0.95rem;">Ready to Challenge the Ocean Knowledge Arena?</div>
                <div style="font-size: 0.8rem; color: var(--text-muted);">Read scientific passages, compete in Kahoot-style speed rounds & climb the Global Leaderboard.</div>
            </div>
        </div>

        <div style="display: flex; gap: 0.85rem;">
            @auth
                <a href="{{ route('quiz.play') }}" class="btn btn-primary">🚀 Dive Into Quiz Now</a>
                <a href="{{ route('dashboard') }}" class="btn btn-outline">My Bento Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline">🔐 Crew Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">⚡ Register Submarine Pass</a>
            @endauth
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function scrollToZone(id) {
        const el = document.getElementById(id);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth' });
        }
    }

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
        const scrollFraction = maxScroll > 0 ? Math.min(Math.max(scrollTop / maxScroll, 0), 1) : 0;

        // Calculate simulated depth from 0m to 10,984m
        const simulatedMeters = Math.round(scrollFraction * 10984);
        document.getElementById('currentDepthDisplay').textContent = simulatedMeters.toLocaleString() + 'm';

        // Highlight active depth zone on left ruler
        const sections = document.querySelectorAll('.ocean-zone-section');
        const scaleItems = document.querySelectorAll('.depth-scale-item');
        let activeZoneId = 'zone-0';
        let activeZoneTitle = 'Sunlit Zone';

        sections.forEach(sec => {
            const rect = sec.getBoundingClientRect();
            if (rect.top <= window.innerHeight * 0.5) {
                activeZoneId = sec.id;
                activeZoneTitle = sec.getAttribute('data-zone');
            }
        });

        document.getElementById('currentZoneName').textContent = activeZoneTitle;

        scaleItems.forEach(item => {
            if (item.getAttribute('data-target') === activeZoneId) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    });
</script>
@endpush