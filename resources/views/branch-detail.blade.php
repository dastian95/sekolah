@extends('layouts.app')

@section('title', 'SD Labitech Insan Mulia ' . $branch->name . ' - Laboratorium Islamic Technology-Labitech')

@section('content')
@php
    $color = $branch->color ?: '#1a3a5c';
    $formUrl = \App\Models\SiteSetting::getValue('registration_google_form_baru');
@endphp

<!-- ====== HERO ====== -->
<section style="background: linear-gradient(135deg, {{ $color }} 0%, {{ $color }}cc 100%); color: white; padding: 5rem 0 3rem;">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <p style="opacity:0.8; margin-bottom:0.5rem; font-size:0.9rem;">
                    <a href="{{ route('home') }}" style="color:white; opacity:0.7;">Beranda</a>
                    <i class="fas fa-chevron-right mx-2" style="font-size:0.65rem;"></i>
                    <span>Cabang {{ $branch->name }}</span>
                </p>
                <p style="margin:0 0 0.5rem; font-size:0.85rem; font-weight:600; opacity:0.7; letter-spacing:1px; text-transform:uppercase;">SD Labitech Insan Mulia</p>
                <h1 style="font-size:3rem; font-weight:800; margin:0; line-height:1.1;">{{ $branch->name }}</h1>
                <p style="margin-top:1rem; font-size:1.05rem; opacity:0.9; max-width:580px; line-height:1.7;">
                    {{ $branch->description ?: 'SD Labitech Insan Mulia ' . $branch->name . ' — Pendidikan Islam Terpadu berkualitas untuk generasi unggul dan berkarakter.' }}
                </p>
                <div class="d-flex gap-3 mt-3 flex-wrap">
                    @if($formUrl)
                        <a href="{{ $formUrl }}" target="_blank" class="btn btn-warning fw-bold px-4">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    @else
                        <a href="{{ route('pendaftaran') }}" class="btn btn-warning fw-bold px-4">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    @endif
                    <a href="{{ route('home') }}#section-kontak" class="btn btn-outline-light px-4">
                        <i class="fas fa-phone me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center mt-4 mt-lg-0">
                @if($branch->logo)
                    <img src="{{ asset('storage/' . $branch->logo) }}" alt="Logo {{ $branch->name }}"
                         style="height:130px; width:auto; border-radius:20px; background:rgba(255,255,255,0.15); padding:1rem; filter:drop-shadow(0 8px 20px rgba(0,0,0,0.2));">
                @else
                    <img src="{{ asset('images/logo1.png') }}" alt="logo SD Labitech"
                         style="height:110px; width:auto; opacity:0.85; filter:brightness(0) invert(1) drop-shadow(0 4px 12px rgba(0,0,0,0.2));">
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ====== TENTANG SEKOLAH ====== -->
<section style="padding: 4rem 0; background: white;">
    <div class="container-lg">
        <div class="row g-5 align-items-center">
            <!-- Image placeholder -->
            <div class="col-lg-5">
                <div style="width:100%; aspect-ratio:4/3; border-radius:16px; background:linear-gradient(135deg,#e8f0fb,#dde8ff); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:1rem; box-shadow:0 8px 30px rgba(0,0,0,0.08);">
                    <i class="fas fa-camera" style="font-size:3rem; color:{{ $color }}; opacity:0.3;"></i>
                    <p style="color:#aaa; margin:0; font-size:0.85rem; text-align:center; padding:0 1.5rem;">Foto Sekolah Cabang {{ $branch->name }}</p>
                </div>
            </div>
            <!-- Text -->
            <div class="col-lg-7">
                <div style="display:inline-block; background:{{ $color }}22; color:{{ $color }}; padding:0.3rem 1rem; border-radius:20px; font-size:0.8rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:1rem;">Tentang Sekolah</div>
                <h2 style="font-size:2rem; font-weight:800; color:{{ $color }}; margin-bottom:1.25rem; line-height:1.2;">
                    SD Labitech Insan Mulia<br>{{ $branch->name }}
                </h2>
                @if($branch->description)
                    <p style="font-size:1.05rem; line-height:1.8; color:#555;">{{ $branch->description }}</p>
                @else
                    <p style="font-size:1.05rem; line-height:1.8; color:#555;">
                        SD Labitech Insan Mulia {{ $branch->name }} adalah bagian dari jaringan sekolah Laboratorium Islamic Technology-Labitech yang berkomitmen menghadirkan pendidikan berkualitas berbasis Islam Terpadu. Kami menggabungkan kurikulum nasional (Kurikulum Merdeka) dengan nilai-nilai Islam untuk membentuk generasi yang berkarakter, berprestasi, dan siap menghadapi tantangan global.
                    </p>
                    <p style="font-size:1.05rem; line-height:1.8; color:#555;">
                        Dengan tenaga pengajar profesional dan lingkungan belajar yang kondusif, SD Labitech Insan Mulia {{ $branch->name }} hadir untuk melayani kebutuhan pendidikan masyarakat sekitar dengan standar mutu yang tinggi.
                    </p>
                @endif
                <div class="row g-3 mt-2">
                    <div class="col-6">
                        <div style="padding:1rem; background:#f8f9fa; border-radius:10px; text-align:center; border-left:4px solid {{ $color }};">
                            <div style="font-size:1.5rem; font-weight:800; color:{{ $color }};">Islam</div>
                            <div style="font-size:0.78rem; color:#888;">Berbasis Nilai Islam</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="padding:1rem; background:#f8f9fa; border-radius:10px; text-align:center; border-left:4px solid {{ $color }};">
                            <div style="font-size:1.5rem; font-weight:800; color:{{ $color }};">Terpadu</div>
                            <div style="font-size:0.78rem; color:#888;">Kurikulum Merdeka</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== PROGRAM UNGGULAN ====== -->
