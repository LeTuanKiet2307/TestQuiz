@extends('layouts.app')

@section('title', 'Register Explorer License | AbyssalMind')

@section('content')
<div class="container" style="max-width: 500px; margin-top: 2.5rem;">
    <div class="bento-card">
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <div style="font-size: 2.5rem;">🤿</div>
            <h1 style="font-size: 1.65rem;">Register Explorer Account</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Track your ocean quiz scores & global ranking</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239,68,68,0.15); border: 1px solid #ef4444; color: #fca5a5; padding: 0.85rem; border-radius: 10px; margin-bottom: 1.2rem; font-size: 0.9rem;">
                <ul style="padding-left: 1.1rem;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.1rem;">
            @csrf
            <div>
                <label style="display:block; margin-bottom:0.4rem; font-weight:600; font-size:0.9rem;">Explorer Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. Jacques Piccard" required>
            </div>

            <div>
                <label style="display:block; margin-bottom:0.4rem; font-weight:600; font-size:0.9rem;">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="diver@ocean.io" required>
            </div>

            <div>
                <label style="display:block; margin-bottom:0.4rem; font-weight:600; font-size:0.9rem;">Password (Min 6 chars)</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div>
                <label style="display:block; margin-bottom:0.4rem; font-weight:600; font-size:0.9rem;">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;">
                ⚡ Create Explorer Account
            </button>
        </form>
    </div>
</div>
@endsection