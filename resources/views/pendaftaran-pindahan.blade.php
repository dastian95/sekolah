@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Pindahan - Laboratorium Islamic Technology-Labitech')

@section('content')
<!-- Hero -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 5rem 0 3rem;">
    <div class="container-lg">
        <p style="opacity:0.8; margin-bottom:0.5rem; font-size:0.9rem;">
            <a href="{{ route('home') }}" style="color:white; opacity:0.7;">Beranda</a>
            <i class="fas fa-chevron-right mx-2" style="font-size:0.65rem;"></i>
            <span>Pendaftaran Pindahan</span>
        </p>
        <h1 style="font-size:2.5rem; font-weight:800; margin:0;">
            <i class="fas fa-exchange-alt me-3" style="opacity:0.8;"></i>Pendaftaran Siswa Pindahan
        </h1>
        <p style="margin-top:0.75rem; font-size:1.05rem; opacity:0.9;">
            Penerimaan Siswa Pindahan (Transfer) — Laboratorium Islamic Technology-Labitech
        </p>
        <div class="d-flex gap-2 mt-3 flex-wrap">
            <a href="{{ route('pendaftaran') }}" class="btn btn-outline-light btn-sm px-3">
                <i class="fas fa-user-graduate me-1"></i> Siswa Baru
            </a>
            <a href="{{ route('pendaftaran-pindahan') }}" class="btn btn-warning fw-bold btn-sm px-3">
                <i class="fas fa-exchange-alt me-1"></i> Siswa Pindahan
            </a>
        </div>
    </div>
</section>

<!-- Form Section -->
<section style="padding: 3rem 0; background: #f8f9fa; min-height: 60vh;">
    <div class="container-lg">

        @php
            $formUrl = \App\Models\SiteSetting::getValue('registration_google_form_pindahan');
            $isClosed = !\App\Models\SiteSetting::isRegistrationOpen();
            $closedMessage = \App\Models\SiteSetting::getRegistrationClosedMessage();
        @endphp

        @if($isClosed)
            <div class="row justify-content-center">
                <div class="col-lg-7">
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
        @elseif($formUrl)
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="card-header" style="background: var(--dark-blue); color:white; padding:1rem 1.5rem;">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Formulir Pendaftaran Siswa Pindahan</h5>
                        </div>
                        <div class="card-body p-0">
                            <iframe src="{{ $formUrl }}"
                                    width="100%"
                                    style="height: 900px; min-height: 700px; border: none; display: block;"
                                    loading="lazy">
                                Memuat formulir pendaftaran...
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm text-center p-5">
                        <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                        <h4 class="fw-bold mb-2">Formulir Pendaftaran Belum Tersedia</h4>
                        <p class="text-muted mb-4">
                            Link pendaftaran siswa pindahan akan segera dibuka. Silakan hubungi pihak sekolah untuk informasi lebih lanjut.
                        </p>
                        <a href="{{ route('home') }}#section-kontak" class="btn btn-primary px-4">
                            <i class="fas fa-phone me-2"></i> Hubungi Sekolah
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
