<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laboratorium Islamic Technology-Labitech')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    @stack('styles')

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
            scroll-margin-top: 72px;
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
        
        /* ===== TOPBAR ===== */
        .navbar-topbar {
            background: var(--dark-blue);
            padding: 0.4rem 0;
            font-size: 0.78rem;
            color: rgba(255,255,255,0.8);
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .navbar-topbar a {
            color: rgba(255,255,255,0.75);
            transition: color 0.2s;
        }

        .navbar-topbar a:hover {
            color: var(--secondary-yellow);
        }

        .topbar-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 5px;
            background: rgba(255,255,255,0.1);
            font-size: 0.72rem;
            transition: all 0.2s;
        }

        .topbar-social a:hover {
            background: var(--secondary-yellow);
            color: var(--dark-blue) !important;
        }

        /* ===== MAIN NAVBAR ===== */
        .navbar-custom {
            background-color: var(--dark-blue);
            padding: 0.6rem 0;
            box-shadow: none;
            transition: box-shadow 0.3s ease;
        }

        .navbar-custom.scrolled {
            box-shadow: 0 4px 16px rgba(0,0,0,0.25);
        }

        .navbar-custom .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .navbar-custom .navbar-brand img {
            height: 38px;
            width: auto;
        }

        .navbar-brand-text .brand-main {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            color: white;
            line-height: 1.25;
            letter-spacing: 0.2px;
        }

        .navbar-brand-text .brand-sub {
            display: block;
            font-size: 0.68rem;
            color: rgba(255,255,255,0.6);
            font-weight: 400;
            line-height: 1;
        }

        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 0.8rem !important;
            margin: 0 0.05rem;
            position: relative;
            transition: color 0.2s;
        }

        .navbar-custom .nav-link::before {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: var(--secondary-yellow);
            border-radius: 2px;
            transition: width 0.25s ease;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--secondary-yellow) !important;
        }

        .navbar-custom .nav-link:hover::before,
        .navbar-custom .nav-link.active::before {
            width: 60%;
        }

        .navbar-custom .nav-link.active {
            font-weight: 600;
        }

        /* Dropdown */
        .navbar-custom .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            border-radius: 10px;
            padding: 0.5rem;
            margin-top: 0.5rem;
            background: var(--dark-blue);
        }

        .navbar-custom .dropdown-item {
            border-radius: 7px;
            padding: 0.5rem 1rem;
            font-size: 0.88rem;
            font-weight: 500;
            color: rgba(255,255,255,0.85);
            transition: all 0.2s;
        }

        .navbar-custom .dropdown-item:hover {
            background: rgba(255,255,255,0.1);
            color: var(--secondary-yellow);
            padding-left: 1.25rem;
        }

        .navbar-custom .dropdown-item i {
            color: var(--secondary-yellow) !important;
        }

        /* CTA Button */
        .navbar-custom .btn-login {
            background-color: var(--secondary-yellow);
            color: var(--dark-blue) !important;
            border-radius: 50px;
            padding: 0.5rem 1.4rem;
            font-weight: 700;
            font-size: 0.87rem;
            transition: all 0.3s ease;
            border: none;
            white-space: nowrap;
            display: inline-block;
        }

        .navbar-custom .btn-login:hover {
            background-color: white;
            color: var(--dark-blue) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255,215,0,0.3);
        }

        /* Toggler */
        .navbar-custom .navbar-toggler {
            border-color: rgba(255,255,255,0.3);
            padding: 0.35rem 0.6rem;
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
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-10px); }
        }

        /* ===== PAGE TRANSITION ===== */
        @keyframes pageIn {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        main { animation: pageIn 0.28s cubic-bezier(0.22, 1, 0.36, 1); }

        /* ===== TOAST ===== */
        .toast { min-width: 300px; font-size: 0.9rem; }
    </style>
    
    @yield('extra-css')
</head>
<body>
    <!-- Navbar -->
    <div class="fixed-top" id="mainNavbarWrapper">

        <!-- Main Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom" id="mainNavbar">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo2.1.png') }}" alt="logo Labitech">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link nav-scroll" data-section="section-home" href="{{ url('/#section-home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-scroll" data-section="section-tentang" href="{{ url('/#section-tentang') }}">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-scroll" data-section="section-berita" href="{{ url('/#section-berita') }}">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-scroll" data-section="section-kontak" href="{{ url('/#section-kontak') }}">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kemitraan') ? 'active' : '' }}" href="{{ route('kemitraan') }}">Kemitraan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('certificates') ? 'active' : '' }}" href="{{ route('certificates') }}">Certificate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pendaftaran') ? 'active' : '' }}" href="{{ route('pendaftaran') }}">
                                <i class="fas fa-file-alt me-1" style="font-size:0.8rem;opacity:0.7;"></i>Pendaftaran
                            </a>
                        </li>

                        @auth
                            <li class="nav-item ms-lg-2">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-login">
                                    <i class="fas fa-user-shield me-1"></i> Admin Panel
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div><!-- end #mainNavbarWrapper -->

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
                        <p style="margin-bottom: 0.5rem; font-size: 0.95rem; font-weight: 500;">SD Laboratorium Islamic Technology-Labitech</p>
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
                    <p style="margin: 0;">&copy; {{ date('Y') }} <a href="{{ route('home') }}">Laboratorium Islamic Technology-Labitech</a>. Semua hak dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Toast Notifications -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
        @php
            $toasts = [
                'success' => ['bg-success',          'fa-check-circle'],
                'error'   => ['bg-danger',            'fa-times-circle'],
                'warning' => ['bg-warning text-dark', 'fa-exclamation-triangle'],
                'info'    => ['bg-info text-dark',    'fa-info-circle'],
            ];
        @endphp
        @foreach($toasts as $type => [$cls, $icon])
            @if(session($type))
            <div class="toast align-items-center text-white {{ $cls }} border-0 rounded-3 shadow" role="alert">
                <div class="d-flex">
                    <div class="toast-body fw-semibold">
                        <i class="fas {{ $icon }} me-2"></i>{{ session($type) }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    <script>
        document.querySelectorAll('.toast').forEach(function(el) {
            new bootstrap.Toast(el, { delay: 5000 }).show();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navScrollLinks = document.querySelectorAll('.nav-scroll');
            const sections       = document.querySelectorAll('section[id^="section-"]');
            const isHomePage     = {{ request()->routeIs('home') ? 'true' : 'false' }};

            // ===== CUSTOM SMOOTH SCROLL (easeInOutCubic) =====
            function smoothScrollTo(target, duration) {
                duration = duration || 700;
                const navH    = document.getElementById('mainNavbarWrapper')?.offsetHeight || 72;
                const toY     = target.getBoundingClientRect().top + window.scrollY - navH;
                const fromY   = window.scrollY;
                const dist    = toY - fromY;
                let   start   = null;

                function ease(t) {
                    return t < 0.5 ? 4*t*t*t : 1 - Math.pow(-2*t + 2, 3) / 2;
                }
                function step(ts) {
                    if (!start) start = ts;
                    const p = Math.min((ts - start) / duration, 1);
                    window.scrollTo(0, fromY + dist * ease(p));
                    if (p < 1) requestAnimationFrame(step);
                }
                requestAnimationFrame(step);
            }

            // ===== SECTION REVEAL (slide-up on scroll) =====
            if (isHomePage) {
                const revealSections = document.querySelectorAll('section[id^="section-"]:not(#section-home)');
                revealSections.forEach(function(s) {
                    s.style.opacity   = '0';
                    s.style.transform = 'translateY(36px)';
                    s.style.transition = 'opacity 0.55s ease, transform 0.6s cubic-bezier(0.22,1,0.36,1)';
                });

                const revealObs = new IntersectionObserver(function(entries) {
                    entries.forEach(function(e) {
                        if (e.isIntersecting) {
                            e.target.style.opacity   = '1';
                            e.target.style.transform = 'translateY(0)';
                            revealObs.unobserve(e.target);
                        }
                    });
                }, { threshold: 0.07, rootMargin: '-20px 0px' });

                revealSections.forEach(function(s) { revealObs.observe(s); });
            }

            // ===== NAV-SCROLL CLICK HANDLER =====
            navScrollLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    const sectionId     = this.getAttribute('data-section');
                    const targetSection = document.getElementById(sectionId);

                    if (isHomePage && targetSection) {
                        e.preventDefault();
                        smoothScrollTo(targetSection, 700);
                        history.pushState(null, null, '#' + sectionId);

                        navScrollLinks.forEach(function(l) { l.classList.remove('active'); });
                        this.classList.add('active');

                        const navbarCollapse = document.getElementById('navbarNav');
                        if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                            if (bsCollapse) bsCollapse.hide();
                        }
                    }
                });
            });

            // ===== INTERSECTION OBSERVER - active nav tracking =====
            if (isHomePage && sections.length > 0) {
                const activeObs = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            const id = entry.target.getAttribute('id');
                            navScrollLinks.forEach(function(link) {
                                link.classList.remove('active');
                                if (link.getAttribute('data-section') === id) link.classList.add('active');
                            });
                        }
                    });
                }, { root: null, rootMargin: '-80px 0px -50% 0px', threshold: 0 });

                sections.forEach(function(s) { activeObs.observe(s); });

                const hash = window.location.hash.replace('#', '');
                if (hash) {
                    const t = document.getElementById(hash);
                    if (t) setTimeout(function() { smoothScrollTo(t, 700); }, 120);
                } else {
                    navScrollLinks.forEach(function(link) {
                        if (link.getAttribute('data-section') === 'section-home') link.classList.add('active');
                    });
                }
            }

            // ===== CROSS-PAGE EXIT ANIMATION =====
            document.addEventListener('click', function(e) {
                const link = e.target.closest('a[href]');
                if (!link) return;
                const href = link.getAttribute('href');
                if (!href) return;

                // Skip: anchors, external, special protocols, blank target, nav-scroll, ctrl/cmd+click
                if (href.startsWith('#') || href.startsWith('javascript') ||
                    href.startsWith('mailto') || href.startsWith('tel') ||
                    link.target === '_blank' || link.classList.contains('nav-scroll') ||
                    e.ctrlKey || e.metaKey || e.shiftKey) return;

                // Skip external domains
                if (href.startsWith('http') && !href.includes(location.hostname)) return;

                e.preventDefault();
                const main = document.querySelector('main');
                if (main) {
                    main.style.transition = 'opacity 0.18s ease, transform 0.18s ease';
                    main.style.opacity    = '0';
                    main.style.transform  = 'translateY(-24px)';
                }
                setTimeout(function() { window.location.href = href; }, 200);
            });

            // ===== NAVBAR SCROLL SHADOW =====
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar-custom');
                if (navbar) {
                    navbar.classList.toggle('scrolled', window.scrollY > 10);
                }
            });
        });
    </script>
    @yield('extra-js')
</body>
</html>
