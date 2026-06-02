@extends('layouts.app')

@section('title', 'Login Siswa - Laboratorium Islamic Technology-Labitech')

@section('extra-css')
<style>
    body {
        background-color: #f4f6f9;
    }
    .login-wrapper {
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
    }
    
    .login-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        background: white;
    }

    .login-image-side {
        background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
        color: var(--dark-blue);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 3rem;
        height: 100%;
    }

    .login-image-side img {
        width: 110px;
        margin-bottom: 1.5rem;
    }
    
    .login-body {
        padding: 3rem;
    }
    
    .form-floating > .form-control {
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }
    
    .form-floating > .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.25rem rgba(0, 102, 204, 0.15);
    }
    
    .btn-login {
        padding: 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        background: var(--primary-blue);
        border: none;
        margin-top: 1rem;
    }
    
    .btn-login:hover {
        background: var(--dark-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
    }

    .register-link {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
    }

    .register-link:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="container login-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card login-card">
                <div class="row g-0">
                    <!-- Kolom Branding Kiri -->
                    <div class="col-lg-6 d-none d-lg-block login-image-side">
                        <i class="fas fa-graduation-cap" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.8;"></i>
                        <h4 class="fw-bold" style="color: var(--dark-blue);"><i class="fas fa-school me-2"></i>Portal Siswa</h4>
                        <p class="text-dark small mt-2"><i class="fas fa-graduation-cap me-2"></i>Lihat informasi akademik dan status kelulusan Anda.</p>
                    </div>

                    <!-- Kolom Form Kanan -->
                    <div class="col-lg-6">
                        <div class="login-body">
                            <div class="text-center text-lg-start mb-4">
                                <h4 class="fw-bold"><i class="fas fa-sign-in-alt me-2"></i>Login Siswa</h4>
                                <p class="text-muted"><i class="fas fa-id-card me-2"></i>Gunakan NISN Anda untuk login</p>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <strong>Login Gagal!</strong>
                                    @foreach ($errors->all() as $error)
                                        <div class="mt-2">{{ $error }}</div>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('student.login.submit') }}">
                                @csrf

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" placeholder="NISN" value="{{ old('nisn') }}" required autocomplete="off" autofocus>
                                    <label for="nisn"><i class="fas fa-id-card me-2"></i>NISN (10 digit)</label>
                                    @error('nisn')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label text-secondary small" for="remember">
                                            Ingat Saya
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-login">
                                        <i class="fas fa-sign-in-alt me-2"></i> MASUK
                                    </button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <div class="text-center">
                                <p class="text-muted mb-0">Belum punya akun? 
                                    <a href="{{ route('student.register') }}" class="register-link">
                                        Daftar sekarang
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-decoration-none text-muted small">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
