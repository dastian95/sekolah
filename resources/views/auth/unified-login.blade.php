@extends('layouts.app')

@section('title', 'Login - Laboratorium Islamic Technology-Labitech')

@section('content')
<style>
    /* ===== LOGIN PAGE STYLES ===== */
    .login-page-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(-45deg, #667eea, #764ba2, #2196F3, #1a3a5c);
        background-size: 400% 400%;
        animation: gradientShift 12s ease infinite;
        padding: 2rem 1rem;
        position: relative;
        overflow: hidden;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Floating Particles */
    .login-page-container::before,
    .login-page-container::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
        animation: float 6s ease-in-out infinite;
    }
    .login-page-container::before { width: 300px; height: 300px; top: -80px; right: -80px; }
    .login-page-container::after { width: 200px; height: 200px; bottom: -60px; left: -60px; animation-delay: 3s; }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(5deg); }
    }

    /* ===== WARNING / ALERT AREA (above wrapper) ===== */
    .login-alerts {
        width: 100%;
        max-width: 1000px;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
        animation: fadeInDown 0.5s ease-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-alerts .alert {
        border: none;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        font-weight: 500;
        backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    }

    .login-alerts .alert-danger {
        background: rgba(220, 53, 69, 0.9);
        color: white;
        animation: shakeX 0.5s ease-in-out;
    }

    .login-alerts .alert-success {
        background: rgba(40, 167, 69, 0.9);
        color: white;
    }

    .login-alerts .alert .btn-close {
        filter: brightness(0) invert(1);
    }

    @keyframes shakeX {
        0%, 100% { transform: translateX(0); }
        15% { transform: translateX(-8px); }
        30% { transform: translateX(8px); }
        45% { transform: translateX(-5px); }
        60% { transform: translateX(5px); }
        75% { transform: translateX(-2px); }
        90% { transform: translateX(2px); }
    }

    /* ===== MAIN LOGIN WRAPPER ===== */
    .login-wrapper {
        width: 100%;
        max-width: 1000px;
        min-height: 540px;
        height: 600px;
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 80px rgba(0,0,0,0.35);
        display: grid;
        grid-template-columns: 1fr 1fr;
        animation: wrapperEntry 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        position: relative;
        z-index: 1;
    }

    @keyframes wrapperEntry {
        from { opacity: 0; transform: translateY(40px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* ===== CAROUSEL SECTION ===== */
    .carousel-section {
        background: linear-gradient(135deg, #1a3a5c 0%, #2a5a8c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .carousel-section::before {
        content: '';
        position: absolute;
        width: 150px; height: 150px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
        top: -40px; left: -40px;
        animation: floatDecor 8s ease-in-out infinite;
    }

    .carousel-section::after {
        content: '';
        position: absolute;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
        bottom: -30px; right: -30px;
        animation: floatDecor 6s ease-in-out infinite reverse;
    }

    @keyframes floatDecor {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(15px, -15px) scale(1.1); }
        66% { transform: translate(-10px, 10px) scale(0.95); }
    }

    .carousel-slides {
        width: 100%; height: 100%;
        position: relative;
    }

    .carousel-slide {
        position: absolute;
        width: 100%; height: 100%;
        opacity: 0;
        transition: opacity 0.8s ease-in-out, transform 0.8s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 2.5rem;
        text-align: center;
        box-sizing: border-box;
        transform: scale(0.95);
    }

    .carousel-slide:nth-child(odd)  { background: linear-gradient(135deg, #1a3a5c 0%, #2a5a8c 100%); }
    .carousel-slide:nth-child(even) { background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%); }

    .carousel-slide.active {
        opacity: 1;
        transform: scale(1);
    }

    .carousel-slide .slide-logo {
        animation: logoPulse 3s ease-in-out infinite;
    }

    @keyframes logoPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .carousel-slide.active .slide-icon {
        animation: iconBounce 2s ease-in-out infinite;
    }

    @keyframes iconBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    .carousel-slide h3 {
        font-size: 1.4rem; font-weight: 700;
        margin-bottom: 0.8rem; color: white;
    }

    .carousel-slide p {
        font-size: 0.9rem; opacity: 0.95;
        line-height: 1.5; color: white;
    }

    .carousel-slide .slide-icon {
        color: white; font-size: 3.5rem;
        margin-bottom: 1rem; display: block;
    }

    /* Yellow slide text colors */
    .carousel-slide:nth-child(even) h3,
    .carousel-slide:nth-child(even) p,
    .carousel-slide:nth-child(even) .slide-icon { color: #1a3a5c; }

    /* Carousel dots */
    .carousel-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 5;
    }

    .carousel-dot {
        width: 10px; height: 10px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .carousel-dot.active {
        background: white;
        transform: scale(1.3);
        box-shadow: 0 0 8px rgba(255,255,255,0.5);
    }

    /* ===== FORM SECTION ===== */
    .form-section {
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: stretch;
        height: 100%;
        overflow: hidden;
        background: white;
        gap: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        max-width: 380px;
        margin: 0 auto;
    }

    .form-header {
        margin-bottom: 1.2rem;
        text-align: center;
        width: 100%;
        animation: fadeInUp 0.6s ease-out 0.3s both;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-header h2 {
        color: var(--dark-blue);
        font-size: 2.1rem;
        font-weight: 800;
        margin-bottom: 0.2rem;
        transition: all 0.3s ease;
    }

    .form-header p {
        color: #6c757d;
        font-size: 1.05rem;
        transition: all 0.3s ease;
    }

    /* ===== USER TYPE TOGGLE WITH SLIDE ANIMATION ===== */
    .user-type-toggle {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-bottom: 1.2rem;
        width: 100%;
        animation: fadeInUp 0.6s ease-out 0.45s both;
    }

    .toggle-btn {
        padding: 0.75rem 1rem;
        border: 2px solid #e8e8e8;
        background: white;
        color: #666;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 600;
        font-size: 0.9rem;
        position: relative;
        overflow: hidden;
    }

    .toggle-btn:hover {
        border-color: #2196F3;
        color: #2196F3;
        background: #f0f7ff;
        transform: translateY(-2px);
    }

    .toggle-btn.active {
        color: white;
        transform: translateY(-2px);
    }

    .toggle-btn.student.active {
        background: linear-gradient(135deg, #0066cc 0%, #2196F3 100%);
        border-color: #0066cc;
        box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
    }

    .toggle-btn.admin.active {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: #1a3a5c;
        border-color: #ffc107;
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
    }

    /* ===== FORM FIELDS WITH SLIDE TRANSITION ===== */
    .fields-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out 0.55s both;
    }

    .login-fields {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes slideOutLeft {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(-40px); }
    }
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(40px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideOutRight {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(40px); }
    }
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-40px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .login-fields.slide-out-left  { animation: slideOutLeft 0.35s ease-in forwards; }
    .login-fields.slide-in-right  { animation: slideInRight 0.35s ease-out forwards; }
    .login-fields.slide-out-right { animation: slideOutRight 0.35s ease-in forwards; }
    .login-fields.slide-in-left   { animation: slideInLeft 0.35s ease-out forwards; }

    /* Animate all form sections on switch */
    @keyframes fadeSwitch {
        0% { opacity: 1; transform: translateY(0); }
        40% { opacity: 0; transform: translateY(-8px); }
        60% { opacity: 0; transform: translateY(8px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .form-switch-animate {
        animation: fadeSwitch 0.5s ease-in-out;
    }

    /* Button color transition */
    .btn-login {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Title transition */
    @keyframes titleSwitch {
        0% { opacity: 1; transform: translateY(0) scale(1); }
        50% { opacity: 0; transform: translateY(-10px) scale(0.95); }
        51% { opacity: 0; transform: translateY(10px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .title-switch-animate {
        animation: titleSwitch 0.5s ease-in-out;
    }

    /* Register link transition */
    @keyframes registerFadeOut {
        from { opacity: 1; transform: translateY(0); max-height: 40px; }
        to { opacity: 0; transform: translateY(10px); max-height: 0; }
    }
    @keyframes registerFadeIn {
        from { opacity: 0; transform: translateY(10px); max-height: 0; }
        to { opacity: 1; transform: translateY(0); max-height: 40px; }
    }

    .register-fade-out { animation: registerFadeOut 0.3s ease forwards; }
    .register-fade-in  { animation: registerFadeIn 0.3s ease forwards; }

    /* Toggle button bounce */
    @keyframes toggleBounce {
        0% { transform: translateY(-2px) scale(1); }
        30% { transform: translateY(-2px) scale(0.92); }
        60% { transform: translateY(-2px) scale(1.05); }
        100% { transform: translateY(-2px) scale(1); }
    }

    .toggle-bounce { animation: toggleBounce 0.4s ease; }

    /* Form Group */
    .form-group {
        margin-bottom: 1rem;
        width: 100%;
    }

    .form-group label {
        display: block;
        color: var(--dark-blue);
        font-weight: 600;
        margin-bottom: 0.4rem;
        font-size: 0.95rem;
    }

    .form-group .input-wrapper {
        position: relative;
    }

    .form-group .input-wrapper i.field-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 1rem;
        transition: color 0.3s;
        pointer-events: none;
    }

    .form-group input {
        width: 100%;
        padding: 0.9rem 1rem 0.9rem 2.8rem;
        font-size: 1rem;
        border: 2px solid #e8e8e8;
        border-radius: 12px;
        background: #f8fafc;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2196F3;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(33, 150, 243, 0.12);
        animation: inputGlow 1.5s ease-in-out infinite alternate;
    }

    @keyframes inputGlow {
        from { box-shadow: 0 0 0 4px rgba(33, 150, 243, 0.08); }
        to { box-shadow: 0 0 0 6px rgba(33, 150, 243, 0.2); }
    }

    .form-group input:focus ~ .field-icon {
        color: #2196F3;
        animation: iconPop 0.3s ease-out;
    }

    @keyframes iconPop {
        0% { transform: translateY(-50%) scale(1); }
        50% { transform: translateY(-50%) scale(1.3); }
        100% { transform: translateY(-50%) scale(1); }
    }

    .form-group input.admin-mode:focus {
        border-color: #ff9800;
        box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.1);
        animation: inputGlowAdmin 1.5s ease-in-out infinite alternate;
    }

    @keyframes inputGlowAdmin {
        from { box-shadow: 0 0 0 3px rgba(255, 152, 0, 0.08); }
        to { box-shadow: 0 0 0 6px rgba(255, 152, 0, 0.2); }
    }

    .form-group input.admin-mode:focus ~ .field-icon {
        color: #ff9800;
        animation: iconPop 0.3s ease-out;
    }

    /* Password toggle */
    .password-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
        transition: all 0.3s ease;
        border: none;
        background: none;
        padding: 4px;
    }

    .password-toggle:hover {
        color: #2196F3;
        transform: translateY(-50%) scale(1.2);
    }

    .password-toggle:active {
        transform: translateY(-50%) scale(0.9);
    }

    /* Password input needs extra right padding for toggle button */
    #password {
        padding-right: 3rem;
    }

    /* Form Options */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        width: 100%;
        animation: fadeInUp 0.6s ease-out 0.75s both;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #666;
        cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
        width: auto;
        accent-color: var(--primary-blue);
        cursor: pointer;
    }

    .forgot-password {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .forgot-password:hover { color: var(--secondary-yellow); }

    /* ===== SUBMIT BUTTON ===== */
    .btn-login {
        width: 100%;
        padding: 1rem 1.5rem;
        font-size: 1.05rem;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 0.8rem;
        margin-top: 0.5rem;
        background: linear-gradient(135deg, #0066cc 0%, #2196F3 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out 0.85s both;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-login::after {
        content: '';
        position: absolute;
        top: -50%; left: -60%;
        width: 40%; height: 200%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transform: skewX(-25deg);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0% { left: -60%; }
        100% { left: 120%; }
    }

    .btn-login:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 30px rgba(33, 150, 243, 0.45);
    }

    .btn-login:active {
        transform: translateY(0) scale(0.98);
    }

    .btn-login.admin-mode {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        color: #1a3a5c;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .btn-login.admin-mode:hover {
        box-shadow: 0 12px 30px rgba(255, 193, 7, 0.45);
    }

    /* Register Link */
    .register-link {
        text-align: center;
        font-size: 0.9rem;
        color: #666;
        width: 100%;
        animation: fadeInUp 0.6s ease-out 0.95s both;
        transition: all 0.3s ease;
    }

    .register-link a {
        color: var(--primary-blue);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .register-link a:hover { color: var(--secondary-yellow); }

    /* ===== BACK BUTTON ===== */
    .back-button {
        position: absolute;
        top: 2rem; left: 2rem;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        z-index: 3;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }

    .back-button:hover {
        color: white;
        transform: translateX(-5px);
    }

    /* Loading spinner */
    .btn-login .spinner {
        display: none;
        width: 20px; height: 20px;
        border: 3px solid rgba(255,255,255,0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
        margin-right: 8px;
    }

    .btn-login.admin-mode .spinner {
        border-color: rgba(26,58,92,0.3);
        border-top-color: #1a3a5c;
    }

    @keyframes spin { to { transform: rotate(360deg); } }
    .btn-login.loading .spinner { display: inline-block; }
    .btn-login:disabled { opacity: 0.7; cursor: not-allowed; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .login-wrapper {
            grid-template-columns: 1fr;
            min-height: unset;
            height: auto;
            max-width: 420px;
        }
        .carousel-section { display: none; }
        .form-section {
            padding: 2rem 1.5rem;
            max-width: 100%;
        }
        .login-alerts { max-width: 420px; }
    }

    #user_type { display: none; }
</style>

<div class="login-page-container">
    <a href="{{ route('home') }}" class="back-button">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>

    {{-- ===== ALERT MESSAGES (ABOVE THE LOGIN WRAPPER) ===== --}}
    @if (session('error') || $errors->any() || session('success'))
    <div class="login-alerts">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
    @endif

    {{-- ===== LOGIN WRAPPER ===== --}}
    <div class="login-wrapper">
        {{-- ===== CAROUSEL (LEFT SIDE) ===== --}}
        <div class="carousel-section">
            <div class="carousel-slides" id="carouselSlides">
                <!-- Slide 1: Logo -->
                <div class="carousel-slide active" data-slide="0">
                    <img class="slide-logo" src="{{ asset('images/logo.png') }}" alt="logo Laboratorium Islamic Technology-Labitech" style="width: 120px; height: 120px; object-fit: contain; border-radius: 0; box-shadow: none;">
                    <h3>Laboratorium Islamic Technology-Labitech</h3>
                    <p>Sistem Informasi Akademik<br>Sekolah Dasar Islam Terpadu</p>
                </div>
                <!-- Slide 2: Dashboard -->
                <div class="carousel-slide" data-slide="1">
                    <i class="slide-icon fas fa-chart-line" style="font-size: 4rem;"></i>
                    <h3>Dashboard Personal</h3>
                    <p>Lihat informasi akademik dan status kelulusan dalam satu tempat</p>
                </div>
                <!-- Slide 3: Profile -->
                <div class="carousel-slide" data-slide="2">
                    <i class="slide-icon fas fa-address-card" style="font-size: 4rem;"></i>
                    <h3>Data Lengkap</h3>
                    <p>Akses semua data pribadi dan keluarga Anda dengan aman</p>
                </div>
                <!-- Slide 4: Graduation -->
                <div class="carousel-slide" data-slide="3">
                    <i class="slide-icon fas fa-graduation-cap" style="font-size: 4rem;"></i>
                    <h3>Status Kelulusan</h3>
                    <p>Cek status kelulusan dan dapatkan notifikasi langsung</p>
                </div>
                <!-- Slide 5: Security -->
                <div class="carousel-slide" data-slide="4">
                    <i class="slide-icon fas fa-shield-alt" style="font-size: 4rem;"></i>
                    <h3>Aman & Terpercaya</h3>
                    <p>Data Anda dilindungi dengan enkripsi tingkat enterprise</p>
                </div>
                <!-- Slide 6: Support -->
                <div class="carousel-slide" data-slide="5">
                    <i class="slide-icon fas fa-headset" style="font-size: 4rem;"></i>
                    <h3>Dukungan 24/7</h3>
                    <p>Tim support kami siap membantu Anda kapan saja</p>
                </div>
            </div>
            <!-- Carousel Dots -->
            <div class="carousel-dots" id="carouselDots"></div>
        </div>

        {{-- ===== FORM (RIGHT SIDE) ===== --}}
        <div class="form-section">
            <div class="form-header">
                <h2 id="loginTitle">Masuk</h2>
                <p id="loginSubtitle">Pilih tipe akun dan login</p>
            </div>

            <!-- User Type Toggle -->
            <div class="user-type-toggle">
                <button type="button" class="toggle-btn student active" onclick="setUserType('student')">
                    <i class="fas fa-user-graduate me-1"></i> Siswa
                </button>
                <button type="button" class="toggle-btn admin" onclick="setUserType('admin')">
                    <i class="fas fa-user-tie me-1"></i> Admin
                </button>
            </div>

            <!-- Login Form -->
            <form method="POST" id="loginForm" action="{{ route('unified.login.submit') }}">
                @csrf
                <input type="hidden" id="user_type" name="user_type" value="student">

                <div class="fields-container">
                    <!-- Student Login Fields -->
                    <div id="studentFields" class="login-fields">
                        <div class="form-group">
                            <label for="login_id"><i class="fas fa-id-badge me-1"></i> NISN, Username, atau Email</label>
                            <div class="input-wrapper">
                                <input
                                    type="text"
                                    id="login_id"
                                    name="login_id"
                                    placeholder="Masukkan NISN, Username, atau Email"
                                    @if($errors->has('login_id')) class="is-invalid" @endif
                                    value="{{ old('login_id') }}"
                                >
                                <i class="field-icon fas fa-user"></i>
                            </div>
                            @if ($errors->has('login_id'))
                                <small class="text-danger d-block mt-1">{{ $errors->first('login_id') }}</small>
                            @endif
                        </div>
                    </div>

                    <!-- Admin Login Fields -->
                    <div id="adminFields" class="login-fields" style="display: none;">
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope me-1"></i> Email atau Username</label>
                            <div class="input-wrapper">
                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    placeholder="Email atau username admin"
                                    class="admin-mode @if($errors->has('email')) is-invalid @endif"
                                    value="{{ old('email') }}"
                                >
                                <i class="field-icon fas fa-user-shield"></i>
                            </div>
                            @if ($errors->has('email'))
                                <small class="text-danger d-block mt-1">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Password (Common) -->
                <div class="form-group" style="animation: fadeInUp 0.6s ease-out 0.65s both;">
                    <label for="password"><i class="fas fa-lock me-1"></i> Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            @if($errors->has('password')) class="is-invalid" @endif
                        >
                        <i class="field-icon fas fa-key"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <small class="text-danger d-block mt-1">{{ $errors->first('password') }}</small>
                    @endif
                </div>

                <!-- Form Options -->
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Ingat saya</span>
                    </label>
                    <a href="#" class="forgot-password">Lupa password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="submitBtn">
                    <span class="spinner"></span>
                    <i class="fas fa-sign-in-alt me-1" id="submitIcon"></i>
                    <span id="submitText">Login Siswa</span>
                </button>

                <!-- Register Link (Students Only) -->
                <div class="register-link" id="registerLink">
                    <span>Belum punya akun? </span>
                    <a href="{{ route('pendaftaran') }}">Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // ===== Carousel Auto-Rotation with Dots =====
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const totalSlides = slides.length;
    const dotsContainer = document.getElementById('carouselDots');

    // Create dots
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('button');
        dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        dot.onclick = () => goToSlide(i);
        dotsContainer.appendChild(dot);
    }

    const dots = document.querySelectorAll('.carousel-dot');

    function goToSlide(index) {
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        currentSlide = index;
    }

    function nextSlide() {
        goToSlide((currentSlide + 1) % totalSlides);
    }

    let carouselInterval = setInterval(nextSlide, 5000);

    // Auto-switch to correct tab based on old input or error
    @if(old('user_type') === 'admin' || old('email'))
        setUserType('admin');
    @endif

    // ===== User Type Toggle with Full Animation =====
    let currentType = 'student';
    let isAnimating = false;

    function setUserType(type) {
        if (type === currentType || isAnimating) return;
        isAnimating = true;

        const userTypeInput = document.getElementById('user_type');
        const studentBtn = document.querySelector('.toggle-btn.student');
        const adminBtn = document.querySelector('.toggle-btn.admin');
        const studentFields = document.getElementById('studentFields');
        const adminFields = document.getElementById('adminFields');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');
        const registerLink = document.getElementById('registerLink');
        const passwordInput = document.getElementById('password');
        const loginTitle = document.getElementById('loginTitle');
        const loginSubtitle = document.getElementById('loginSubtitle');
        const passwordGroup = document.getElementById('password').closest('.form-group');
        const formOptions = document.querySelector('.form-options');

        userTypeInput.value = type;

        // 1. Animate title
        const titleHeader = document.querySelector('.form-header');
        titleHeader.classList.add('title-switch-animate');

        // 2. Animate toggle button bounce
        const activeBtn = type === 'student' ? studentBtn : adminBtn;
        activeBtn.classList.add('toggle-bounce');

        // 3. Animate password + options area
        passwordGroup.classList.add('form-switch-animate');
        formOptions.classList.add('form-switch-animate');

        // 4. Animate submit button
        submitBtn.classList.add('form-switch-animate');

        if (type === 'student') {
            // Slide admin out → student in
            adminFields.classList.add('slide-out-right');

            // Update title at midpoint
            setTimeout(() => {
                loginTitle.textContent = 'Masuk';
                loginSubtitle.textContent = 'Login sebagai siswa';
                submitText.textContent = 'Login Siswa';
                submitIcon.className = 'fas fa-sign-in-alt me-1';
            }, 200);

            setTimeout(() => {
                adminFields.style.display = 'none';
                adminFields.classList.remove('slide-out-right');
                studentFields.style.display = 'block';
                studentFields.classList.add('slide-in-left');

                studentBtn.classList.add('active');
                adminBtn.classList.remove('active');
                submitBtn.classList.remove('admin-mode');
                passwordInput.classList.remove('admin-mode');

                // Show register link with animation
                registerLink.style.display = 'block';
                registerLink.classList.remove('register-fade-out');
                registerLink.classList.add('register-fade-in');

                setTimeout(() => {
                    studentFields.classList.remove('slide-in-left');
                    registerLink.classList.remove('register-fade-in');
                    titleHeader.classList.remove('title-switch-animate');
                    activeBtn.classList.remove('toggle-bounce');
                    passwordGroup.classList.remove('form-switch-animate');
                    formOptions.classList.remove('form-switch-animate');
                    submitBtn.classList.remove('form-switch-animate');
                    isAnimating = false;
                }, 350);
            }, 320);

        } else {
            // Slide student out → admin in
            studentFields.classList.add('slide-out-left');

            // Hide register link with animation
            registerLink.classList.remove('register-fade-in');
            registerLink.classList.add('register-fade-out');

            // Update title at midpoint
            setTimeout(() => {
                loginTitle.textContent = 'Admin Panel';
                loginSubtitle.textContent = 'Login sebagai administrator';
                submitText.textContent = 'Login Admin';
                submitIcon.className = 'fas fa-user-shield me-1';
            }, 200);

            setTimeout(() => {
                studentFields.style.display = 'none';
                studentFields.classList.remove('slide-out-left');
                adminFields.style.display = 'block';
                adminFields.classList.add('slide-in-right');

                adminBtn.classList.add('active');
                studentBtn.classList.remove('active');
                submitBtn.classList.add('admin-mode');
                passwordInput.classList.add('admin-mode');
                registerLink.style.display = 'none';
                registerLink.classList.remove('register-fade-out');

                setTimeout(() => {
                    adminFields.classList.remove('slide-in-right');
                    titleHeader.classList.remove('title-switch-animate');
                    activeBtn.classList.remove('toggle-bounce');
                    passwordGroup.classList.remove('form-switch-animate');
                    formOptions.classList.remove('form-switch-animate');
                    submitBtn.classList.remove('form-switch-animate');
                    isAnimating = false;
                }, 350);
            }, 320);
        }

        currentType = type;
    }

    // ===== Password Visibility Toggle with animation =====
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        const btn = icon.parentElement;

        // Animate the icon
        btn.style.transform = 'translateY(-50%) scale(0)';
        btn.style.transition = 'transform 0.15s ease-in';

        setTimeout(() => {
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
            btn.style.transition = 'transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1)';
            btn.style.transform = 'translateY(-50%) scale(1)';
        }, 150);
    }

    // ===== Form Submission with Loading Spinner =====
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const userType = document.getElementById('user_type').value;
        const btn = document.getElementById('submitBtn');

        if (userType === 'student') {
            const loginId = document.getElementById('login_id').value.trim();
            if (!loginId) {
                e.preventDefault();
                document.getElementById('login_id').focus();
                return;
            }
        } else {
            const emailVal = document.getElementById('email').value.trim();
            if (!emailVal) {
                e.preventDefault();
                document.getElementById('email').focus();
                return;
            }
        }

        btn.classList.add('loading');
        btn.disabled = true;
    });
</script>
@endsection
