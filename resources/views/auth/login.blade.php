@extends('layouts.app')

@section('title', 'Login Administrator - Labitech')

@section('extra-css')
<style>
    body {
        background: linear-gradient(135deg, #0a1628 0%, #0d2b5e 50%, #0a1628 100%);
        min-height: 100vh;
    }

    .login-wrapper {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
    }

    .login-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 3rem;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.4);
    }

    .login-logo {
        width: 70px;
        height: 70px;
        object-fit: contain;
    }

    .login-title {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .login-subtitle {
        color: rgba(255,255,255,0.5);
        font-size: 0.85rem;
        margin: 0;
    }

    .form-label {
        color: rgba(255,255,255,0.7);
        font-size: 0.82rem;
        font-weight: 500;
        margin-bottom: 0.4rem;
    }

    .form-control {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 10px;
        color: #ffffff;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .form-control:focus {
        background: rgba(255,255,255,0.12);
        border-color: #4d94ff;
        box-shadow: 0 0 0 3px rgba(77,148,255,0.15);
        color: #ffffff;
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.3);
    }

    .form-check-label {
        color: rgba(255,255,255,0.6);
        font-size: 0.82rem;
    }

    .form-check-input:checked {
        background-color: #4d94ff;
        border-color: #4d94ff;
    }

    .btn-login {
        background: linear-gradient(135deg, #1a6fff 0%, #0052cc 100%);
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.8rem;
        width: 100%;
        letter-spacing: 0.5px;
        transition: all 0.2s;
        margin-top: 0.5rem;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #3d7fff 0%, #1a6fff 100%);
        transform: translateY(-1px);
        box-shadow: 0 8px 20px rgba(26,111,255,0.35);
        color: white;
    }

    .divider {
        border-color: rgba(255,255,255,0.1);
        margin: 1.5rem 0;
    }

    .back-link {
        color: rgba(255,255,255,0.4);
        font-size: 0.8rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: rgba(255,255,255,0.7);
    }

    .alert-danger {
        background: rgba(220,53,69,0.2);
        border: 1px solid rgba(220,53,69,0.3);
        color: #ff6b7a;
        border-radius: 10px;
        font-size: 0.85rem;
    }

    .invalid-feedback {
        color: #ff6b7a;
        font-size: 0.78rem;
    }

    .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #4d94ff;
        display: inline-block;
        margin: 0 3px;
        opacity: 0.6;
    }
    .dot:nth-child(2) { background: #66aaff; opacity: 0.8; }
    .dot:nth-child(3) { background: #99ccff; }
</style>
@endsection

@section('content')
<div class="container login-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-12 d-flex justify-content-center">
            <div class="login-card">

                {{-- Header --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="login-logo mb-3">
                    <p class="login-title">Portal Administrator</p>
                    <p class="login-subtitle">Laboratorium Islamic Technology-Labitech</p>
                    <div class="mt-2">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>

                {{-- Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Username atau Email</label>
                        <input type="text"
                               class="form-control @error('login') is-invalid @enderror"
                               name="login"
                               placeholder="Masukkan username atau email"
                               value="{{ old('login') }}"
                               required autocomplete="off" autofocus>
                        @error('login')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               placeholder="Masukkan password"
                               required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> MASUK
                    </button>
                </form>

                <hr class="divider">

                <div class="text-center">
                    <a href="{{ route('home') }}" class="back-link">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
