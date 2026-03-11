<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Labitech Insan Mulia - Labitech.sch.id')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <style>
        :root {
            --primary-blue: #0066cc;
            --secondary-yellow: #ffd700;
            --dark-blue: #1a3a5c;
            --light-gray: #f8f9fa;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Offset for sticky navbar */
        section[id^="section-"] {
            scroll-margin-top: 70px;
        }
        
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #fff;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Navbar Styles */
        .navbar-custom {
            background-color: var(--dark-blue);
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            /* Shadow dihapus di sini, akan ditambahkan via JS saat scroll */
        }
        
        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            white-space: nowrap;
        }
        
        .navbar-custom .navbar-brand img {
            height: 40px;
            width: auto;
        }
        
        .navbar-custom .navbar-brand span {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Class tambahan saat navbar di-scroll */
        .navbar-custom.scrolled {
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .navbar-custom .nav-link {
            color: white !important;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
            padding: 0.5rem 0.75rem !important;
        }
        
        .navbar-custom .nav-link:hover {
            color: var(--secondary-yellow) !important;
        }

        /* Pastikan ikon berubah menjadi kuning saat menu di-hover */
        .navbar-custom .nav-link:hover i {
            color: var(--secondary-yellow) !important;
        }
        
        /* Active Nav Link - Clean Square Box */
        .navbar-custom .nav-link.active {
            color: var(--secondary-yellow) !important;
            font-weight: 600;
            background-color: #1a3a5c;
            border: 2px solid #1a3a5c;
            border-radius: 0px;
            padding: 0.5rem 1rem !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            border-bottom: 3px solid var(--secondary-yellow);
        }
        
        .navbar-custom .nav-link.active:hover {
            background-color: #1a3a5c;
            color: var(--secondary-yellow) !important;
            transform: translateY(-3px);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%);
            color: white;
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 50%;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        /* Labschool Cards */
        .labschool-card {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: not-allowed; /* Menunjukkan tidak bisa dipilih */
            opacity: 0.8;
            position: relative;
            overflow: hidden;
        }
        
        .labschool-card:hover {
            transform: none;
            box-shadow: none;
        }

        /* Label Segera Hadir (Stempel) */
        .labschool-card::after {
            content: "SEGERA HADIR";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-10deg);
            background-color: var(--secondary-yellow);
            color: var(--dark-blue);
            padding: 0.5rem 1.5rem;
            font-weight: 800;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            border: 2px dashed var(--dark-blue);
            z-index: 10;
            white-space: nowrap;
        }
        
        .labschool-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 1rem;
            border: 3px solid white;
        }
        
        .labschool-card-content {
            display: flex;
            align-items: center;
        }
        
        .labschool-card h5 {
            margin: 0;
            font-weight: 600;
        }
        
        /* News Section */
        .news-section {
            padding: 3rem 0;
            background-color: var(--light-gray);
        }
        
        .news-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .news-header h2 {
            font-size: 2.5rem;
            color: var(--dark-blue);
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .news-header .yellow-line {
            width: 100px;
            height: 4px;
            background-color: var(--secondary-yellow);
            margin: 0 auto;
        }
        
        .news-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        
        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .news-card-body {
            padding: 1.5rem;
        }
        
        .news-card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }
        
        .news-card-date {
            font-size: 0.85rem;
            color: #999;
            margin-bottom: 1rem;
        }
        
        .read-more {
            color: var(--primary-blue);
            font-weight: 600;
            transition: color 0.3s;
        }
        
        .read-more:hover {
            color: var(--secondary-yellow);
        }
        
        /* Button Styles */
        .btn {
            transition: all 0.3s ease;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-yellow);
            color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        /* YouTube Section */
        .youtube-section {
            padding: 3rem 0;
            background: white;
        }
        
        .youtube-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        
        .youtube-text h2 {
            font-size: 3rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 2rem;
            line-height: 1.2;
        }
        
        .youtube-video {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 12px;
        }
        
        .youtube-video iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        /* ===== FOOTER STYLES ===== */
        .footer {
            background: linear-gradient(160deg, #0d2137 0%, var(--dark-blue) 40%, #1e4976 100%);
            color: white;
            padding: 0 0 0;
            margin-top: 0;
            position: relative;
            bottom: 0;
            width: 100%;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 60px;
            right: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(255,215,0,0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .footer::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -60px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(0,102,204,0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .footer-wave {
            width: 100%;
            line-height: 0;
            margin-bottom: -1px;
        }

        .footer-wave svg {
            display: block;
            width: 100%;
            height: 60px;
        }

        .footer-main {
            padding: 3rem 0 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        main {
            flex: 1;
        }

        /* Footer headings */
        .footer h5 {
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
            letter-spacing: 0.5px;
        }

        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary-yellow), transparent);
            border-radius: 2px;
        }

        /* Footer links */
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links li a {
            color: rgba(255,255,255,0.7);
            transition: all 0.3s ease;
            font-size: 0.92rem;
            position: relative;
            padding-left: 0;
        }

        .footer-links li a::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1.5px;
            background: var(--secondary-yellow);
            transition: width 0.3s ease;
        }

        .footer-links li a:hover {
            color: var(--secondary-yellow);
            padding-left: 6px;
        }

        .footer-links li a:hover::before {
            width: 100%;
        }

        /* Subscribe section */
        .subscribe-section {
            margin-bottom: 1.5rem;
        }
        
        .subscribe-input {
            display: flex;
            gap: 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .subscribe-input input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: none;
            border-radius: 0;
            font-size: 0.88rem;
            background: rgba(255,255,255,0.95);
            color: #333;
            outline: none;
            transition: all 0.3s ease;
        }

        .subscribe-input input:focus {
            background: #fff;
            box-shadow: inset 0 0 0 2px var(--secondary-yellow);
        }

        .subscribe-input input::placeholder {
            color: #999;
        }
        
        .subscribe-input button {
            background: linear-gradient(135deg, var(--secondary-yellow), #ffb700);
            border: none;
            padding: 0.8rem 1.2rem;
            border-radius: 0;
            cursor: pointer;
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .subscribe-input button:hover {
            background: linear-gradient(135deg, #ffb700, var(--secondary-yellow));
            transform: scale(1.05);
        }

        .subscribe-input button:active {
            transform: scale(0.98);
        }
        
        /* Contact info */
        .contact-info {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .contact-info:hover {
            transform: translateX(5px);
        }
        
        .contact-info .ci-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            background: rgba(255,215,0,0.12);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.85rem;
            transition: all 0.3s ease;
        }

        .contact-info:hover .ci-icon {
            background: var(--secondary-yellow);
        }

        .contact-info .ci-icon i {
            color: var(--secondary-yellow);
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .contact-info:hover .ci-icon i {
            color: var(--dark-blue);
        }

        .contact-info span {
            color: rgba(255,255,255,0.8);
            font-size: 0.88rem;
            line-height: 1.5;
        }

        /* Social media icons */
        .social-icons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 0.5rem;
        }

        .social-icons a {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.08);
            color: white;
            font-size: 1.15rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .social-icons a:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .social-icons a.sc-facebook:hover {
            background: #1877F2;
            border-color: #1877F2;
        }

        .social-icons a.sc-twitter:hover {
            background: #1DA1F2;
            border-color: #1DA1F2;
        }

        .social-icons a.sc-instagram:hover {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            border-color: #dc2743;
        }

        .social-icons a.sc-youtube:hover {
            background: #FF0000;
            border-color: #FF0000;
        }

        .social-icons a.sc-whatsapp:hover {
            background: #25D366;
            border-color: #25D366;
        }

        /* Footer bottom */
        .footer-bottom {
            text-align: center;
            padding: 1.25rem 0;
            margin-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            position: relative;
            z-index: 1;
        }

        .footer-bottom a {
            color: var(--secondary-yellow);
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer-bottom a:hover {
            color: #fff;
        }

        /* Footer animations */
        @keyframes footerFadeInUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .footer-col {
            animation: footerFadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .footer-col:nth-child(1) { animation-delay: 0.1s; }
        .footer-col:nth-child(2) { animation-delay: 0.25s; }
        .footer-col:nth-child(3) { animation-delay: 0.4s; }
        .footer-col:nth-child(4) { animation-delay: 0.55s; }

        /* Footer responsive */
        @media (max-width: 991px) {
            .footer-main {
                padding: 2.5rem 0 1rem;
            }
        }

        @media (max-width: 767px) {
            .footer h5::after {
                left: 50%;
                transform: translateX(-50%);
            }
            .footer-col {
                text-align: center;
            }
            .social-icons {
                justify-content: center;
            }
            .contact-info {
                justify-content: center;
            }
            .subscribe-input {
                max-width: 320px;
                margin: 0 auto;
            }
            .footer-links li a::before {
                left: 50%;
                transform: translateX(-50%);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .youtube-content {
                grid-template-columns: 1fr;
            }
            
            .youtube-text h2 {
                font-size: 2rem;
            }
            
            .news-header h2 {
                font-size: 1.8rem;
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
    
    @yield('extra-css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
                <span>SDIT Labitech</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/#section-beranda') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tentang-kami') ? 'active' : '' }}" href="{{ url('/#section-tentang') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('berita*') ? 'active' : '' }}" href="{{ url('/#section-berita') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kontak') ? 'active' : '' }}" href="{{ url('/#section-kontak') }}">Kontak</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pendaftaranDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pendaftaran
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pendaftaranDropdown">
                            <li><a class="dropdown-item" href="{{ route('pendaftaran') }}">Siswa Baru</a></li>
                            <li><a class="dropdown-item" href="{{ route('pendaftaran-pindahan') }}">Siswa Pindahan</a></li>
                        </ul>
                    </li>

                    <!-- Search Form -->
                    <li class="nav-item ms-lg-2">
                        <form class="d-flex navbar-search" action="{{ route('search') }}" method="GET">
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="search" name="q" placeholder="Cari siswa, berita..." aria-label="Search" value="{{ request('q') }}">
                                <button class="btn btn-outline-light btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </li>

                    @guest
                        <li class="nav-item ms-lg-2">
                            <a href="{{ route('unified.login') }}" class="btn btn-login btn-sm">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarStudentDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-graduate me-1"></i> {{ Auth::guard('students')->user()->nama }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarStudentDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('student.dashboard') }}">
                                        <i class="fas fa-home fa-fw me-2"></i> Dashboard Siswa
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('student.profile') }}">
                                        <i class="fas fa-id-card fa-fw me-2"></i> Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('student.graduation.status') }}">
                                        <i class="fas fa-graduation-cap fa-fw me-2"></i> Status Kelulusan
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('unified.logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="background: none; border: none; padding: 0.5rem 1rem; cursor: pointer;">
                                            <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <!-- Wave Separator -->
        <div class="footer-wave">
            <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,40 C360,80 720,0 1080,40 C1260,60 1380,30 1440,40 L1440,60 L0,60 Z" fill="#0d2137" opacity="0.5"/>
                <path d="M0,50 C480,20 960,70 1440,30 L1440,60 L0,60 Z" fill="#0d2137" opacity="0.8"/>
                <path d="M0,55 C320,35 640,65 960,45 C1200,30 1360,55 1440,50 L1440,60 L0,60 Z" fill="#0d2137"/>
            </svg>
        </div>

        <div class="footer-main">
            <div class="container-lg">
                <div class="row">
                    <!-- Branding & Subscribe -->
                    <div class="col-lg-3 col-md-6 footer-col" style="margin-bottom: 2rem;">
                        <h5>
                            <i class="fas fa-graduation-cap" style="color: var(--secondary-yellow); margin-right: 0.5rem;"></i>LABITECH
                        </h5>
                        <p style="margin-bottom: 0.5rem; font-size: 0.95rem; font-weight: 500;">SDIT Labitech Insan Mulia</p>
                        <p style="margin-bottom: 1.25rem; font-size: 0.85rem; color: rgba(255,255,255,0.6);">SD (Sekolah Dasar)</p>
                        <div class="subscribe-section">
                            <label style="display: block; margin-bottom: 0.6rem; font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.8);">
                                <i class="fas fa-bell" style="margin-right: 0.4rem; color: var(--secondary-yellow); font-size: 0.8rem;"></i>Newsletter
                            </label>
                            <div class="subscribe-input">
                                <input type="email" placeholder="Email Anda">
                                <button type="submit"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- Kontak Info -->
                    <div class="col-lg-3 col-md-6 footer-col" style="margin-bottom: 2rem;">
                        <h5>Kontak</h5>
                        <div class="contact-info">
                            <div class="ci-icon"><i class="fas fa-envelope"></i></div>
                            <span>labitechunggulbermutu@gmail.com</span>
                        </div>
                        <div class="contact-info">
                            <div class="ci-icon"><i class="fas fa-phone"></i></div>
                            <span>+62 816262619</span>
                        </div>
                        <div class="contact-info">
                            <div class="ci-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <span>Jl. Kutilang No.3, Jatimakmur, Bekasi, Jawa Barat</span>
                        </div>
                    </div>

                    <!-- Menu -->
                    <div class="col-lg-3 col-md-6 footer-col" style="margin-bottom: 2rem;">
                        <h5>Menu</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}#section-home"><i class="fas fa-chevron-right" style="font-size: 0.65rem; margin-right: 0.5rem; opacity: 0.5;"></i>Home</a></li>
                            <li><a href="{{ route('home') }}#section-tentang"><i class="fas fa-chevron-right" style="font-size: 0.65rem; margin-right: 0.5rem; opacity: 0.5;"></i>Tentang Kami</a></li>
                            <li><a href="{{ route('home') }}#section-berita"><i class="fas fa-chevron-right" style="font-size: 0.65rem; margin-right: 0.5rem; opacity: 0.5;"></i>Berita</a></li>
                            <li><a href="{{ route('home') }}#section-kontak"><i class="fas fa-chevron-right" style="font-size: 0.65rem; margin-right: 0.5rem; opacity: 0.5;"></i>Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Social Media -->
                    <div class="col-lg-3 col-md-6 footer-col" style="margin-bottom: 2rem;">
                        <h5>Ikuti Kami</h5>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6); margin-bottom: 1rem;">Tetap terhubung dengan kami di media sosial</p>
                        <div class="social-icons">
                            <a href="#" class="sc-facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="sc-twitter" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="sc-instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="sc-youtube" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="sc-whatsapp" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <p style="margin: 0;">&copy; {{ date('Y') }} <a href="{{ route('home') }}">Labitech Insan Mulia</a>. Semua hak dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SPA-like Smooth Scroll Navigation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navScrollLinks = document.querySelectorAll('.nav-scroll');
            const sections = document.querySelectorAll('section[id^="section-"]');
            const currentPath = window.location.pathname;
            const isHomePage = (currentPath === '/' || currentPath === '' || currentPath === '/index');

            // ===== SMOOTH SCROLL CLICK HANDLER =====
            navScrollLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const sectionId = this.getAttribute('data-section');
                    const targetSection = document.getElementById(sectionId);

                    // Jika berada di homepage dan section ada, scroll tanpa reload
                    if (isHomePage && targetSection) {
                        e.preventDefault();
                        targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });

                        // Update URL hash tanpa reload
                        history.pushState(null, null, '#' + sectionId);

                        // Update active state
                        navScrollLinks.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');

                        // Close mobile navbar if open
                        const navbarCollapse = document.getElementById('navbarNav');
                        if (navbarCollapse.classList.contains('show')) {
                            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                            if (bsCollapse) bsCollapse.hide();
                        }
                    }
                    // Jika bukan homepage, biarkan navigasi normal (ke homepage + anchor)
                });
            });

            // ===== INTERSECTION OBSERVER - Track visible section =====
            if (isHomePage && sections.length > 0) {
                const observerOptions = {
                    root: null,
                    rootMargin: '-80px 0px -50% 0px',
                    threshold: 0
                };

                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const sectionId = entry.target.getAttribute('id');
                            
                            // Update active nav link
                            navScrollLinks.forEach(link => {
                                link.classList.remove('active');
                                if (link.getAttribute('data-section') === sectionId) {
                                    link.classList.add('active');
                                }
                            });
                        }
                    });
                }, observerOptions);

                sections.forEach(section => observer.observe(section));

                // Set initial active state based on hash or default to home
                const hash = window.location.hash.replace('#', '');
                if (hash) {
                    const targetSection = document.getElementById(hash);
                    if (targetSection) {
                        setTimeout(() => {
                            targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }, 100);
                    }
                } else {
                    // Default: set Home as active
                    navScrollLinks.forEach(link => {
                        if (link.getAttribute('data-section') === 'section-home') {
                            link.classList.add('active');
                        }
                    });
                }
            } else if (!isHomePage) {
                // Non-homepage: highlight based on current path
                const pathMap = {
                    '/tentang-kami': 'section-tentang',
                    '/berita': 'section-berita',
                    '/kontak': 'section-kontak',
                    '/pendaftaran': null,
                    '/pendaftaran-pindahan': null
                };
                
                for (const [path, section] of Object.entries(pathMap)) {
                    if (currentPath.includes(path) && section) {
                        navScrollLinks.forEach(link => {
                            if (link.getAttribute('data-section') === section) {
                                link.classList.add('active');
                            }
                        });
                        break;
                    }
                }
            }

            // ===== NAVBAR SCROLL SHADOW EFFECT =====
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar-custom');
                if (window.scrollY > 10) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        });
    </script>
    @yield('extra-js')
</body>
</html>
