@extends('layouts.app')

@section('title', 'Labitech Insan Mulia - Labitech.sch.id')

@section('content')
<!-- ====== HOME SECTION ====== -->
<section id="section-home" style="padding: 3rem 0; background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; position: relative; overflow: hidden;">
    <!-- Decorative elements -->
    <div style="position: absolute; top: -50%; right: -5%; width: 800px; height: 800px; background: rgba(255, 215, 0, 0.05); border-radius: 50%; z-index: 0;"></div>
    <div style="position: absolute; bottom: -30%; left: 0; width: 600px; height: 600px; background: rgba(255, 215, 0, 0.03); border-radius: 50%; z-index: 0;"></div>
    
    <div class="container-lg" style="position: relative; z-index: 1;">
        <div class="row align-items-start" style="min-height: auto; padding: 2rem 0;">
            <!-- Left Column - Logo, Tagline & Campus Cards -->
            <div class="col-lg-5" style="padding: 2rem;">
                <!-- Logo & Tagline -->
                <div style="text-align: center; margin-bottom: 2rem; display: flex; flex-direction: column; align-items: center;">
                    <img src="{{ asset('images/logo.png') }}" alt="Labitech Logo" style="height: 140px; width: auto; margin-bottom: 1.5rem; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2)); animation: float 3s ease-in-out infinite;">
                    <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0.5rem 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); line-height: 1.2;">Labitech Insan Mulia</h1>
                    <p style="font-size: 0.95rem; margin: 0.5rem 0; opacity: 0.95;">www.labitech.sch.id</p>
                    <p style="font-size: 0.85rem; color: var(--secondary-yellow); font-weight: 600; margin: 0.5rem 0;">Iman - Ilmu - Amal</p>
                </div>

                <!-- Campus Cards Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    @foreach($branches as $branch)
                        @if($branch->is_active)
                        {{-- Active Branch - clickable with hover --}}
                        <div style="background: rgba(59, 89, 152, 0.95); color: white; border-radius: 10px; padding: 1rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.2); transition: all 0.3s; cursor: pointer;" onmouseover="this.style.background='#ffd700'; this.style.color='#1a3a5c'; this.style.transform='translateY(-5px)'" onmouseout="this.style.background='rgba(59, 89, 152, 0.95)'; this.style.color='white'; this.style.transform='translateY(0)'">
                            <div style="background: white; width: 50px; height: 50px; border-radius: 8px; flex-shrink: 0;"></div>
                            <div style="flex-grow: 1;">
                                <p style="margin: 0; font-size: 0.75rem; font-weight: 600; opacity: 0.9;">BRANCH</p>
                                <p style="margin: 0.25rem 0 0 0; font-size: 0.85rem; font-weight: 700;">{{ strtoupper($branch->name) }}</p>
                            </div>
                        </div>
                        @else
                        {{-- Disabled Branch - Coming Soon, not clickable --}}
                        <div style="background: rgba(100, 100, 120, 0.6); color: rgba(255,255,255,0.5); border-radius: 10px; padding: 1rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); cursor: not-allowed; position: relative; user-select: none; pointer-events: none;">
                            <div style="background: rgba(255,255,255,0.3); width: 50px; height: 50px; border-radius: 8px; flex-shrink: 0;"></div>
                            <div style="flex-grow: 1;">
                                <p style="margin: 0; font-size: 0.75rem; font-weight: 600; opacity: 0.7;">BRANCH</p>
                                <p style="margin: 0.25rem 0 0 0; font-size: 0.85rem; font-weight: 700;">{{ strtoupper($branch->name) }}</p>
                            </div>
                            <span style="position: absolute; top: 6px; right: 8px; background: rgba(255,165,0,0.85); color: white; font-size: 0.55rem; font-weight: 700; padding: 2px 6px; border-radius: 4px; letter-spacing: 0.5px;">COMING SOON</span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Right Column - Content & CTA -->
            <div class="col-lg-7" style="padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
                <img src="https://via.placeholder.com/500x350?text=Siswa+INSAN+MULIA" alt="Siswa" style="width: 100%; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); margin-bottom: 1.5rem;">
                
                <!-- Admission Banner -->
                @php
                    $bannerSubtitle = $homepageSettings['homepage_banner_subtitle'] ?? 'DAFTAR SEKARANG';
                    $bannerTitle = $homepageSettings['homepage_banner_title'] ?? 'Penerimaan Siswa Baru 2026';
                    $bannerLink = $homepageSettings['homepage_banner_link'] ?? '';
                @endphp
                @if(!empty($bannerLink))
                <a href="{{ $bannerLink }}" style="text-decoration: none; color: inherit;">
                @endif
                <div style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0052a3 100%); border-radius: 10px; padding: 1rem 1.5rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 8px 25px rgba(0,0,0,0.2);{{ !empty($bannerLink) ? ' cursor: pointer; transition: transform 0.3s;' : '' }}"
                    @if(!empty($bannerLink)) onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'" @endif>
                    <div style="background: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-bullhorn" style="color: var(--primary-blue); font-size: 1.5rem;"></i>
                    </div>
                    <div>
                        <p style="margin: 0; font-size: 0.85rem; opacity: 0.9; color: white;">{{ $bannerSubtitle }}</p>
                        <p style="margin: 0.25rem 0 0 0; font-size: 1rem; font-weight: 700; color: white;">{{ $bannerTitle }}</p>
                    </div>
                </div>
                @if(!empty($bannerLink))
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- ====== TENTANG KAMI SECTION ====== -->
<section id="section-tentang" style="padding: 3rem 0;">
    <div class="container-lg">
        <!-- Section Header -->
        <div style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 3rem; border-radius: 12px; margin-bottom: 3rem;">
            <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Tentang Kami</h1>
            <p style="margin-top: 0.5rem; font-size: 1.1rem; opacity: 0.9;">Mengenal lebih dalam tentang SDIT Labitech Insan Mulia</p>
        </div>

        <div class="row gap-5">
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x400?text=SDIT+Labitech+Insan+Mulia" alt="Sekolah SDIT Labitech Insan Mulia" style="width: 100%; border-radius: 12px; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
            </div>
            <div class="col-lg-6">
                <h2 style="font-size: 2rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;">
                    SDIT Labitech Insan Mulia
                </h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 1rem;">
                    {{ $aboutSettings['about_description_1'] ?? 'SDIT Labitech Insan Mulia (Sekolah Dasar Islam Terpadu Labitech Insan Mulia) adalah lembaga pendidikan tingkat sekolah dasar yang berbasis Islam Terpadu. Kami berkomitmen untuk menjadi pusat pembelajaran yang menggabungkan kurikulum nasional dengan nilai-nilai Islam.' }}
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 1rem;">
                    {{ $aboutSettings['about_description_2'] ?? 'Dengan visi menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global, kami terus berinovasi dalam mengembangkan kurikulum dan metode pembelajaran.' }}
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555;">
                    {{ $aboutSettings['about_description_3'] ?? 'SDIT Labitech Insan Mulia berlokasi di Kota Bekasi, Jawa Barat dan terus berkomitmen untuk menjangkau lebih banyak peserta didik yang ingin mendapatkan pendidikan berkualitas berbasis Islam.' }}
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
                            {{ $aboutSettings['about_vision'] ?? 'Menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global.' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div style="text-align: center; padding: 1.5rem;">
                        <i class="fas fa-target" style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1rem;">Misi</h3>
                        <p style="color: #666; line-height: 1.6;">
                            {{ $aboutSettings['about_mission'] ?? 'Menyelenggarakan pendidikan berkualitas dengan metode pembelajaran inovatif dan membentuk generasi yang berdisiplin dan bermoral tinggi.' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div style="text-align: center; padding: 1.5rem;">
                        <i class="fas fa-star" style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 1rem;">Nilai</h3>
                        <p style="color: #666; line-height: 1.6;">
                            {{ $aboutSettings['about_values'] ?? 'Integritas, Keunggulan, Inovasi, Kerjasama, dan Pengabdian untuk menciptakan lingkungan belajar yang positif.' }}
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
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $aboutSettings['about_stat_branches'] ?? '6' }}</h3>
                    <p style="margin: 0;">Kelas Paralel</p>
                </div>
                <div class="col-md-3">
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $aboutSettings['about_stat_teachers'] ?? '30+' }}</h3>
                    <p style="margin: 0;">Tenaga Pengajar</p>
                </div>
                <div class="col-md-3">
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $aboutSettings['about_stat_students'] ?? '300+' }}</h3>
                    <p style="margin: 0;">Peserta Didik</p>
                </div>
                <div class="col-md-3">
                    <h3 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $aboutSettings['about_stat_years'] ?? '10+' }}</h3>
                    <p style="margin: 0;">Tahun Berpengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== BERITA SECTION ====== -->
