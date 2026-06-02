<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Pendaftar') - Laboratorium Islamic Technology-Labitech</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap 5 & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #0066cc;
            --secondary-yellow: #ffd700;
            --dark-blue: #1a3a5c;
            --light-gray: #f8f9fa;
        }

        * { font-family: 'Poppins', sans-serif; }

        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        a { text-decoration: none; color: inherit; }
        main.student-main { flex: 1; }
        .card { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); border: none; }

        /* ===== NAVBAR 1: Website Utama (Top) ===== */
        .navbar-website {
            background-color: var(--dark-blue);
            padding: 0.7rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1030;
        }

        .navbar-website .navbar-brand {
            font-weight: 700;
            font-size: 1.2rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .navbar-website .navbar-brand img {
            height: 36px;
            width: auto;
        }

        .navbar-website .nav-link {
            color: rgba(255,255,255,0.85) !important;
            transition: all 0.3s ease;
            padding: 0.45rem 0.65rem !important;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .navbar-website .nav-link:hover,
        .navbar-website .nav-link:hover i {
            color: var(--secondary-yellow) !important;
        }

        .navbar-website .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-radius: 10px;
        }

        .navbar-website .dropdown-item {
            font-size: 0.88rem;
            padding: 0.5rem 1.2rem;
            transition: all 0.2s;
        }

        .navbar-website .dropdown-item:hover {
            background: #f0f7ff;
            color: var(--primary-blue);
        }

        .navbar-website .navbar-toggler {
            border-color: rgba(255,255,255,0.3);
        }

        .navbar-website .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-website .btn-student-panel {
            background: var(--secondary-yellow);
            color: var(--dark-blue);
            font-size: 0.78rem;
            font-weight: 700;
            padding: 0.35rem 0.85rem;
            border-radius: 6px;
            border: none;
            letter-spacing: 0.3px;
            transition: all 0.3s;
        }

        .navbar-website .btn-student-panel:hover {
            background: #ffb700;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255,215,0,0.3);
        }

        /* ===== NAVBAR 2: Student Bar (Bottom) ===== */
        .navbar-student-bar {
            background: linear-gradient(135deg, #0d2137 0%, #163a5c 100%);
            padding: 0;
            border-bottom: 3px solid var(--secondary-yellow);
            z-index: 1029;
        }

        .navbar-student-bar .container-lg {
            display: flex;
            align-items: stretch;
            overflow: visible;
        }

        .student-nav-items {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 0;
        }

        .student-nav-items > li {
            position: relative;
        }

        .student-nav-items .student-nav-link {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.65rem 1rem;
            color: rgba(255,255,255,0.75);
            font-size: 0.82rem;
            font-weight: 500;
            white-space: nowrap;
            transition: all 0.25s ease;
            border-bottom: 3px solid transparent;
            margin-bottom: -3px;
            text-decoration: none;
        }

        .student-nav-items .student-nav-link:hover {
            color: white;
            background: rgba(255,255,255,0.05);
        }

        .student-nav-items .student-nav-link.active {
            color: var(--secondary-yellow);
            border-bottom-color: var(--secondary-yellow);
            background: rgba(255,215,0,0.05);
            font-weight: 600;
        }

        .student-nav-items .student-nav-link i {
            font-size: 0.85rem;
        }

        /* Student bar right side */
        .student-bar-right {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-left: auto;
            padding: 0.4rem 0;
        }

        .student-bar-right .student-user {
            color: rgba(255,255,255,0.6);
            font-size: 0.75rem;
            white-space: nowrap;
        }

        .student-bar-right .btn-logout {
            background: transparent;
            border: 1px solid rgba(255,100,100,0.4);
            color: #ff9999;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.65rem;
            border-radius: 5px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .student-bar-right .btn-logout:hover {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        /* Student dropdown in student bar */
        .student-nav-items .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-radius: 8px;
            padding: 0.4rem 0;
            min-width: 220px;
            z-index: 1050;
            position: absolute;
            top: 100%;
            left: 0;
        }

        .student-nav-items .dropdown-item {
            font-size: 0.85rem;
            padding: 0.45rem 1rem;
            transition: all 0.2s;
        }

        .student-nav-items .dropdown-item:hover {
            background: #f0f7ff;
            color: var(--primary-blue);
        }

        .student-nav-items .dropdown-item.active {
            background: var(--primary-blue);
            color: white;
        }

        /* Mobile student bar toggle */
        .student-bar-toggle {
            display: none;
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem;
            cursor: pointer;
        }

        .student-bar-toggle:hover { color: var(--secondary-yellow); }

        /* ===== FOOTER ===== */
        .footer {
            background: linear-gradient(160deg, #0d2137 0%, var(--dark-blue) 40%, #1e4976 100%);
            color: white;
            position: relative;
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

        .footer-wave { width: 100%; line-height: 0; margin-bottom: -1px; }
        .footer-wave svg { display: block; width: 100%; height: 60px; }

        .footer-main { padding: 2.5rem 0 1rem; position: relative; z-index: 1; }

        .footer h5 {
            font-weight: 700;
            font-size: 1.05rem;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 0.6rem;
        }

        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 35px;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary-yellow), transparent);
            border-radius: 2px;
        }

        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 0.6rem; }

        .footer-links li a {
            color: rgba(255,255,255,0.7);
            transition: all 0.3s ease;
            font-size: 0.88rem;
        }

        .footer-links li a:hover {
            color: var(--secondary-yellow);
            padding-left: 5px;
        }

        .contact-info {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.85rem;
        }

        .contact-info .ci-icon {
            width: 32px;
            height: 32px;
            min-width: 32px;
            background: rgba(255,215,0,0.12);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
        }

        .contact-info .ci-icon i { color: var(--secondary-yellow); font-size: 0.8rem; }

        .contact-info span {
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .social-icons { display: flex; gap: 0.6rem; flex-wrap: wrap; margin-top: 0.5rem; }

        .social-icons a {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.08);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .social-icons a:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.3); }
        .social-icons a.sc-facebook:hover { background: #1877F2; border-color: #1877F2; }
        .social-icons a.sc-instagram:hover { background: linear-gradient(45deg, #f09433, #dc2743, #bc1888); border-color: #dc2743; }
        .social-icons a.sc-youtube:hover { background: #FF0000; border-color: #FF0000; }
        .social-icons a.sc-whatsapp:hover { background: #25D366; border-color: #25D366; }

        .footer-bottom {
            text-align: center;
            padding: 1rem 0;
            margin-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.5);
            font-size: 0.82rem;
        }

        .footer-bottom a { color: var(--secondary-yellow); font-weight: 600; }
        .footer-bottom a:hover { color: #fff; }

        /* Responsive */
        @media (max-width: 991px) {
            .student-bar-toggle { display: block; }

            .navbar-student-bar .container-lg {
                flex-wrap: wrap;
                overflow: visible;
            }

            .student-nav-items {
                display: none;
                flex-direction: column;
                width: 100%;
            }

            .student-nav-items.show {
                display: flex;
            }

            .student-nav-items .student-nav-link {
                padding: 0.6rem 1rem;
                border-bottom: none;
                border-left: 3px solid transparent;
                margin-bottom: 0;
            }

            .student-nav-items .student-nav-link.active {
                border-left-color: var(--secondary-yellow);
                border-bottom-color: transparent;
            }

            .student-bar-right {
                width: 100%;
                justify-content: space-between;
                padding: 0.5rem 0.75rem;
                border-top: 1px solid rgba(255,255,255,0.08);
            }
        }

        @media (max-width: 767px) {
            .footer-col { text-align: center; }
            .footer h5::after { left: 50%; transform: translateX(-50%); }
            .social-icons { justify-content: center; }
            .contact-info { justify-content: center; }
        }

        /* ===== PAGE TRANSITIONS ===== */
        @keyframes pageIn {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        main.student-main {
            animation: pageIn 0.28s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        /* ===== TOAST NOTIFICATIONS ===== */
        .toast-container-fixed {
            position: fixed;
            bottom: 1.25rem;
            right: 1.25rem;
            z-index: 9999;
        }

        .toast-custom {
            min-width: 300px;
            max-width: 420px;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.18);
            border: none;
        }
    </style>
    @yield('extra-css')
    @stack('styles')
</head>
<body>
    {{-- Wrapper sticky agar kedua navbar (website + student bar) ikut saat scroll --}}
    <div class="sticky-top" style="z-index: 1030;">
    {{-- ===== NAVBAR 1: Website Utama ===== --}}
    <nav class="navbar navbar-expand-lg navbar-website">
        <div class="container-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo Laboratorium Islamic Technology-Labitech">
                <span>Laboratorium Islamic Technology-Labitech</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#websiteNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="websiteNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#section-home"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#section-tentang"><i class="fas fa-info-circle me-1"></i> Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#section-berita"><i class="fas fa-newspaper me-1"></i> Berita</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-plus me-1"></i> Pendaftaran
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pendaftaran') }}"><i class="fas fa-child me-2"></i> Siswa Baru</a></li>
                            <li><a class="dropdown-item" href="{{ route('pendaftaran-pindahan') }}"><i class="fas fa-arrow-right-arrow-left me-2"></i> Siswa Pindahan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#section-kontak"><i class="fas fa-phone me-1"></i> Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-student-panel" href="{{ route('student.dashboard') }}">
                            <i class="fas fa-user-graduate me-1"></i> Portal Pendaftar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ===== NAVBAR 2: Student Navigation Bar ===== --}}
    <nav class="navbar-student-bar">
        <div class="container-lg">
            <button class="student-bar-toggle" onclick="document.getElementById('studentNavItems').classList.toggle('show')">
                <i class="fas fa-bars me-1"></i> Menu Pendaftar
            </button>

            <ul class="student-nav-items" id="studentNavItems">
                <li>
                    <a class="student-nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a class="student-nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}" href="{{ route('student.profile') }}">
                        <i class="fas fa-id-card"></i> Data Saya
                    </a>
                </li>
                <li>
                    <a class="student-nav-link {{ request()->routeIs('student.graduation.status') ? 'active' : '' }}" href="{{ route('student.graduation.status') }}">
                        <i class="fas fa-clipboard-check"></i> Status Pendaftaran
                    </a>
                </li>
                <li>
                    <a class="student-nav-link {{ request()->routeIs('student.change-password') ? 'active' : '' }}" href="{{ route('student.change-password') }}">
                        <i class="fas fa-lock"></i> Ubah Password
                    </a>
                </li>
            </ul>

            <div class="student-bar-right">
                <span class="student-user">
                    <i class="fas fa-user-graduate me-1"></i> {{ auth('students')->user()->nama ?? 'Pendaftar' }}
                </span>
                <form method="POST" action="{{ route('unified.logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
    </div>{{-- end sticky-top wrapper --}}

    <!-- Main Content -->
    <main class="student-main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
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
                    <div class="col-lg-4 col-md-6 footer-col mb-4">
                        <h5><i class="fas fa-graduation-cap" style="color: var(--secondary-yellow); margin-right: 0.5rem;"></i>LABITECH</h5>
                        <p style="margin-bottom: 0.4rem; font-size: 0.92rem; font-weight: 500;">Laboratorium Islamic Technology-Labitech</p>
                        <p style="margin-bottom: 1rem; font-size: 0.82rem; color: rgba(255,255,255,0.6);">SD (Sekolah Dasar)</p>
                        <div class="social-icons">
                            <a href="#" class="sc-facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="sc-instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="sc-youtube" title="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="sc-whatsapp" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-col mb-4">
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
                    <div class="col-lg-4 col-md-12 footer-col mb-4">
                        <h5>Portal Pendaftar</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('student.dashboard') }}"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Dashboard</a></li>
                            <li><a href="{{ route('student.profile') }}"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Data Saya</a></li>
                            <li><a href="{{ route('student.graduation.status') }}"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Status Pendaftaran</a></li>
                            <li><a href="{{ route('student.change-password') }}"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Ubah Password</a></li>
                            <li><a href="{{ url('/') }}" target="_blank"><i class="fas fa-chevron-right" style="font-size: 0.6rem; margin-right: 0.4rem; opacity: 0.5;"></i>Lihat Website</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p style="margin: 0;">&copy; {{ date('Y') }} <a href="{{ route('home') }}">Laboratorium Islamic Technology-Labitech</a>. Semua hak dilindungi.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
    <div class="toast-container-fixed" id="toastContainer"></div>

    @if(session('success'))
        <div id="flashSuccess" data-msg="{{ session('success') }}" data-type="success" style="display:none;"></div>
    @endif
    @if(session('error'))
        <div id="flashError" data-msg="{{ session('error') }}" data-type="error" style="display:none;"></div>
    @endif
    @if(session('warning'))
        <div id="flashWarning" data-msg="{{ session('warning') }}" data-type="warning" style="display:none;"></div>
    @endif
    @if(session('info'))
        <div id="flashInfo" data-msg="{{ session('info') }}" data-type="info" style="display:none;"></div>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // ===== Toast System =====
    function showToast(message, type) {
        type = type || 'success';
        var icons = { success: 'fa-check-circle', error: 'fa-times-circle', warning: 'fa-exclamation-triangle', info: 'fa-info-circle' };
        var colors = { success: '#198754', error: '#dc3545', warning: '#ffc107', info: '#0dcaf0' };
        var container = document.getElementById('toastContainer');
        if (!container) return;
        var id = 'toast_' + Date.now();
        var html = '<div id="' + id + '" class="toast toast-custom align-items-center show mb-2" role="alert">' +
            '<div class="d-flex">' +
            '<div class="toast-body d-flex align-items-center gap-2">' +
            '<i class="fas ' + (icons[type] || icons.success) + '" style="color:' + (colors[type] || colors.success) + ';font-size:1.1rem;flex-shrink:0;"></i>' +
            '<span>' + message + '</span>' +
            '</div>' +
            '<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>' +
            '</div></div>';
        container.insertAdjacentHTML('beforeend', html);
        var el = document.getElementById(id);
        if (el) {
            var t = new bootstrap.Toast(el, { delay: 5000 });
            t.show();
            el.addEventListener('hidden.bs.toast', function() { el.remove(); });
        }
    }

    // Show flash messages as toasts
    document.addEventListener('DOMContentLoaded', function() {
        ['flashSuccess','flashError','flashWarning','flashInfo'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) showToast(el.getAttribute('data-msg'), el.getAttribute('data-type'));
        });
    });

    // ===== Cross-page Exit Animation =====
    document.addEventListener('click', function(e) {
        var link = e.target.closest('a[href]');
        if (!link) return;
        var href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript') ||
            href.startsWith('mailto') || href.startsWith('tel') ||
            link.target === '_blank' || e.ctrlKey || e.metaKey || e.shiftKey) return;
        if (href.startsWith('http') && !href.includes(location.hostname)) return;
        // Skip logout forms (handled by form submit)
        if (link.closest('form')) return;
        e.preventDefault();
        var main = document.querySelector('main.student-main');
        if (main) {
            main.style.transition = 'opacity 0.18s ease, transform 0.18s ease';
            main.style.opacity = '0';
            main.style.transform = 'translateY(-24px)';
        }
        setTimeout(function() { window.location.href = href; }, 200);
    });
    </script>

    @yield('extra-js')
    @stack('scripts')
</body>
</html>
