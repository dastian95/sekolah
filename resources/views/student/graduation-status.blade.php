@extends('layouts.student')

@section('title', 'Status Pendaftaran - ' . $student->nama)

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Status Pendaftaran</h1>
                <p style="margin-top: 0.5rem; opacity: 0.9;">Informasi Pendaftaran {{ $student->nama }}</p>
            </div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 2rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8">
                <!-- Status Card -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            @php
                                $statusMap = match($student->status ?? 'pending') {
                                    'pending'   => ['color' => '#ff9800', 'icon' => 'fa-clock',        'badge' => 'warning'],
                                    'contacted' => ['color' => '#2196f3', 'icon' => 'fa-search',       'badge' => 'info'],
                                    'verified'  => ['color' => '#28a745', 'icon' => 'fa-check-circle', 'badge' => 'success'],
                                    'rejected'  => ['color' => '#dc3545', 'icon' => 'fa-times-circle', 'badge' => 'danger'],
                                    default     => ['color' => '#6c757d', 'icon' => 'fa-question-circle', 'badge' => 'secondary'],
                                };
                            @endphp

                            <div style="font-size: 4rem; color: {{ $statusMap['color'] }}; margin-bottom: 1rem;">
                                <i class="fas {{ $statusMap['icon'] }}"></i>
                            </div>
                            <h2 class="fw-bold mb-2">{{ $student->status_label }}</h2>
                            <span class="badge bg-{{ $statusMap['badge'] }} fs-6 px-3 py-2">
                                {{ $student->status_label }}
                            </span>
                        </div>

                        <div class="alert alert-{{ $statusMap['badge'] }} mb-0" role="alert">
                            <i class="fas {{ $statusMap['icon'] }} me-2"></i>
                            {{ $student->status_description }}
                        </div>
                    </div>
                </div>

                <!-- Detail Information -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Informasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Nama Pendaftar</small></p>
                                <p class="fw-bold">{{ $student->nama }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>No. Registrasi</small></p>
                                <p class="fw-bold">{{ $student->registration_number ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>NISN</small></p>
                                <p class="fw-bold">{{ $student->nisn ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Tanggal Daftar</small></p>
                                <p class="fw-bold">{{ $student->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Status Saat Ini</small></p>
                                <p class="fw-bold">
                                    <span class="badge bg-{{ $statusMap['badge'] }}">{{ $student->status_label }}</span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Catatan Admin</small></p>
                                <p class="fw-bold">{{ $student->admin_note ?? 'Tidak ada catatan' }}</p>
                            </div>
                        </div>

                        @if($student->status === 'verified' && $student->tahun_masuk)
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1"><small>Tahun Masuk</small></p>
                                    <p class="fw-bold">{{ $student->tahun_masuk }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Download Certificate (verified only) -->
                @if($student->status === 'verified')
                    <div class="card shadow-sm border-0 mb-4" style="border-left: 4px solid #28a745;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold mb-1">Surat Penerimaan</h5>
                                    <p class="text-muted mb-0">Dokumen resmi penerimaan dari sekolah</p>
                                </div>
                                <a href="{{ route('student.certificate.download') }}" class="btn btn-success btn-lg">
                                    <i class="fas fa-download me-2"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Current Status Description -->
                <div class="card shadow-sm border-0 mb-4" style="border-left: 4px solid {{ $statusMap['color'] }};">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Keterangan Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas {{ $statusMap['icon'] }} fa-lg me-3" style="color: {{ $statusMap['color'] }};"></i>
                            <h6 class="fw-bold mb-0" style="color: {{ $statusMap['color'] }};">{{ $student->status_label }}</h6>
                        </div>
                        <p class="small text-muted mb-0">{{ $student->status_description }}</p>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue);">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2"><i class="fas fa-headset me-2"></i>Butuh Bantuan?</h6>
                        <p class="small mb-2">Jika ada pertanyaan tentang status pendaftaran, silakan hubungi pihak sekolah.</p>
                        @if($student->hp)
                            <hr style="border-color: rgba(0,0,0,0.15);">
                            <p class="small mb-0">
                                <strong>Nomor terdaftar:</strong><br>
                                {{ $student->hp }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
