@extends('layouts.app')

@section('title', 'Status Kelulusan - ' . auth('students')->user()->nama)

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Status Kelulusan</h1>
                <p style="margin-top: 0.5rem; opacity: 0.9;">Informasi Kelulusan {{ auth('students')->user()->nama }}</p>
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
                                $statusColor = match(auth('students')->user()->status ?? 'pending') {
                                    'pending' => ['color' => '#ff9800', 'icon' => 'fa-clock', 'label' => 'Menunggu Verifikasi'],
                                    'contacted' => ['color' => '#2196f3', 'icon' => 'fa-comments', 'label' => 'Sudah Dihubungi'],
                                    'verified' => ['color' => '#28a745', 'icon' => 'fa-check-circle', 'label' => 'Lulus'],
                                    'rejected' => ['color' => '#dc3545', 'icon' => 'fa-times-circle', 'label' => 'Tidak Lulus'],
                                    default => ['color' => '#6c757d', 'icon' => 'fa-question-circle', 'label' => 'Tidak Diketahui']
                                };
                            @endphp

                            <div style="font-size: 4rem; color: {{ $statusColor['color'] }}; margin-bottom: 1rem;">
                                <i class="fas {{ $statusColor['icon'] }}"></i>
                            </div>
                            <h2 class="fw-bold mb-2">{{ $statusColor['label'] }}</h2>
                            <p class="text-muted mb-0">Status kelulusan Anda saat ini</p>
                        </div>

                        @if(auth('students')->user()->status == 'verified')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Selamat!</strong> Anda dinyatakan lulus. Silakan download sertifikat kelulusan Anda.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @elseif(auth('students')->user()->status == 'rejected')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-times-circle me-2"></i>
                                <strong>Pemberitahuan:</strong> Anda tidak dinyatakan lulus. Hubungi sekolah untuk informasi lebih lanjut.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @else
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Catatan:</strong> Status kelulusan Anda masih dalam proses verifikasi. Anda akan menerima notifikasi via WhatsApp ketika status diperbarui.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Detail Information -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Detail Informasi Kelulusan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Nama Siswa</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->nama }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>NISN</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->nisn }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Tahun Masuk</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->tahun_masuk ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Tahun Kelulusan (Direncanakan)</small></p>
                                <p class="fw-bold">
                                    @php
                                        $tahunMasuk = auth('students')->user()->tahun_masuk;
                                        $kelasAwal = auth('students')->user()->kelas_awal ?? 1;
                                        $tahunKelulusan = $tahunMasuk ? $tahunMasuk + (7 - $kelasAwal) : '-';
                                    @endphp
                                    {{ $tahunKelulusan }}
                                </p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Status Saat Ini</small></p>
                                <p class="fw-bold">
                                    <span class="badge" style="background-color: {{ $statusColor['color'] }};">
                                        {{ $statusColor['label'] }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1"><small>Catatan Admin</small></p>
                                <p class="fw-bold">{{ auth('students')->user()->admin_note ?? 'Tidak ada catatan' }}</p>
                            </div>
                        </div>

                        @if(auth('students')->user()->nilai_akhir)
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1"><small>Nilai Akhir</small></p>
                                    <p class="fw-bold">{{ auth('students')->user()->nilai_akhir }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1"><small>Keterangan</small></p>
                                    <p class="fw-bold">{{ auth('students')->user()->keterangan ?? '-' }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Download Certificate -->
                @if(auth('students')->user()->status == 'verified')
                    <div class="card shadow-sm border-0 mb-4" style="border-left: 4px solid #28a745;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-bold mb-1">Unduh Sertifikat Kelulusan</h5>
                                    <p class="text-muted mb-0">Sertifikat resmi kelulusan dari sekolah</p>
                                </div>
                                <a href="{{ route('student.certificate.download') }}" class="btn btn-success btn-lg">
                                    <i class="fas fa-download me-2"></i> Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Timeline -->
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item mb-4">
                                <div class="d-flex">
                                    <div class="timeline-marker" style="background-color: #ff9800; width: 20px; height: 20px; border-radius: 50%; flex-shrink: 0; margin-top: 5px; margin-right: 1rem;"></div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Registrasi Awal</h6>
                                        <p class="text-muted small mb-0">{{ auth('students')->user()->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            @if(auth('students')->user()->status != 'pending')
                                <div class="timeline-item mb-4">
                                    <div class="d-flex">
                                        <div class="timeline-marker" style="background-color: #2196f3; width: 20px; height: 20px; border-radius: 50%; flex-shrink: 0; margin-top: 5px; margin-right: 1rem;"></div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Status Diperbarui</h6>
                                            <p class="text-muted small mb-0">{{ auth('students')->user()->updated_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(auth('students')->user()->status == 'verified')
                                <div class="timeline-item">
                                    <div class="d-flex">
                                        <div class="timeline-marker" style="background-color: #28a745; width: 20px; height: 20px; border-radius: 50%; flex-shrink: 0; margin-top: 5px; margin-right: 1rem;"></div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Dinyatakan Lulus</h6>
                                            <p class="text-muted small mb-0">{{ auth('students')->user()->updated_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- WhatsApp Notification Info -->
                <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); color: white;">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">
                            <i class="fab fa-whatsapp me-2"></i>Notifikasi WhatsApp
                        </h6>
                        <p class="small mb-2">Anda akan menerima notifikasi via WhatsApp ketika:</p>
                        <ul class="list-unstyled small">
                            <li class="mb-1">
                                <i class="fas fa-check me-2"></i>Status diperbarui
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-check me-2"></i>Dinyatakan lulus
                            </li>
                            <li>
                                <i class="fas fa-check me-2"></i>Sertifikat siap diunduh
                            </li>
                        </ul>
                        <hr style="border-color: rgba(255,255,255,0.3); margin: 1rem 0;">
                        <p class="small mb-0">
                            <strong>Nomor terdaftar:</strong><br>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', auth('students')->user()->hp) }}" target="_blank" class="text-white text-decoration-underline">
                                {{ auth('students')->user()->hp }}
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Status Guide -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h6 class="mb-0"><i class="fas fa-question-circle me-2"></i>Penjelasan Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold small" style="color: #ff9800;">
                                <i class="fas fa-clock me-2"></i>Menunggu Verifikasi
                            </h6>
                            <p class="small text-muted mb-0">Status awal setelah registrasi atau pembaruan data</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold small" style="color: #2196f3;">
                                <i class="fas fa-comments me-2"></i>Sudah Dihubungi
                            </h6>
                            <p class="small text-muted mb-0">Admin telah menghubungi untuk verifikasi data</p>
                        </div>

                        <div class="mb-3">
                            <h6 class="fw-bold small" style="color: #28a745;">
                                <i class="fas fa-check-circle me-2"></i>Lulus
                            </h6>
                            <p class="small text-muted mb-0">Data terverifikasi dan dinyatakan lulus</p>
                        </div>

                        <div>
                            <h6 class="fw-bold small" style="color: #dc3545;">
                                <i class="fas fa-times-circle me-2"></i>Tidak Lulus
                            </h6>
                            <p class="small text-muted mb-0">Tidak memenuhi kriteria kelulusan</p>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="card shadow-sm border-0" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue);">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2"><i class="fas fa-headset me-2"></i>Butuh Bantuan?</h6>
                        <p class="small mb-2">Jika Anda memiliki pertanyaan tentang status kelulusan, silakan hubungi:</p>
                        <p class="small mb-0">
                            <strong>TU Sekolah</strong><br>
                            <i class="fas fa-phone me-1"></i> (Hubungi Admin)<br>
                            <i class="fas fa-envelope me-1"></i> admin@labitech.sch.id
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
