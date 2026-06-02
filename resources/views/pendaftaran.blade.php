@extends('layouts.app')

@section('title', 'Pendaftaran - Laboratorium Islamic Technology-Labitech')

@section('content')
<!-- Hero -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 5rem 0 3rem;">
    <div class="container-lg">
        <p style="opacity:0.8; margin-bottom:0.5rem; font-size:0.9rem;">
            <a href="{{ route('home') }}" style="color:white; opacity:0.7;">Beranda</a>
            <i class="fas fa-chevron-right mx-2" style="font-size:0.65rem;"></i>
            <span>Pendaftaran</span>
        </p>
        <h1 style="font-size:2.5rem; font-weight:800; margin:0;">
            <i class="fas fa-graduation-cap me-3" style="opacity:0.8;"></i>Pendaftaran
        </h1>
        <p style="margin-top:0.75rem; font-size:1.05rem; opacity:0.9;">
            Laboratorium Islamic Technology-Labitech — Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}
        </p>
    </div>
</section>

<!-- Content -->
<section style="padding: 4rem 0; background: #f8f9fa; min-height: 60vh;">
    <div class="container-lg">

        @php
            $formBaru      = \App\Models\SiteSetting::getValue('registration_google_form_baru');
            $formPindahan  = \App\Models\SiteSetting::getValue('registration_google_form_pindahan');
            $isClosed      = !\App\Models\SiteSetting::isRegistrationOpen();
            $closedMessage = \App\Models\SiteSetting::getRegistrationClosedMessage();
        @endphp

        @if($isClosed)
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm text-center p-5">
                        <i class="fas fa-door-closed fa-3x text-danger mb-3"></i>
                        <h4 class="fw-bold text-danger mb-3">Pendaftaran Sedang Ditutup</h4>
                        <p class="text-muted mb-4">{{ $closedMessage }}</p>
                        <a href="{{ route('home') }}#section-kontak" class="btn btn-primary px-4">
                            <i class="fas fa-phone me-2"></i> Hubungi Sekolah
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h4 class="fw-bold mb-2" style="color: var(--dark-blue);">Pilih Jenis Pendaftaran</h4>
                    <p class="text-muted">Silakan pilih jenis pendaftaran sesuai kebutuhan Anda, kemudian isi formulir yang tersedia.</p>
                </div>
            </div>

            <div class="row justify-content-center g-4">

                {{-- Siswa Baru --}}
                <div class="col-md-5">
                    <div class="card border-0 shadow h-100" style="border-radius: 16px; overflow: hidden;">
                        <div style="background: linear-gradient(135deg, var(--dark-blue), #2d5a8c); padding: 2rem; text-align: center; color: white;">
                            <div style="width: 72px; height: 72px; background: rgba(255,255,255,0.15); border-radius: 50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom: 1rem;">
                                <i class="fas fa-user-graduate fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-1">Siswa Baru</h4>
                            <p style="opacity:0.85; font-size:0.9rem; margin:0;">Pendaftaran Peserta Didik Baru</p>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <p class="text-muted mb-4" style="line-height:1.7;">
                                Untuk calon peserta didik baru yang belum pernah terdaftar di Laboratorium Islamic Technology-Labitech.
                                Isi formulir pendaftaran online dan tim kami akan segera menghubungi Anda.
                            </p>
                            @if($formBaru)
                                <a href="{{ $formBaru }}" target="_blank" rel="noopener"
                                   class="btn btn-primary btn-lg mt-auto fw-semibold"
                                   style="border-radius: 10px;">
                                    <i class="fas fa-external-link-alt me-2"></i> Daftar Sekarang
                                </a>
                            @else
                                <div class="alert alert-warning mt-auto mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Formulir pendaftaran belum tersedia. Hubungi sekolah untuk informasi lebih lanjut.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Siswa Pindahan --}}
                <div class="col-md-5">
                    <div class="card border-0 shadow h-100" style="border-radius: 16px; overflow: hidden;">
                        <div style="background: linear-gradient(135deg, #2d5a8c, #3d7ab5); padding: 2rem; text-align: center; color: white;">
                            <div style="width: 72px; height: 72px; background: rgba(255,255,255,0.15); border-radius: 50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom: 1rem;">
                                <i class="fas fa-exchange-alt fa-2x"></i>
                            </div>
                            <h4 class="fw-bold mb-1">Siswa Pindahan</h4>
                            <p style="opacity:0.85; font-size:0.9rem; margin:0;">Penerimaan Siswa Transfer</p>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <p class="text-muted mb-4" style="line-height:1.7;">
                                Untuk siswa yang ingin pindah dari sekolah lain ke Laboratorium Islamic Technology-Labitech.
                                Isi formulir pindahan dan tim kami akan membantu proses administrasi Anda.
                            </p>
                            @if($formPindahan)
                                <a href="{{ $formPindahan }}" target="_blank" rel="noopener"
                                   class="btn btn-primary btn-lg mt-auto fw-semibold"
                                   style="border-radius: 10px;">
                                    <i class="fas fa-external-link-alt me-2"></i> Daftar Sekarang
                                </a>
                            @else
                                <div class="alert alert-warning mt-auto mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Formulir pendaftaran belum tersedia. Hubungi sekolah untuk informasi lebih lanjut.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- Info tambahan --}}
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div class="card border-0" style="background: #e8f4ff; border-radius: 12px;">
                        <div class="card-body py-3 px-4 d-flex align-items-center gap-3">
                            <i class="fas fa-info-circle fa-lg" style="color: var(--primary-blue); flex-shrink:0;"></i>
                            <p class="mb-0 small text-muted">
                                Butuh bantuan atau informasi lebih lanjut?
                                <a href="{{ route('home') }}#section-kontak" style="color: var(--primary-blue);">Hubungi kami</a>
                                dan tim kami siap membantu Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