<section id="section-berita" class="news-section">
    <div class="container-lg">
        <!-- News Header dengan Label -->
        <div style="margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
            <div style="background-color: var(--secondary-yellow); padding: 0.5rem 1.2rem; border-radius: 8px; font-weight: 600; color: var(--dark-blue); font-size: 0.95rem;">
                Berita Labitech
            </div>
            <div style="text-align: left;">
                <p style="margin: 0; font-size: 0.9rem; color: #666;">Informasi terkini dari sekolah kami</p>
            </div>
        </div>

        <!-- News Grid -->
        <div class="row">
            @forelse($latestNews as $news)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card">
                        @if($news->featured_image)
                            <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x300?text={{ urlencode($news->title) }}" alt="{{ $news->title }}">
                        @endif
                        <div class="news-card-body">
                            <div class="news-card-title">{{ $news->title }}</div>
                            <div class="news-card-date">{{ $news->published_at->format('d F Y') }}</div>
                            <a href="{{ route('news.show', $news) }}" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p style="text-align: center; color: #999;">Tidak ada berita tersedia.</p>
                </div>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('news') }}" class="btn btn-primary" style="padding: 0.75rem 2.5rem; font-weight: 600; font-size: 1.1rem;">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- YouTube Section -->
<section class="youtube-section">
    <div class="container-lg">
        <div class="youtube-content">
            <div class="youtube-text">
                <h2>LABITECH TV<br>ON YOUTUBE</h2>
                <p style="font-size: 1.1rem; color: #666; line-height: 1.6;">
                    Tonton konten eksklusif kami di YouTube channel SDIT Labitech Insan Mulia untuk mendapatkan informasi terkini, tutorial, dan dokumentasi kegiatan-kegiatan sekolah.
                </p>
                <a href="#" class="btn btn-primary" style="margin-top: 1.5rem; padding: 0.75rem 2rem; font-weight: 600;">
                    <i class="fab fa-youtube"></i> Subscribe YouTube
                </a>
            </div>
            <div class="youtube-video">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<!-- ====== KONTAK SECTION ====== -->
