@extends('layouts.app')

@section('title', 'Logout - Labitech')

@section('extra-css')
<style>
    body {
        background: linear-gradient(135deg, #0a1628 0%, #0d2b5e 50%, #0a1628 100%);
        min-height: 100vh;
    }
    .logout-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .logout-card {
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 3rem;
        width: 100%;
        max-width: 420px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.4);
        text-align: center;
    }
    .logout-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    .logout-title {
        color: #ffffff;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .logout-subtitle {
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }
    .btn-home {
        background: linear-gradient(135deg, #1a6fff 0%, #0052cc 100%);
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        width: 100%;
        margin-bottom: 0.75rem;
        transition: all 0.2s;
        display: block;
        text-decoration: none;
    }
    .btn-home:hover {
        background: linear-gradient(135deg, #3d7fff 0%, #1a6fff 100%);
        transform: translateY(-1px);
        color: white;
    }
    .btn-login {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 10px;
        color: rgba(255,255,255,0.8);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        width: 100%;
        transition: all 0.2s;
        display: block;
        text-decoration: none;
    }
    .btn-login:hover {
        background: rgba(255,255,255,0.15);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container logout-wrapper">
    <div class="row justify-content-center w-100">
        <div class="col-12 d-flex justify-content-center">
            <div class="logout-card">
                <div class="logout-icon">
                    <i class="fas fa-check" style="color: #4d94ff; font-size: 1.8rem;"></i>
                </div>
                <p class="logout-title">Berhasil Logout</p>
                <p class="logout-subtitle">Anda telah keluar dari portal administrator.</p>

                <a href="{{ route('home') }}" class="btn-home">
                    <i class="fas fa-home me-2"></i> Kembali ke Halaman Utama
                </a>
                <a href="{{ route('login') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login Lagi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