<section style="padding: 4rem 0; background: #f8f9fa;">
    <div class="container-lg">
        <div style="text-align:center; margin-bottom:3rem;">
            <div style="display:inline-block; background:{{ $color }}22; color:{{ $color }}; padding:0.3rem 1rem; border-radius:20px; font-size:0.8rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:0.75rem;">Program Unggulan</div>
            <h2 style="font-size:2rem; font-weight:800; color:{{ $color }}; margin:0;">Keunggulan Kami</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div style="background:white; border-radius:12px; padding:1.75rem; box-shadow:0 2px 12px rgba(0,0,0,0.06); border-left:4px solid {{ $color }}; height:100%;">
                    <div style="width:48px; height:48px; background:{{ $color }}22; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                        <i class="fas fa-book-quran" style="color:{{ $color }}; font-size:1.3rem;"></i>
                    </div>
                    <h4 style="color:{{ $color }}; font-weight:700; margin-bottom:0.5rem;">Kurikulum Islam Terpadu</h4>
                    <p style="color:#666; margin:0; line-height:1.7; font-size:0.92rem;">Mengintegrasikan Kurikulum Merdeka dengan nilai-nilai Islam dan pembelajaran Al-Quran secara menyeluruh.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div style="background:white; border-radius:12px; padding:1.75rem; box-shadow:0 2px 12px rgba(0,0,0,0.06); border-left:4px solid {{ $color }}; height:100%;">
                    <div style="width:48px; height:48px; background:{{ $color }}22; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                        <i class="fas fa-chalkboard-user" style="color:{{ $color }}; font-size:1.3rem;"></i>
                    </div>
                    <h4 style="color:{{ $color }}; font-weight:700; margin-bottom:0.5rem;">Guru Profesional</h4>
                    <p style="color:#666; margin:0; line-height:1.7; font-size:0.92rem;">Tenaga pengajar berpengalaman dan bersertifikasi yang memahami perkembangan anak usia sekolah dasar.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div style="background:white; border-radius:12px; padding:1.75rem; box-shadow:0 2px 12px rgba(0,0,0,0.06); border-left:4px solid {{ $color }}; height:100%;">
                    <div style="width:48px; height:48px; background:{{ $color }}22; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                        <i class="fas fa-mosque" style="color:{{ $color }}; font-size:1.3rem;"></i>
                    </div>
                    <h4 style="color:{{ $color }}; font-weight:700; margin-bottom:0.5rem;">Program Tahfidz Al-Quran</h4>
                    <p style="color:#666; margin:0; line-height:1.7; font-size:0.92rem;">Program hafalan Al-Quran unggulan dengan target minimal 3 juz selama masa belajar di sekolah dasar.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div style="background:white; border-radius:12px; padding:1.75rem; box-shadow:0 2px 12px rgba(0,0,0,0.06); border-left:4px solid {{ $color }}; height:100%;">
                    <div style="width:48px; height:48px; background:{{ $color }}22; border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                        <i class="fas fa-heart" style="color:{{ $color }}; font-size:1.3rem;"></i>
                    </div>
                    <h4 style="color:{{ $color }}; font-weight:700; margin-bottom:0.5rem;">Pendidikan Karakter Islami</h4>
                    <p style="color:#666; margin:0; line-height:1.7; font-size:0.92rem;">Pembinaan akhlak dan karakter melalui pembiasaan ibadah, adab keseharian, dan nilai-nilai keislaman.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== INFO & KONTAK ====== -->