<section id="section-kontak" style="padding: 4rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <!-- Section Header -->
        <div style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 3rem; border-radius: 12px; margin-bottom: 3rem; text-align: center;">
            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1rem;">Hubungi Kami</h1>
            <p style="font-size: 1.2rem; opacity: 0.9;">Kami siap membantu Anda dengan informasi lengkap tentang SDIT Labitech Insan Mulia</p>
        </div>

        <div class="row">
            <!-- Contact Info Cards -->
            <div class="col-lg-6" style="margin-bottom: 2rem;">
                <h2 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 2rem; font-size: 2rem;">Informasi Kontak</h2>

                <!-- Email Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--primary-blue); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-envelope" style="color: white; font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Email</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Hubungi via email</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">{{ $contactSettings['contact_email'] ?? 'labitechunggulbermutu@gmail.com' }}</p>
                </div>

                <!-- Phone Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--primary-blue); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-phone" style="color: white; font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Nomor Telepon</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Hubungi langsung kami</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--primary-blue); font-weight: 600; font-size: 1.1rem;">{{ $contactSettings['contact_phone'] ?? '+62 816262619' }}</p>
                </div>

                <!-- Address Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--primary-blue); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt" style="color: white; font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Alamat</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Kunjungi kantor kami</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: #333; font-weight: 500; line-height: 1.6;">{{ $contactSettings['contact_address'] ?? 'Jl. Kutilang No.3, RT.001/RW.003, Jatimakmur, Kec. Pd. Gede, Kota Bks, Jawa Barat' }}</p>
                </div>
            </div>

            <!-- School Info Cards -->
            <div class="col-lg-6" style="margin-bottom: 2rem;">
                <h2 style="color: var(--dark-blue); font-weight: 700; margin-bottom: 2rem; font-size: 2rem;">Informasi Sekolah</h2>

                <!-- School Name Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--secondary-yellow); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-school" style="color: var(--dark-blue); font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Nama Sekolah</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Identitas sekolah</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--dark-blue); font-weight: 600; font-size: 1.1rem;">{{ $contactSettings['contact_school_name'] ?? 'SDIT Labitech Insan Mulia' }}</p>
                </div>

                <!-- Level Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--secondary-yellow); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-graduation-cap" style="color: var(--dark-blue); font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Jenjang Pendidikan</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Tingkat sekolah</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--dark-blue); font-weight: 600; font-size: 1.1rem;">{{ $contactSettings['contact_school_level'] ?? 'SD (Sekolah Dasar)' }}</p>
                </div>

                <!-- Mission Card -->
                <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="background: var(--secondary-yellow); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-heart" style="color: var(--dark-blue); font-size: 1.8rem;"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0; color: var(--dark-blue); font-weight: 700;">Motto</h3>
                            <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem;">Semangat kami</p>
                        </div>
                    </div>
                    <p style="margin: 0; color: var(--dark-blue); font-weight: 600; font-size: 1.1rem;">{{ $contactSettings['contact_motto'] ?? 'Iman - Ilmu - Amal' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section style="padding: 4rem 0; background: white;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="text-align: center; margin-bottom: 2.5rem;">
                    <h2 style="color: var(--dark-blue); font-weight: 700; font-size: 2rem;">Kirim Pesan</h2>
                    <p style="color: #666; font-size: 1.05rem;">Ada pertanyaan? Silakan kirim pesan melalui form berikut</p>
                </div>

                @if(session('contact_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; border: none; box-shadow: 0 2px 8px rgba(40,167,69,0.15);">
                        <i class="fas fa-check-circle me-2"></i>{{ session('contact_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send') }}" style="background: #f8f9fa; border-radius: 16px; padding: 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.06);">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;" placeholder="Nama Anda">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;" placeholder="email@contoh.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">No. Telepon / WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Subjek <span class="text-danger">*</span></label>
                            <select name="subject" required class="form-select" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8;">
                                <option value="">Pilih subjek...</option>
                                <option value="Informasi PPDB" {{ old('subject') == 'Informasi PPDB' ? 'selected' : '' }}>Informasi PPDB</option>
                                <option value="Informasi Akademik" {{ old('subject') == 'Informasi Akademik' ? 'selected' : '' }}>Informasi Akademik</option>
                                <option value="Pertanyaan Umum" {{ old('subject') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                                <option value="Saran & Masukan" {{ old('subject') == 'Saran & Masukan' ? 'selected' : '' }}>Saran & Masukan</option>
                                <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 600; color: var(--dark-blue); margin-bottom: 0.4rem; display: block;">Pesan <span class="text-danger">*</span></label>
                        <textarea name="message" rows="5" required class="form-control" style="border-radius: 10px; padding: 0.75rem 1rem; border: 2px solid #e8e8e8; resize: vertical;" placeholder="Tulis pesan Anda di sini...">{{ old('message') }}</textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="padding: 0.75rem 3rem; border-radius: 10px; font-weight: 600; font-size: 1.05rem; background: linear-gradient(135deg, var(--primary-blue), #0052a3); border: none; box-shadow: 0 4px 15px rgba(0,102,204,0.3);">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
