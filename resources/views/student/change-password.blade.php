@extends('layouts.app')

@section('title', 'Ubah Password - ' . auth('students')->user()->nama)

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Ubah Password</h1>
                <p style="margin-top: 0.5rem; opacity: 0.9;">Perbarui password akun Anda</p>
            </div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 60vh;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Ubah Password</h5>
                    </div>
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('student.update-password') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-bold">Password Lama <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Masukkan password lama" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi password baru" required minlength="6">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-save me-2"></i> Simpan Password Baru
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mt-3" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue);">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2"><i class="fas fa-info-circle me-2"></i>Tips Keamanan</h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-1"><i class="fas fa-check me-2"></i> Gunakan minimal 6 karakter</li>
                            <li class="mb-1"><i class="fas fa-check me-2"></i> Kombinasikan huruf besar, kecil, dan angka</li>
                            <li><i class="fas fa-check me-2"></i> Jangan gunakan informasi pribadi sebagai password</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
