@extends('layouts.app')

@section('title', 'Tentang Kami - Laboratorium Islamic Technology-Labitech')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 3rem 0;">
    <div class="container-lg">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Tentang Kami</h1>
        <p style="margin-top: 0.5rem; font-size: 1.1rem; opacity: 0.9;">Mengenal lebih dalam tentang Laboratorium Islamic Technology-Labitech</p>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0;">
    <div class="container-lg">
        <div class="row gap-5">
            <div class="col-lg-6">
                <div style="width:100%; aspect-ratio:5/4; border-radius:12px; box-shadow:0 15px 40px rgba(0,0,0,0.1); background:linear-gradient(135deg,#e8f0fb,#dde8ff); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:1rem;">
                    <img src="{{ asset('images/logo.png') }}" style="height:100px; width:auto;" alt="logo Laboratorium Islamic Technology-Labitech">
                    <p style="color:var(--dark-blue); margin:0; font-size:1rem; font-weight:700;">Laboratorium Islamic Technology-Labitech</p>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 style="font-size: 2rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;">
                    Laboratorium Islamic Technology-Labitech
                </h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 1rem;">
                    {{ $settings['about_description_1'] ?? 'Laboratorium Islamic Technology-Labitech (Sekolah Dasar Islam Terpadu Labitech Insan Mulia) adalah lembaga pendidikan tingkat sekolah dasar yang berbasis Islam Terpadu. Kami berkomitmen untuk menjadi pusat pembelajaran yang menggabungkan kurikulum nasional dengan nilai-nilai Islam.' }}
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 1rem;">
                    {{ $settings['about_description_2'] ?? 'Dengan visi menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global, kami terus berinovasi dalam mengembangkan kurikulum dan metode pembelajaran.' }}
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555;">
                    {{ $settings['about_description_3'] ?? 'Laboratorium Islamic Technology-Labitech berlokasi di Kota Bekasi, Jawa Barat dan terus berkomitmen untuk menjangkau lebih banyak peserta didik yang ingin mendapatkan pendidikan berkualitas berbasis Islam.' }}
                </p>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div style="margin-top: 4rem; padding: 3rem; background-color: #f8f9fa; border-radius: 12px;">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div style="text-align: center; padding: 1.5rem;">
                        <i class="fas fa-eye" style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1rem;">Visi</h3>
                        <p style="color: #666; line-height: 1.6;">
                            {{ $settings['about_vision'] ?? 'Menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global.' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div style="text-align: center; padding: 1.5rem;">
                        <i class="fas fa-target" style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1rem;">Misi</h3>
                        <p style="color: #666; line-height: 1.6;">
                            {{ $settings['about_mission'] ?? 'Menyelenggarakan pendidikan berkualitas dengan metode pembelajaran inovatif dan membentuk generasi yang berdisiplin dan bermoral tinggi.' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div style="text-align: center; padding: 1.5rem;">
                        <i class="fas fa-star" style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1rem;">Nilai</h3>
                        <p style="color: #666; line-height: 1.6;">
                            {{ $settings['about_values'] ?? 'Integritas, Keunggulan, Inovasi, Kerjasama, dan Pengabdian untuk menciptakan lingkungan belajar yang positif.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Features -->
        <div style="margin-top: 4rem;">
            <h2 style="text-align: center; font-size: 2rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 3rem;">
                Keunggulan Kami
            </h2>
            <div class="row">
                <div class="col-md-6">
                    <div style="padding: 1.5rem; margin-bottom: 1.5rem; background: white; border-left: 4px solid var(--primary-blue); border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <h4 style="color: var(--dark-blue); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-book-quran" style="color: var(--primary-blue); margin-right: 0.5rem;"></i>
                            Kurikulum Islam Terpadu
                        </h4>
                        <p style="color: #666; margin: 0;">Mengintegrasikan kurikulum nasional (Kurikulum Merdeka) dengan nilai-nilai Islam dan pembelajaran Al-Quran.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1.5rem; margin-bottom: 1.5rem; background: white; border-left: 4px solid var(--primary-blue); border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <h4 style="color: var(--dark-blue); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-chalkboard-user" style="color: var(--primary-blue); margin-right: 0.5rem;"></i>
                            Guru Profesional
                        </h4>
                        <p style="color: #666; margin: 0;">Tenaga pengajar berpengalaman dan bersertifikasi yang memahami pendidikan anak usia sekolah dasar.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1.5rem; margin-bottom: 1.5rem; background: white; border-left: 4px solid var(--primary-blue); border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <h4 style="color: var(--dark-blue); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-mosque" style="color: var(--primary-blue); margin-right: 0.5rem;"></i>
                            Program Tahfidz Al-Quran
                        </h4>
                        <p style="color: #666; margin: 0;">Program unggulan hafalan Al-Quran dengan target minimal 3 juz selama masa sekolah dasar.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="padding: 1.5rem; margin-bottom: 1.5rem; background: white; border-left: 4px solid var(--primary-blue); border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <h4 style="color: var(--dark-blue); font-weight: 600; margin-bottom: 0.5rem;">
                            <i class="fas fa-heart" style="color: var(--primary-blue); margin-right: 0.5rem;"></i>
                            Pendidikan Karakter Islami
                        </h4>
                        <p style="color: #666; margin: 0;">Pembinaan akhlak dan karakter siswa melalui pembiasaan ibadah, adab, dan nilai-nilai keislaman.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div style="margin-top: 4rem; padding: 3rem; background: linear-gradient(135deg, var(--primary-blue) 0%, #0052a3 100%); border-radius: 12px; color: white;">
            <div class="row text-center">
                <div class="col-md-3">
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $settings['about_stat_branches'] ?? '6' }}</h3>
                    <p style="margin: 0;">Kelas Paralel</p>
                </div>
                <div class="col-md-3">
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $settings['about_stat_teachers'] ?? '30+' }}</h3>
                    <p style="margin: 0;">Tenaga Pengajar</p>
                </div>
                <div class="col-md-3">
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $settings['about_stat_students'] ?? '300+' }}</h3>
                    <p style="margin: 0;">Peserta Didik</p>
                </div>
                <div class="col-md-3">
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $settings['about_stat_years'] ?? '10+' }}</h3>
                    <p style="margin: 0;">Tahun Berpengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
