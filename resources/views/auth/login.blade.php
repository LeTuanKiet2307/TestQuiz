@extends('layouts.app')

@section('title', 'Submarine Crew Login | AbyssalMind')

@section('content')
<div class="container" style="max-width: 480px; margin-top: 3rem;">
    <div class="bento-card">
        <div style="text-align: center; margin-bottom: 1.75rem;">
            <div style="font-size: 2.5rem;">⚓</div>
            <h1 style="font-size: 1.65rem;">Submarine Crew Login</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Demo Admin: <code>admin@ocean.io</code> / <code>password123</code></p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239,68,68,0.15); border: 1px solid #ef4444; color: #fca5a5; padding: 0.85rem; border-radius: 10px; margin-bottom: 1.2rem; font-size: 0.9rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.15rem;">
            @csrf
            <div>
                <label style="display:block; margin-bottom:0.4rem; font-weight:600; font-size:0.9rem;">Email Address</label>
                <input type="email" name="email" value="{{ old('email', 'explorer@ocean.io') }}" class="form-control" required autofocus>
            </div>

            <div>
                <label style="display:block; margin-bottom:0.4rem; font-weight:600; font-size:0.9rem;">Password</label>
                <input type="password" name="password" value="password123" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;">
                🚀 Authenticate & Enter Bridge
            </button>
        </form>

        <p style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-muted);">
            New deep-sea explorer? <a href="{{ route('register') }}" style="color: var(--cyan-glow);">Register here</a>
        </p>
    </div>
</div>
@endsection