<section style="padding: 4rem 0; background: white;">
    <div class="container-lg">
        <div class="row g-4">

            <!-- Kontak & Pendaftaran -->
            <div class="col-lg-8">
                <!-- Pendaftaran CTA -->
                <div style="background:linear-gradient(135deg, {{ $color }}, {{ $color }}bb); color:white; border-radius:16px; padding:2.5rem; margin-bottom:2rem;">
                    <h3 style="font-weight:800; margin-bottom:0.5rem;">Bergabung Bersama Kami</h3>
                    <p style="opacity:0.9; margin-bottom:1.5rem; font-size:0.95rem;">
                        Daftarkan putra-putri Anda di SD Labitech Insan Mulia {{ $branch->name }} dan berikan pendidikan Islam terpadu terbaik.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        @if($formUrl)
                            <a href="{{ $formUrl }}" target="_blank" class="btn btn-warning fw-bold px-4">
                                <i class="fas fa-user-plus me-2"></i>Daftar Siswa Baru
                            </a>
                        @else
                            <a href="{{ route('pendaftaran') }}" class="btn btn-warning fw-bold px-4">
                                <i class="fas fa-user-plus me-2"></i>Daftar Siswa Baru
                            </a>
                        @endif
                        <a href="{{ route('pendaftaran-pindahan') }}" class="btn btn-outline-light px-4">
                            <i class="fas fa-exchange-alt me-2"></i>Siswa Pindahan
                        </a>
                    </div>
                </div>

                <!-- Kontak Detail -->
                @if($branch->address || $branch->phone || $branch->email)
                <div style="background:#f8f9fa; border-radius:16px; padding:2rem;">
                    <h5 style="font-weight:700; color:{{ $color }}; margin-bottom:1.25rem;">
                        <i class="fas fa-address-card me-2"></i>Informasi Kontak
                    </h5>
                    @if($branch->address)
                    <div class="d-flex gap-3 mb-3">
                        <div style="width:42px; height:42px; background:{{ $color }}22; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="fas fa-map-marker-alt" style="color:{{ $color }};"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Alamat</p>
                            <p class="fw-semibold mb-0">{{ $branch->address }}</p>
                        </div>
                    </div>
                    @endif
                    @if($branch->phone)
                    <div class="d-flex gap-3 mb-3">
                        <div style="width:42px; height:42px; background:#25d36622; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">WhatsApp / Telepon</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $branch->phone) }}" target="_blank"
                               class="fw-semibold text-decoration-none" style="color:#25d366;">{{ $branch->phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($branch->email)
                    <div class="d-flex gap-3">
                        <div style="width:42px; height:42px; background:{{ $color }}22; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <i class="fas fa-envelope" style="color:{{ $color }};"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0" style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.5px;">Email</p>
                            <a href="mailto:{{ $branch->email }}" class="fw-semibold text-decoration-none"
                               style="color:{{ $color }};">{{ $branch->email }}</a>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Sidebar: Cabang Lainnya -->
            <div class="col-lg-4">
                @if($otherBranches->count())
                <div class="card border-0 shadow-sm">
                    <div class="card-header fw-bold" style="background:{{ $color }}; color:white; font-size:0.95rem;">
                        <i class="fas fa-sitemap me-2"></i>Cabang Lainnya
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($otherBranches as $other)
                        <a href="{{ $other->slug ? route('branch.show', $other->slug) : '#' }}"
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                            <div>
                                <i class="fas fa-map-marker-alt me-2" style="color:{{ $other->color ?: $color }};"></i>
                                <span style="font-size:0.9rem; font-weight:600;">SD Labitech</span>
                                <span style="font-size:0.88rem;"> {{ $other->name }}</span>
                            </div>
                            <i class="fas fa-chevron-right text-muted" style="font-size:0.7rem;"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Motto -->
                <div style="margin-top:1.5rem; background:{{ $color }}11; border-radius:12px; padding:1.5rem; text-align:center; border:1px solid {{ $color }}22;">
                    <i class="fas fa-star" style="color:{{ $color }}; font-size:1.5rem; margin-bottom:0.75rem; display:block;"></i>
                    <p style="color:{{ $color }}; font-weight:700; margin:0; font-size:1rem;">Iman · Ilmu · Amal</p>
                    <p style="color:#888; margin:0.25rem 0 0; font-size:0.78rem;">Motto SD Labitech Insan Mulia</p>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
