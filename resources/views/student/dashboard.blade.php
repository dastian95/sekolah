@extends('layouts.student')

@section('title', 'Dashboard - ' . $student->nama)

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 3rem 0;">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Selamat Datang, {{ $student->nama }}!</h1>
                <p style="margin-top: 0.5rem; font-size: 1.1rem; opacity: 0.9;">
                    <i class="fas fa-user-check me-2"></i>Portal Pendaftar Peserta Didik Baru
                </p>
            </div>
            @if($student->nisn)
            <div class="col-auto">
                <div style="background: white; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <p class="text-muted mb-1"><small>NISN</small></p>
                    <p class="fs-5 fw-bold mb-0" style="color: var(--dark-blue);">{{ $student->nisn }}</p>
                </div>
            </div>
            @endif
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
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Quick Info Cards -->
        @php
            $statusMap = match($student->status ?? 'pending') {
                'pending'   => ['color' => '#ff9800', 'icon' => 'fa-clock',        'badge' => 'warning'],
                'contacted' => ['color' => '#2196f3', 'icon' => 'fa-search',       'badge' => 'info'],
                'verified'  => ['color' => '#28a745', 'icon' => 'fa-check-circle', 'badge' => 'success'],
                'rejected'  => ['color' => '#dc3545', 'icon' => 'fa-times-circle', 'badge' => 'danger'],
                default     => ['color' => '#6c757d', 'icon' => 'fa-question-circle', 'badge' => 'secondary'],
            };
        @endphp

        <div class="row mb-4">
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid {{ $statusMap['color'] }} !important;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Status Pendaftaran</small></p>
                                <span class="badge bg-{{ $statusMap['badge'] }} fs-6">{{ $student->status_label }}</span>
                            </div>
                            <i class="fas {{ $statusMap['icon'] }}" style="font-size: 1.8rem; color: {{ $statusMap['color'] }}; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #28a745;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Tanggal Daftar</small></p>
                                <h5 class="fw-bold mb-0">{{ $student->created_at->format('d M Y') }}</h5>
                            </div>
                            <i class="fas fa-calendar-check" style="font-size: 1.8rem; color: #28a745; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #ff9800;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Jenis Kelamin</small></p>
                                <h5 class="fw-bold mb-0">
                                    {{ $student->jenis_kelamin === 'L' ? 'Laki-laki' : ($student->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}
                                </h5>
                            </div>
                            <i class="fas fa-user" style="font-size: 1.8rem; color: #ff9800; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #9c27b0;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1"><small>Kontak</small></p>
                                <h5 class="fw-bold mb-0 text-truncate">
                                    @if($student->hp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $student->hp) }}" target="_blank" class="text-decoration-none" style="color: #25d366;">
                                            <i class="fab fa-whatsapp me-1"></i>{{ $student->hp }}
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
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
                                <p class="fw-bold">{{ $student->nama }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>NISN</small></p>
                                <p class="fw-bold">{{ $student->nisn ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>Tempat Lahir</small></p>
                                <p class="fw-bold">{{ $student->tempat_lahir ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>Tanggal Lahir</small></p>
                                <p class="fw-bold">{{ $student->tanggal_lahir ? $student->tanggal_lahir->format('d M Y') : '-' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>Email</small></p>
                                <p class="fw-bold">{{ $student->email ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="text-muted mb-1"><small>No. HP</small></p>
                                <p class="fw-bold">{{ $student->hp ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="mt-2">
                            @if($student->canEditProfile())
                                <a href="{{ route('student.profile.edit') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit me-1"></i> Ubah Data
                                </a>
                                <a href="{{ route('student.profile') }}" class="btn btn-sm btn-outline-secondary ms-2">
                                    <i class="fas fa-id-card me-1"></i> Lihat Profil Lengkap
                                </a>
                            @else
                                <a href="{{ route('student.profile') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-id-card me-1"></i> Lihat Profil Lengkap
                                </a>
                                <p class="text-muted fst-italic small mt-2 mb-0">
                                    <i class="fas fa-lock me-1"></i>
                                    Data tidak dapat diubah — status saat ini: <strong>{{ $student->status_label }}</strong>.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Status Pendaftaran -->
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Status Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas {{ $statusMap['icon'] }} fa-2x mt-1" style="color: {{ $statusMap['color'] }};"></i>
                            <div>
                                <h6 class="fw-bold mb-1">{{ $student->status_label }}</h6>
                                <p class="text-muted mb-3">{{ $student->status_description }}</p>
                                <a href="{{ route('student.graduation.status') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt me-1"></i> Lihat Detail Status
                                </a>
                            </div>
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
                            <span><i class="fas fa-id-card me-2" style="color: var(--primary-blue);"></i> Data Lengkap</span>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        <a href="{{ route('student.graduation.status') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-clipboard-check me-2" style="color: #28a745;"></i> Status Pendaftaran</span>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        @if($student->canEditProfile())
                            <a href="{{ route('student.profile.edit') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-edit me-2" style="color: #ff9800;"></i> Ubah Data</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </a>
                        @endif
                        <a href="{{ route('student.change-password') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-muted">
                            <span><i class="fas fa-lock me-2"></i> Ubah Password</span>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>

                <!-- Info Penting -->
                <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue);">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="fas fa-bell me-2"></i>Info Penting</h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check-circle me-2"></i>
                                Cek status pendaftaran secara berkala
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-file-alt me-2"></i>
                                Lengkapi data yang masih kosong
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-shield-alt me-2"></i>
                                Jaga keamanan akun Anda
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
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
