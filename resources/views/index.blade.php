@extends('layouts.app')

@section('title', 'Laboratorium Islamic Technology-Labitech - Labitech.sch.id')

@section('content')
<!-- ====== HOME SECTION ====== -->
<section id="section-home" style="padding: 3rem 0; padding-top: 4rem; background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; position: relative; overflow: hidden;">
    <!-- Decorative elements -->
    <div style="position: absolute; top: -50%; right: -5%; width: 800px; height: 800px; background: rgba(255, 215, 0, 0.05); border-radius: 50%; z-index: 0;"></div>
    <div style="position: absolute; bottom: -30%; left: 0; width: 600px; height: 600px; background: rgba(255, 215, 0, 0.03); border-radius: 50%; z-index: 0;"></div>
    
    <div class="container-lg" style="position: relative; z-index: 1;">
        <div class="row align-items-start" style="min-height: auto; padding: 2rem 0;">
            <!-- Left Column - Logo, Tagline & Campus Cards -->
            <div class="col-lg-5" style="padding: 2rem;">
                <!-- Logo & Tagline -->
                <div style="text-align: center; margin-bottom: 2rem; display: flex; flex-direction: column; align-items: center;">
                    <img src="{{ asset('images/logo2.png') }}" alt="Labitech Logo" style="width: 100%; max-width: 360px; height: auto; filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3)); animation: float 3s ease-in-out infinite;">
                    <p style="font-size: 0.95rem; margin: 0.75rem 0 0.25rem; opacity: 0.95;">www.labitech.sch.id</p>
                    <p style="font-size: 0.85rem; color: var(--secondary-yellow); font-weight: 600; margin: 0;">{{ $contactSettings['contact_motto'] ?? 'Iman - Ilmu - Amal' }}</p>
                </div>

                <!-- Campus Cards Grid -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    @foreach($branches as $branch)
                        @if($branch->is_active)
                        {{-- Active Branch - clickable, links to branch detail page --}}
                        @php $branchColor = $branch->color ?: 'rgba(59,89,152,0.95)'; @endphp
                        <a href="{{ $branch->slug ? route('branch.show', $branch->slug) : '#' }}"
                           style="background:{{ $branchColor }}; color:white; border-radius:10px; padding:1rem; display:flex; align-items:center; gap:0.75rem; box-shadow:0 4px 15px rgba(0,0,0,0.2); transition:all 0.2s; cursor:pointer; text-decoration:none; border:2px solid rgba(255,255,255,0.2);"
                           onmouseover="this.style.filter='brightness(1.15)'"
                           onmouseout="this.style.filter='brightness(1)'">
                            <div style="background:rgba(255,255,255,0.2); width:50px; height:50px; border-radius:8px; flex-shrink:0; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                                @if($branch->logo)
                                    <img src="{{ asset('storage/'.$branch->logo) }}" style="width:40px; height:40px; object-fit:contain;" alt="Logo">
                                @else
                                    <img src="{{ asset('images/logo1.png') }}" style="width:40px; height:40px; object-fit:contain; filter:brightness(0) invert(1);" alt="logo">
                                @endif
                            </div>
                            <div style="flex-grow:1;">
                                <p style="margin:0; font-size:0.65rem; font-weight:600; opacity:0.8; letter-spacing:0.3px;">{{ $branch->school_name ?: 'SD Labitech Insan Mulia' }}</p>
                                <p style="margin:0.2rem 0 0; font-size:0.85rem; font-weight:700;">{{ strtoupper($branch->name) }}</p>
                            </div>
                        </a>
                        @else
                        {{-- Disabled Branch - Coming Soon, not clickable --}}
                        <div style="background: rgba(100, 100, 120, 0.6); color: rgba(255,255,255,0.5); border-radius: 10px; padding: 1rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); cursor: not-allowed; position: relative; user-select: none; pointer-events: none;">
                            <div style="background: rgba(255,255,255,0.3); width: 50px; height: 50px; border-radius: 8px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <img src="{{ asset('images/logo1.png') }}" style="width: 36px; height: 36px; object-fit: contain; opacity: 0.4;" alt="logo">
                            </div>
                            <div style="flex-grow: 1;">
                                <p style="margin: 0; font-size: 0.65rem; font-weight: 600; opacity: 0.7;">SD Labitech Insan Mulia</p>
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
                {{-- Hero Carousel --}}
                @php
                    $heroSlides = array_filter([
                        $homepageSettings['homepage_hero_image']   ?? null,
                        $homepageSettings['homepage_hero_image_2'] ?? null,
                        $homepageSettings['homepage_hero_image_3'] ?? null,
                        $homepageSettings['homepage_hero_image_4'] ?? null,
                        $homepageSettings['homepage_hero_image_5'] ?? null,
                    ]);
                @endphp
                @if(count($heroSlides) > 0)
                <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000"
                     style="border-radius:12px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.3); margin-bottom:1.5rem;">
                    @if(count($heroSlides) > 1)
                    <div class="carousel-indicators">
                        @foreach(array_values($heroSlides) as $i => $slide)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                                {{ $i === 0 ? 'class=active aria-current=true' : '' }}
                                aria-label="Slide {{ $i + 1 }}"></button>
                        @endforeach
                    </div>
                    @endif
                    <div class="carousel-inner">
                        @foreach(array_values($heroSlides) as $i => $slide)
                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/'.$slide) }}" alt="Sekolah Labitech"
                                 style="width:100%; height:auto; object-fit:contain; display:block;">
                        </div>
                        @endforeach
                    </div>
                    @if(count($heroSlides) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                    @endif
                </div>
                @else
                    <div style="width:100%; height:260px; border-radius:12px; box-shadow:0 20px 60px rgba(0,0,0,0.3); margin-bottom:1.5rem; background:rgba(255,255,255,0.1); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.75rem; border:2px dashed rgba(255,255,255,0.3);">
                        <i class="fas fa-camera" style="font-size:2.5rem; color:rgba(255,255,255,0.4);"></i>
                        <p style="color:rgba(255,255,255,0.6); margin:0; font-size:0.9rem; font-weight:600;">Foto Sekolah</p>
                        <p style="color:rgba(255,255,255,0.35); margin:0; font-size:0.72rem;">Upload foto di Admin → Pengaturan → Halaman Utama</p>
                    </div>
                @endif
                
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
            <p style="margin-top: 0.5rem; font-size: 1.1rem; opacity: 0.9;">Mengenal lebih dalam tentang Laboratorium Islamic Technology-Labitech</p>
        </div>

        @php
            $aboutImage = $homepageSettings['homepage_about_image'] ?? null;
            $videoFile  = $homepageSettings['homepage_video_file'] ?? null;
        @endphp
        <div class="row g-4 align-items-center">
            {{-- Kolom kiri: video jika ada, lalu foto, lalu logo --}}
            <div class="col-lg-6">
                @if($videoFile)
                    <div style="position:relative; border-radius:14px; overflow:hidden; box-shadow:0 15px 40px rgba(0,0,0,0.15);">
                        <video id="schoolVideo" controls autoplay muted loop playsinline style="width:100%; display:block;">
                            <source src="{{ asset('storage/'.$videoFile) }}" type="video/mp4">
                            <source src="{{ asset('storage/'.$videoFile) }}" type="video/webm">
                        </video>
                        <button id="unmuteBtn" onclick="
                            var v = document.getElementById('schoolVideo');
                            var b = document.getElementById('unmuteBtn');
                            if(v.muted){ v.muted=false; b.innerHTML='<i class=\'fas fa-volume-mute\'></i> Matikan Suara'; }
                            else { v.muted=true; b.innerHTML='<i class=\'fas fa-volume-up\'></i> Aktifkan Suara'; }
                        " style="position:absolute; bottom:12px; right:12px; background:rgba(0,0,0,0.65); color:white; border:none; border-radius:8px; padding:0.4rem 0.9rem; font-size:0.82rem; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; backdrop-filter:blur(4px);">
                            <i class="fas fa-volume-up"></i> Aktifkan Suara
                        </button>
                    </div>
                @elseif($aboutImage)
                    <img src="{{ asset('storage/'.$aboutImage) }}" alt="Foto Sekolah"
                         style="width:100%; aspect-ratio:5/4; border-radius:12px; object-fit:cover; box-shadow:0 15px 40px rgba(0,0,0,0.1);">
                @else
                    <div style="width:100%; aspect-ratio:5/4; border-radius:12px; box-shadow:0 15px 40px rgba(0,0,0,0.1); background:linear-gradient(135deg,#e8f0fb 0%,#f0f4ff 100%); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:1rem;">
                        <img src="{{ asset('images/logo.png') }}" style="height:110px; width:auto;" alt="logo Labitech">
                        <p style="color:var(--dark-blue); margin:0; font-size:1.1rem; font-weight:700;">Laboratorium Islamic Technology-Labitech</p>
                        <p style="color:#888; margin:0; font-size:0.85rem;">Bekasi, Jawa Barat</p>
                    </div>
                @endif
            </div>
            <div class="col-lg-6">
                <h2 style="font-size: 2rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 1.5rem;">
                    Laboratorium Islamic Technology-Labitech
                </h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 1rem;">
                    {{ $aboutSettings['about_description_1'] ?? 'Laboratorium Islamic Technology-Labitech (Sekolah Dasar Islam Terpadu Labitech Insan Mulia) adalah lembaga pendidikan tingkat sekolah dasar yang berbasis Islam Terpadu. Kami berkomitmen untuk menjadi pusat pembelajaran yang menggabungkan kurikulum nasional dengan nilai-nilai Islam.' }}
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 1rem;">
                    {{ $aboutSettings['about_description_2'] ?? 'Dengan visi menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global, kami terus berinovasi dalam mengembangkan kurikulum dan metode pembelajaran.' }}
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555;">
                    {{ $aboutSettings['about_description_3'] ?? 'Laboratorium Islamic Technology-Labitech berlokasi di Kota Bekasi, Jawa Barat dan terus berkomitmen untuk menjangkau lebih banyak peserta didik yang ingin mendapatkan pendidikan berkualitas berbasis Islam.' }}
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
                        <i class="fas fa-bullseye" style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
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

        <!-- 7 Kompetensi -->
        <div style="margin-top: 4rem;">
            <h2 style="text-align: center; font-size: 2rem; color: var(--dark-blue); font-weight: 700; margin-bottom: 0.5rem;">7 Kompetensi Unggulan</h2>
            <p style="text-align:center; color:#888; margin-bottom:2.5rem;">Program pengembangan siswa menuju profil lulusan <strong>Sang Juara</strong></p>
            <div class="row g-3 justify-content-center">
                @php
                $kompetensi = [
                    ['icon'=>'fas fa-crown',        'judul'=>'Leadership',    'desc'=>'Membentuk jiwa kepemimpinan sejak dini melalui program organisasi dan kegiatan terstruktur.'],
                    ['icon'=>'fas fa-heart',         'judul'=>'Akhlak',        'desc'=>'Membangun karakter mulia, adab, dan moral islami dalam keseharian siswa.'],
                    ['icon'=>'fas fa-mosque',        'judul'=>'Islamic',       'desc'=>'Menanamkan nilai-nilai keislaman yang kuat sebagai pondasi kehidupan.'],
                    ['icon'=>'fas fa-laptop-code',   'judul'=>'Technology',    'desc'=>'Penguasaan teknologi dan coding dengan fasilitas laptop dan Smart TV di setiap kelas.'],
                    ['icon'=>'fas fa-store',         'judul'=>'Entrepreneur',  'desc'=>'Menumbuhkan jiwa wirausaha melalui program garden dan fish farming.'],
                    ['icon'=>'fas fa-trophy',        'judul'=>'Champion',      'desc'=>'Mencetak siswa berprestasi akademik dan non-akademik — Sekolahnya Para Juara!'],
                    ['icon'=>'fas fa-book-open',     'judul'=>'Hafizh',        'desc'=>'Target hafalan 5 Juz Al-Quran dengan jaminan baca Qur\'an yang fasih.'],
                ];
                @endphp
                @foreach($kompetensi as $k)
                <div class="col-md-6 col-lg-4">
                    <div style="padding:1.25rem 1.5rem; background:white; border-left:4px solid var(--primary-blue); border-radius:6px; box-shadow:0 2px 8px rgba(0,0,0,0.05); height:100%;">
                        <h5 style="color:var(--dark-blue); font-weight:700; margin-bottom:0.4rem;">
                            <i class="{{ $k['icon'] }}" style="color:var(--primary-blue); margin-right:0.5rem;"></i>{{ $k['judul'] }}
                        </h5>
                        <p style="color:#666; margin:0; font-size:0.9rem; line-height:1.6;">{{ $k['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Fasilitas -->
        <div style="margin-top:4rem;">
            <h2 style="text-align:center; font-size:2rem; color:var(--dark-blue); font-weight:700; margin-bottom:2.5rem;">Fasilitas Unggulan</h2>
            <div class="row g-3">
                @php
                $fasilitas = [
                    ['icon'=>'fas fa-mobile-alt',    'nama'=>'Apps Juara',           'desc'=>'LMS lengkap: data murid, keuangan, ujian online, rapot & sertifikat digital.'],
                    ['icon'=>'fas fa-tv',            'nama'=>'Smart TV Kelas',        'desc'=>'Setiap ruang kelas dilengkapi Android Smart TV untuk pembelajaran interaktif.'],
                    ['icon'=>'fas fa-laptop',        'nama'=>'Perangkat Coding',      'desc'=>'Laptop tersedia untuk program belajar Coding dan penguasaan teknologi.'],
                    ['icon'=>'fas fa-box',           'nama'=>'Loker Siswa',           'desc'=>'Loker pribadi yang aman untuk setiap murid.'],
                    ['icon'=>'fas fa-running',       'nama'=>'Lapangan Olahraga',     'desc'=>'Lapangan luas untuk kegiatan olahraga dan pengembangan fisik siswa.'],
                    ['icon'=>'fas fa-pray',          'nama'=>'Ruang Ibadah',          'desc'=>'Masjid/musholla untuk menunjang kegiatan ibadah dan pembinaan spiritual.'],
                    ['icon'=>'fas fa-seedling',      'nama'=>'Garden & Fish Farming', 'desc'=>'Area praktik kewirausahaan: berkebun dan budidaya ikan.'],
                    ['icon'=>'fas fa-restroom',      'nama'=>'Toilet Modern',         'desc'=>'Fasilitas sanitasi higienis dan modern untuk kenyamanan siswa.'],
                ];
                @endphp
                @foreach($fasilitas as $f)
                <div class="col-md-6 col-lg-3">
                    <div style="padding:1.25rem; background:white; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,0.06); text-align:center; height:100%;">
                        <div style="width:52px; height:52px; background:linear-gradient(135deg,var(--primary-blue),var(--dark-blue)); border-radius:12px; display:flex; align-items:center; justify-content:center; margin:0 auto 0.75rem;">
                            <i class="{{ $f['icon'] }}" style="color:white; font-size:1.2rem;"></i>
                        </div>
                        <h6 style="color:var(--dark-blue); font-weight:700; margin-bottom:0.35rem;">{{ $f['nama'] }}</h6>
                        <p style="color:#888; margin:0; font-size:0.82rem; line-height:1.5;">{{ $f['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Profil Lulusan -->
        <div style="margin-top:4rem; padding:3rem; background:linear-gradient(135deg,var(--dark-blue),#2d5a8c); border-radius:14px; color:white;">
            <h2 style="text-align:center; font-size:1.8rem; font-weight:800; margin-bottom:0.5rem;">Profil Lulusan</h2>
            <p style="text-align:center; opacity:0.8; margin-bottom:2rem;">7 Jaminan Kompetensi Siswa SDIT Labitech Insan Mulia</p>
            <div class="row g-3 justify-content-center">
                @php
                $lulusan = [
                    ['no'=>'01', 'text'=>'Memiliki Akhlak Mulia'],
                    ['no'=>'02', 'text'=>'Jiwa Leadership & Sang Juara'],
                    ['no'=>'03', 'text'=>'Jaminan Baca Qur\'an yang Fasih'],
                    ['no'=>'04', 'text'=>'Hafalan 5 Juz Al-Qur\'an'],
                    ['no'=>'05', 'text'=>'Komunikasi dalam Bahasa Inggris'],
                    ['no'=>'06', 'text'=>'Penguasaan Teknologi'],
                    ['no'=>'07', 'text'=>'Minat & Bakat Terasah (MBM)'],
                ];
                @endphp
                @foreach($lulusan as $l)
                <div class="col-md-6">
                    <div style="display:flex; align-items:center; gap:1rem; padding:0.75rem 1rem; background:rgba(255,255,255,0.1); border-radius:8px;">
                        <span style="font-size:1.4rem; font-weight:900; color:var(--secondary-yellow); min-width:36px;">{{ $l['no'] }}</span>
                        <span style="font-weight:600; font-size:0.95rem;">{{ $l['text'] }}</span>
                    </div>
                </div>
                @endforeach
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
                            <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div style="display:none; width:100%; aspect-ratio:4/3; background:linear-gradient(135deg,#e8f0fb,#dde8ff); align-items:center; justify-content:center; flex-direction:column; gap:0.5rem;">
                                <img src="{{ asset('images/logo.png') }}" style="height:50px;width:auto;opacity:0.5;" alt="">
                                <span style="font-size:0.75rem;color:#aaa;text-align:center;padding:0 1rem;">{{ Str::limit($news->title, 40) }}</span>
                            </div>
                        @else
                            <div style="width:100%; aspect-ratio:4/3; background: linear-gradient(135deg, #e8f0fb 0%, #dde8ff 100%); display:flex; align-items:center; justify-content:center; flex-direction:column; gap:0.5rem;">
                                <img src="{{ asset('images/logo.png') }}" style="height:50px; width:auto; opacity:0.5;" alt="">
                                <span style="font-size:0.75rem; color:#aaa; text-align:center; padding:0 1rem;">{{ Str::limit($news->title, 40) }}</span>
                            </div>
                        @endif
                        <div class="news-card-body">
                            <div class="news-card-title">{{ $news->title }}</div>
                            <div class="news-card-date">{{ ($news->published_at ?? $news->created_at)->format('d F Y') }}</div>
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

@php
    $videoUrl = $homepageSettings['homepage_video_url'] ?? '';
    $videoEmbedUrl = '';
    if ($videoUrl) {
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([A-Za-z0-9_\-]{11})/', $videoUrl, $m);
        if (!empty($m[1])) { $videoEmbedUrl = 'https://www.youtube.com/embed/' . $m[1]; }
    }
@endphp
@if($videoEmbedUrl)
<!-- YouTube Section -->
<section class="youtube-section">
    <div class="container-lg">
        <div class="youtube-content">
            <div class="youtube-text">
                <h2>LABITECH TV<br>ON YOUTUBE</h2>
                <p style="font-size: 1.1rem; color: #666; line-height: 1.6;">
                    Tonton video dan konten eksklusif Laboratorium Islamic Technology-Labitech di YouTube untuk informasi terkini dan dokumentasi kegiatan sekolah.
                </p>
                <a href="{{ $videoUrl }}" target="_blank" class="btn btn-primary" style="margin-top: 1.5rem; padding: 0.75rem 2rem; font-weight: 600;">
                    <i class="fab fa-youtube me-1"></i> Tonton di YouTube
                </a>
            </div>
            <div class="youtube-video">
                <iframe src="{{ $videoEmbedUrl }}" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ====== KONTAK SECTION ====== -->
<section id="section-kontak" style="padding: 4rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <!-- Section Header -->
        <div style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 3rem; border-radius: 12px; margin-bottom: 3rem; text-align: center;">
            <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1rem;">Hubungi Kami</h1>
            <p style="font-size: 1.2rem; opacity: 0.9;">Kami siap membantu Anda dengan informasi lengkap tentang Laboratorium Islamic Technology-Labitech</p>
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
                    <p style="margin: 0; color: var(--dark-blue); font-weight: 600; font-size: 1.1rem;">{{ $contactSettings['contact_school_name'] ?? 'Laboratorium Islamic Technology-Labitech' }}</p>
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
