@extends('layouts.app')

@section('title', 'Dashboard Siswa - ' . auth('students')->user()->nama)

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 3rem 0;">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Selamat Datang, {{ auth('students')->user()->nama }}!</h1>
                <p style="margin-top: 0.5rem; font-size: 1.1rem; opacity: 0.9;">
                    <i class="fas fa-graduation-cap me-2"></i>Portal Informasi Akademik Siswa
                </p>
            </div>
            <div class="col-auto">
                <div style="background: white; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <p class="text-muted mb-1"><small>NISN Anda</small></p>
                    <p class="fs-5 fw-bold" style="color: var(--dark-blue);">{{ auth('students')->user()->nisn }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Quick Info Cards -->
        <div class="row mb-4">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0" style="border-left: 4px solid var(--primary-blue);">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Status Akademik</small></p>
                                <h5 class="fw-bold">{{ auth('students')->user()->status ?? 'Aktif' }}</h5>
                            </div>
                            <i class="fas fa-book" style="font-size: 1.8rem; color: var(--primary-blue); opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0" style="border-left: 4px solid #28a745;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Tahun Masuk</small></p>
                                <h5 class="fw-bold">{{ auth('students')->user()->tahun_masuk ?? '2026' }}</h5>
                            </div>
                            <i class="fas fa-calendar-check" style="font-size: 1.8rem; color: #28a745; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0" style="border-left: 4px solid #ff9800;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Jenis Kelamin</small></p>
                                <h5 class="fw-bold">{{ auth('students')->user()->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</h5>
                            </div>
                            <i class="fas fa-user" style="font-size: 1.8rem; color: #ff9800; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0" style="border-left: 4px solid #9c27b0;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Kontak WhatsApp</small></p>
                                <h5 class="fw-bold text-truncate">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', auth('students')->user()->hp) }}" target="_blank" class="text-decoration-none" style="color: #25d366;">
                                        <i class="fab fa-whatsapp me-1"></i>Hubungi
                                    </a>
                                </h5>
                            </div>
                            <i class="fab fa-whatsapp" style="font-size: 1.8rem; color: #25d366; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Sections -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-9">
                <!-- Informasi Pribadi -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Informasi Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>Nama Lengkap</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->nama }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>NISN</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->nisn }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>Tempat Lahir</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->tempat_lahir }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>Tanggal Lahir</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->tanggal_lahir ? auth('students')->user()->tanggal_lahir->format('d M Y') : '-' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>Email</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->email }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>No. HP</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->hp }}</p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('student.profile') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit me-1"></i> Lihat Detail Lengkap
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Status Kelulusan -->
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Status Kelulusan</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Info:</strong> Status kelulusan Anda dapat dilihat di halaman <a href="{{ route('student.graduation.status') }}" class="alert-link">Status Kelulusan</a>.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-3">
                <!-- Menu Cepat -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Menu Cepat</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('student.profile') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-id-card me-2" style="color: var(--primary-blue);"></i> Informasi Lengkap</span>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        <a href="{{ route('student.graduation.status') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-graduation-cap me-2" style="color: #28a745;"></i> Status Kelulusan</span>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        <a href="{{ route('student.change-password') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-lock me-2" style="color: #ff9800;"></i> Ubah Password</span>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>

                <!-- Info Penting -->
                <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); border: none;">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="fas fa-bell me-2"></i>Info Penting</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-2">
                                <i class="fas fa-check-circle me-2"></i>
                                Cek status kelulusan secara berkala
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-whatsapp me-2"></i>
                                Notifikasi akan dikirim via WhatsApp
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-shield-alt me-2"></i>
                                Jaga keamanan password Anda
                            </li>
                            <li>
                                <i class="fas fa-question-circle me-2"></i>
                                Hubungi admin jika ada pertanyaan
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('student.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
