@extends('layouts.app')

@section('title', 'Pendaftaran Peserta Didik Baru - SDIT Labitech Insan Mulia')

@section('content')
<style>
    .ppdb-hero {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        padding: 100px 0 50px;
        color: white;
        text-align: center;
    }
    .ppdb-hero h1 {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 10px;
    }
    .ppdb-hero p {
        font-size: 1rem;
        opacity: 0.9;
    }

    .form-wrapper {
        max-width: 800px;
        margin: -30px auto 40px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        padding: 40px;
        position: relative;
        z-index: 2;
    }

    .form-section-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--dark-blue);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--secondary-yellow);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-section-title i {
        color: var(--primary-blue);
        font-size: 1.2rem;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 6px;
    }
    .form-label .required {
        color: #dc3545;
        margin-left: 2px;
    }

    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0,102,204,0.15);
    }

    /* ========== SEARCHABLE DROPDOWN ========== */
    .search-dropdown {
        position: relative;
    }
    .search-dropdown .dropdown-trigger {
        width: 100%;
        text-align: left;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 10px 40px 10px 14px;
        font-size: 0.95rem;
        background: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 46px;
    }
    .search-dropdown .dropdown-trigger:hover {
        border-color: #bbb;
    }
    .search-dropdown .dropdown-trigger.open {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0,102,204,0.15);
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .search-dropdown .dropdown-trigger .placeholder-text {
        color: #999;
    }
    .search-dropdown .dropdown-trigger .chevron {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        transition: transform 0.3s ease;
        color: #999;
        font-size: 0.8rem;
    }
    .search-dropdown .dropdown-trigger.open .chevron {
        transform: translateY(-50%) rotate(180deg);
    }

    .search-dropdown .dropdown-menu-custom {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 2px solid var(--primary-blue);
        border-top: none;
        border-radius: 0 0 10px 10px;
        z-index: 100;
        display: none;
        max-height: 280px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        animation: dropdownSlide 0.25s ease;
    }
    .search-dropdown .dropdown-menu-custom.show {
        display: block;
    }

    @keyframes dropdownSlide {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .search-dropdown .dropdown-search {
        padding: 10px 12px;
        border-bottom: 1px solid #eee;
        position: sticky;
        top: 0;
        background: #fff;
        z-index: 1;
    }
    .search-dropdown .dropdown-search input {
        width: 100%;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px 12px 8px 34px;
        font-size: 0.9rem;
        outline: none;
        transition: border-color 0.3s;
    }
    .search-dropdown .dropdown-search input:focus {
        border-color: var(--primary-blue);
    }
    .search-dropdown .dropdown-search i {
        position: absolute;
        left: 24px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 0.85rem;
    }

    .search-dropdown .dropdown-options {
        max-height: 220px;
        overflow-y: auto;
        padding: 4px 0;
    }
    .search-dropdown .dropdown-options::-webkit-scrollbar {
        width: 6px;
    }
    .search-dropdown .dropdown-options::-webkit-scrollbar-track {
        background: #f5f5f5;
    }
    .search-dropdown .dropdown-options::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }

    .search-dropdown .dropdown-option {
        padding: 9px 14px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .search-dropdown .dropdown-option:hover {
        background: #f0f7ff;
        color: var(--primary-blue);
    }
    .search-dropdown .dropdown-option.selected {
        background: var(--primary-blue);
        color: #fff;
        font-weight: 600;
    }
    .search-dropdown .dropdown-option .option-icon {
        font-size: 0.75rem;
        opacity: 0.6;
    }
    .search-dropdown .no-results {
        padding: 20px 14px;
        text-align: center;
        color: #999;
        font-size: 0.9rem;
    }
    .search-dropdown .no-results i {
        display: block;
        font-size: 1.5rem;
        margin-bottom: 6px;
        color: #ccc;
    }

    /* Simple dropdown (no search) */
    .simple-dropdown .dropdown-menu-custom {
        max-height: 200px;
    }

    /* ========== RADIO CARDS ========== */
    .radio-card-group {
        display: flex;
        gap: 12px;
    }
    .radio-card {
        flex: 1;
        position: relative;
    }
    .radio-card input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .radio-card label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-align: center;
    }
    .radio-card label:hover {
        border-color: var(--primary-blue);
        background: #f0f7ff;
    }
    .radio-card input[type="radio"]:checked + label {
        border-color: var(--primary-blue);
        background: var(--primary-blue);
        color: white;
        box-shadow: 0 4px 12px rgba(0,102,204,0.3);
    }
    .radio-card input[type="radio"]:checked + label i {
        color: white;
    }
    .radio-card label i {
        font-size: 1.1rem;
        color: var(--primary-blue);
    }

    /* ========== SUBMIT ========== */
    .btn-submit {
        background: linear-gradient(135deg, var(--primary-blue), #0052a3);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,102,204,0.4);
        color: white;
    }
    .btn-submit:active {
        transform: translateY(0);
    }
    .btn-submit .spinner-border {
        width: 18px;
        height: 18px;
        border-width: 2px;
        display: none;
    }
    .btn-submit.loading .btn-text { display: none; }
    .btn-submit.loading .spinner-border { display: inline-block; }

    /* ========== ALERTS ========== */
    .ppdb-alert {
        border-radius: 12px;
        border: none;
        padding: 16px 20px;
        font-size: 0.95rem;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        animation: slideDown 0.4s ease;
    }
    .ppdb-alert i { font-size: 1.2rem; margin-top: 2px; }
    .ppdb-alert.alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
    }
    .ppdb-alert.alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ========== VALIDATION ========== */
    .is-invalid {
        border-color: #dc3545 !important;
    }
    .invalid-feedback {
        font-size: 0.82rem;
        margin-top: 4px;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .form-wrapper {
            margin: -20px 12px 30px;
            padding: 24px 18px;
        }
        .ppdb-hero { padding: 70px 0 40px; }
        .ppdb-hero h1 { font-size: 1.5rem; }
        .radio-card-group { gap: 8px; }
    }
</style>

<!-- Hero Section -->
<section class="ppdb-hero">
    <div class="container">
        <h1><i class="fas fa-graduation-cap me-2"></i>Pendaftaran Peserta Didik Baru</h1>
        <p>SDIT Labitech Insan Mulia — Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }}</p>
    </div>
</section>

<!-- Form -->
<div class="container">
    <div class="form-wrapper">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="ppdb-alert alert-success mb-4">
                <i class="fas fa-check-circle"></i>
                <div>{!! session('success') !!}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="ppdb-alert alert-danger mb-4">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" id="pendaftaranForm">
            @csrf

            {{-- SECTION: Data Calon Siswa --}}
            <div class="form-section-title">
                <i class="fas fa-user-graduate"></i>
                Data Calon Peserta Didik
            </div>

            <div class="row g-3 mb-4">
                {{-- Nama Lengkap --}}
                <div class="col-12">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                           value="{{ old('full_name') }}" placeholder="Masukkan nama lengkap calon siswa" required>
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="col-12">
                    <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                    <div class="radio-card-group">
                        <div class="radio-card">
                            <input type="radio" name="gender" id="gender_l" value="L" {{ old('gender') == 'L' ? 'checked' : '' }} required>
                            <label for="gender_l"><i class="fas fa-mars"></i> Laki-laki</label>
                        </div>
                        <div class="radio-card">
                            <input type="radio" name="gender" id="gender_p" value="P" {{ old('gender') == 'P' ? 'checked' : '' }}>
                            <label for="gender_p"><i class="fas fa-venus"></i> Perempuan</label>
                        </div>
                    </div>
                    @error('gender')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tempat Lahir (Searchable Dropdown) --}}
                <div class="col-md-6">
                    <label class="form-label">Tempat Lahir <span class="required">*</span></label>
                    <div class="search-dropdown" data-name="birth_place" data-value="{{ old('birth_place') }}">
                        <input type="hidden" name="birth_place" value="{{ old('birth_place') }}">
                        <div class="dropdown-trigger" tabindex="0">
                            <span class="trigger-text placeholder-text">Pilih kota / kabupaten</span>
                            <i class="fas fa-chevron-down chevron"></i>
                        </div>
                        <div class="dropdown-menu-custom">
                            <div class="dropdown-search">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Cari kota atau kabupaten..." autocomplete="off">
                            </div>
                            <div class="dropdown-options"></div>
                        </div>
                    </div>
                    @error('birth_place')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tanggal Lahir --}}
                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir <span class="required">*</span></label>
                    <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
                           value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Agama (Dropdown) --}}
                <div class="col-md-6">
                    <label class="form-label">Agama <span class="required">*</span></label>
                    <div class="search-dropdown simple-dropdown" data-name="agama" data-value="{{ old('agama') }}">
                        <input type="hidden" name="agama" value="{{ old('agama') }}">
                        <div class="dropdown-trigger" tabindex="0">
                            <span class="trigger-text placeholder-text">Pilih agama</span>
                            <i class="fas fa-chevron-down chevron"></i>
                        </div>
                        <div class="dropdown-menu-custom">
                            <div class="dropdown-options"></div>
                        </div>
                    </div>
                    @error('agama')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Sekolah Asal (Searchable Dropdown) --}}
                <div class="col-md-6">
                    <label class="form-label">Asal Sekolah (TK/RA)</label>
                    <div class="search-dropdown" data-name="origin_school" data-value="{{ old('origin_school') }}">
                        <input type="hidden" name="origin_school" value="{{ old('origin_school') }}">
                        <div class="dropdown-trigger" tabindex="0">
                            <span class="trigger-text placeholder-text">Pilih atau cari sekolah asal</span>
                            <i class="fas fa-chevron-down chevron"></i>
                        </div>
                        <div class="dropdown-menu-custom">
                            <div class="dropdown-search">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Cari sekolah asal..." autocomplete="off">
                            </div>
                            <div class="dropdown-options"></div>
                        </div>
                    </div>
                    @error('origin_school')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- SECTION: Data Orang Tua / Wali --}}
            <div class="form-section-title">
                <i class="fas fa-users"></i>
                Data Orang Tua / Wali
            </div>

            <div class="row g-3 mb-4">
                {{-- Nama Orang Tua --}}
                <div class="col-12">
                    <label class="form-label">Nama Orang Tua / Wali <span class="required">*</span></label>
                    <input type="text" name="parent_name" class="form-control @error('parent_name') is-invalid @enderror"
                           value="{{ old('parent_name') }}" placeholder="Masukkan nama lengkap orang tua / wali" required>
                    @error('parent_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pekerjaan Orang Tua (Searchable Dropdown) --}}
                <div class="col-md-6">
                    <label class="form-label">Pekerjaan Orang Tua</label>
                    <div class="search-dropdown" data-name="pekerjaan_ayah" data-value="{{ old('pekerjaan_ayah') }}">
                        <input type="hidden" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}">
                        <div class="dropdown-trigger" tabindex="0">
                            <span class="trigger-text placeholder-text">Pilih pekerjaan</span>
                            <i class="fas fa-chevron-down chevron"></i>
                        </div>
                        <div class="dropdown-menu-custom">
                            <div class="dropdown-search">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Cari pekerjaan..." autocomplete="off">
                            </div>
                            <div class="dropdown-options"></div>
                        </div>
                    </div>
                    @error('pekerjaan_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pendidikan Orang Tua (Dropdown) --}}
                <div class="col-md-6">
                    <label class="form-label">Pendidikan Terakhir Orang Tua</label>
                    <div class="search-dropdown simple-dropdown" data-name="pendidikan_ayah" data-value="{{ old('pendidikan_ayah') }}">
                        <input type="hidden" name="pendidikan_ayah" value="{{ old('pendidikan_ayah') }}">
                        <div class="dropdown-trigger" tabindex="0">
                            <span class="trigger-text placeholder-text">Pilih pendidikan</span>
                            <i class="fas fa-chevron-down chevron"></i>
                        </div>
                        <div class="dropdown-menu-custom">
                            <div class="dropdown-options"></div>
                        </div>
                    </div>
                    @error('pendidikan_ayah')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- WhatsApp --}}
                <div class="col-md-6">
                    <label class="form-label">Nomor WhatsApp <span class="required">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius: 10px 0 0 10px; border: 2px solid #e0e0e0; border-right: 0; background: #f8f9fa;">
                            <i class="fab fa-whatsapp text-success"></i>
                        </span>
                        <input type="tel" name="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror"
                               value="{{ old('whatsapp_number') }}" placeholder="08xxxxxxxxxx"
                               style="border-left: 0; border-radius: 0 10px 10px 0;" required>
                    </div>
                    @error('whatsapp_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text" style="border-radius: 10px 0 0 10px; border: 2px solid #e0e0e0; border-right: 0; background: #f8f9fa;">
                            <i class="fas fa-envelope text-primary"></i>
                        </span>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="contoh@email.com"
                               style="border-left: 0; border-radius: 0 10px 10px 0;" required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- SECTION: Alamat --}}
            <div class="form-section-title">
                <i class="fas fa-map-marker-alt"></i>
                Alamat Tempat Tinggal
            </div>

            <div class="row g-3 mb-4">
                {{-- Provinsi (Searchable Dropdown) --}}
                <div class="col-md-6">
                    <label class="form-label">Provinsi</label>
                    <div class="search-dropdown" data-name="provinsi" data-value="{{ old('provinsi') }}">
                        <input type="hidden" name="provinsi" value="{{ old('provinsi') }}">
                        <div class="dropdown-trigger" tabindex="0">
                            <span class="trigger-text placeholder-text">Pilih provinsi</span>
                            <i class="fas fa-chevron-down chevron"></i>
                        </div>
                        <div class="dropdown-menu-custom">
                            <div class="dropdown-search">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Cari provinsi..." autocomplete="off">
                            </div>
                            <div class="dropdown-options"></div>
                        </div>
                    </div>
                    @error('provinsi')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kabupaten/Kota (Searchable Dropdown) --}}
                <div class="col-md-6">
                    <label class="form-label">Kabupaten / Kota</label>
                    <div class="search-dropdown" data-name="kabupaten" data-value="{{ old('kabupaten') }}">
                        <input type="hidden" name="kabupaten" value="{{ old('kabupaten') }}">
                        <div class="dropdown-trigger" tabindex="0">
                            <span class="trigger-text placeholder-text">Pilih kabupaten / kota</span>
                            <i class="fas fa-chevron-down chevron"></i>
                        </div>
                        <div class="dropdown-menu-custom">
                            <div class="dropdown-search">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Cari kabupaten / kota..." autocomplete="off">
                            </div>
                            <div class="dropdown-options"></div>
                        </div>
                    </div>
                    @error('kabupaten')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kecamatan --}}
                <div class="col-md-6">
                    <label class="form-label">Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror"
                           value="{{ old('kecamatan') }}" placeholder="Masukkan kecamatan">
                    @error('kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Kelurahan --}}
                <div class="col-md-6">
                    <label class="form-label">Kelurahan / Desa</label>
                    <input type="text" name="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror"
                           value="{{ old('kelurahan') }}" placeholder="Masukkan kelurahan / desa">
                    @error('kelurahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat Lengkap --}}
                <div class="col-12">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="address_short" rows="3" class="form-control @error('address_short') is-invalid @enderror"
                              placeholder="Masukkan alamat lengkap (jalan, RT/RW, nomor rumah)">{{ old('address_short') }}</textarea>
                    @error('address_short')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-submit" id="btnSubmit">
                    <span class="btn-text"><i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran</span>
                    <span class="spinner-border spinner-border-sm text-light" role="status"></span>
                </button>
                <p class="text-muted mt-3" style="font-size: 0.85rem;">
                    <i class="fas fa-info-circle me-1"></i>
                    Informasi akun portal siswa akan dikirimkan ke email yang didaftarkan.
                </p>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ========================================
    // DATA OPTIONS FOR DROPDOWNS
    // ========================================

    const dropdownData = {
        // Kota / Kabupaten tempat lahir (lengkap Indonesia)
        birth_place: [
            'Ambon','Balikpapan','Banda Aceh','Bandar Lampung','Bandung','Banjar','Banjarbaru','Banjarmasin','Bantul',
            'Banyumas','Banyuwangi','Batam','Batu','Bekasi','Bengkulu','Bima','Binjai','Bitung','Blitar','Blora',
            'Bogor','Bojonegoro','Bondowoso','Bontang','Boyolali','Brebes','Bukittinggi','Bulukumba','Ciamis','Cianjur',
            'Cibinong','Cilacap','Cilegon','Cimahi','Cirebon','Demak','Denpasar','Depok','Dumai','Ende',
            'Garut','Gorontalo','Gresik','Gunungkidul','Indramayu','Jakarta Barat','Jakarta Pusat','Jakarta Selatan',
            'Jakarta Timur','Jakarta Utara','Jambi','Jayapura','Jember','Jepara','Jombang','Karanganyar','Karawang',
            'Kebumen','Kediri','Kendal','Kendari','Klaten','Kotabumi','Kudus','Kuningan','Kupang','Lamongan',
            'Langsa','Lhokseumawe','Lombok','Lubuklinggau','Lumajang','Madiun','Magelang','Magetan','Majalengka',
            'Makassar','Malang','Mamuju','Manado','Manokwari','Mataram','Medan','Merauke','Metro','Mojokerto',
            'Muara Enim','Nganjuk','Ngawi','Pacitan','Padang','Padang Panjang','Padangsidimpuan','Pagar Alam',
            'Palangkaraya','Palembang','Palopo','Palu','Pamekasan','Pangkalpinang','Parepare','Pariaman','Pasuruan',
            'Pati','Payakumbuh','Pekalongan','Pekanbaru','Pemalang','Pematangsiantar','Ponorogo','Pontianak',
            'Prabumulih','Probolinggo','Purbalingga','Purwakarta','Purwodadi','Purwokerto','Purworejo',
            'Rembang','Salatiga','Samarinda','Sampang','Sanggau','Serang','Semarang','Sibolga','Sidoarjo','Singaraja',
            'Singkawang','Situbondo','Sleman','Solo','Solok','Sorong','Sragen','Subang','Sukabumi','Sukoharjo',
            'Sumbawa','Sumedang','Sumenep','Sungaipenuh','Surabaya','Surakarta','Tabanan','Tangerang',
            'Tangerang Selatan','Tanjung Pinang','Tanjungbalai','Tarakan','Tasikmalaya','Tebingtinggi',
            'Tegal','Ternate','Tidore','Trenggalek','Tuban','Tulungagung','Wonogiri','Wonosobo','Yogyakarta'
        ],

        // Agama
        agama: ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],

        // Sekolah Asal (contoh TK/RA populer di Jabodetabek)
        origin_school: [
            'TK Islam Al-Azhar','TK Islam Annajah','TK Islam Terpadu','TK Aisyiyah Bustanul Athfal',
            'TK Al-Hidayah','TK Al-Ikhlas','TK Al-Muhajirin','TK An-Nur','TK Assalam',
            'TK Bina Insani','TK Bina Nusantara','TK Bintang Kecil','TK Bunga Bangsa',
            'TK Cahaya Bunda','TK Ceria','TK Dharma Wanita','TK Fatimah',
            'TK Global Islamic School','TK Harapan Bangsa','TK Harapan Bunda','TK Harapan Mulia',
            'TK Ibnu Sina','TK Islam Cikal Harapan','TK Islam Kenanga','TK Islam Nurul Fikri',
            'TK Islam Tunas Harapan','TK IT Auliya','TK IT Bunayya','TK IT Permata Hati',
            'TK Kartika','TK Kartini','TK Kemala Bhayangkari','TK Kristen Petra',
            'TK Labschool','TK Labitech','TK Mawar','TK Melati','TK Mentari',
            'TK Mutiara','TK Mutiara Bangsa','TK Negeri Pembina','TK Nurul Hikmah',
            'TK Patra','TK Pelita','TK Pembina','TK Pelangi','TK Pertiwi',
            'TK PGRI','TK PKK','TK Putra Bangsa','TK Raudhatul Athfal','TK Riyadhul Jannah',
            'TK Salsabila','TK Santa Maria','TK Santa Theresia','TK Sari Teladan',
            'TK Sejahtera','TK Taruna Bangsa','TK Tunas Bangsa','TK Tunas Mekar','TK Tunas Rimba',
            'TK Widya Bakti','TK Xaverius','RA Al-Hidayah','RA Al-Ikhlas','RA Muslimat NU',
            'RA Perwanida','RA Kartini','Lainnya'
        ],

        // Pekerjaan orang tua
        pekerjaan_ayah: [
            'Aparatur Sipil Negara (ASN)','Anggota DPR/DPRD','Anggota TNI','Anggota Polri',
            'Apoteker','Arsitek','Akuntan','Bidan','Buruh','Dosen','Dokter','Dokter Gigi',
            'Dokter Spesialis','Driver/Pengemudi','Guru','Hakim','Ibu Rumah Tangga',
            'Insinyur/Engineer','Jaksa','Jurnalis/Wartawan','Karyawan BUMN','Karyawan Swasta',
            'Konsultan','Mekanik/Teknisi','Nelayan','Notaris','Pedagang','Pegawai Bank',
            'Pekerja Seni/Seniman','Pelaut','Penata Rias','Pendeta/Ustadz','Pengacara/Advokat',
            'Pengusaha/Wiraswasta','Pensiunan','Perawat','Petani','Pilot','Politikus',
            'Programmer/IT','Psikolog','Sopir','Tukang','Wiraswasta','Tidak Bekerja','Lainnya'
        ],

        // Pendidikan terakhir
        pendidikan_ayah: [
            'Tidak Sekolah','SD / MI / Sederajat','SMP / MTs / Sederajat','SMA / SMK / MA / Sederajat',
            'D1 (Diploma 1)','D2 (Diploma 2)','D3 (Diploma 3)','D4 / S1 (Sarjana)',
            'S2 (Magister)','S3 (Doktor)'
        ],

        // Provinsi Indonesia
        provinsi: [
            'Aceh','Bali','Banten','Bengkulu','DI Yogyakarta','DKI Jakarta',
            'Gorontalo','Jambi','Jawa Barat','Jawa Tengah','Jawa Timur',
            'Kalimantan Barat','Kalimantan Selatan','Kalimantan Tengah','Kalimantan Timur','Kalimantan Utara',
            'Kepulauan Bangka Belitung','Kepulauan Riau','Lampung','Maluku','Maluku Utara',
            'Nusa Tenggara Barat','Nusa Tenggara Timur','Papua','Papua Barat','Papua Barat Daya',
            'Papua Pegunungan','Papua Selatan','Papua Tengah','Riau','Sulawesi Barat',
            'Sulawesi Selatan','Sulawesi Tengah','Sulawesi Tenggara','Sulawesi Utara',
            'Sumatera Barat','Sumatera Selatan','Sumatera Utara'
        ],

        // Kabupaten/Kota (using same birth_place list)
        kabupaten: null // will be assigned below
    };

    // Kabupaten shares the same data as birth_place
    dropdownData.kabupaten = dropdownData.birth_place;

    // ========================================
    // SEARCHABLE DROPDOWN COMPONENT
    // ========================================

    document.querySelectorAll('.search-dropdown').forEach(function(container) {
        const name = container.dataset.name;
        const savedValue = container.dataset.value;
        const trigger = container.querySelector('.dropdown-trigger');
        const triggerText = trigger.querySelector('.trigger-text');
        const menu = container.querySelector('.dropdown-menu-custom');
        const optionsContainer = container.querySelector('.dropdown-options');
        const hiddenInput = container.querySelector('input[type="hidden"]');
        const searchInput = container.querySelector('.dropdown-search input');
        const isSimple = container.classList.contains('simple-dropdown');
        const options = dropdownData[name] || [];

        // Render options
        function renderOptions(filter = '') {
            const filtered = filter
                ? options.filter(opt => opt.toLowerCase().includes(filter.toLowerCase()))
                : options;

            if (filtered.length === 0) {
                optionsContainer.innerHTML = '<div class="no-results"><i class="fas fa-search"></i>Tidak ditemukan</div>';
                return;
            }

            optionsContainer.innerHTML = filtered.map(opt => {
                const isSelected = hiddenInput.value === opt;
                return `<div class="dropdown-option${isSelected ? ' selected' : ''}" data-value="${opt}">
                    <i class="fas fa-${isSelected ? 'check-circle' : 'circle'} option-icon"></i>
                    ${opt}
                </div>`;
            }).join('');

            // Click handlers
            optionsContainer.querySelectorAll('.dropdown-option').forEach(function(el) {
                el.addEventListener('click', function() {
                    selectOption(this.dataset.value);
                });
            });
        }

        function selectOption(value) {
            hiddenInput.value = value;
            triggerText.textContent = value;
            triggerText.classList.remove('placeholder-text');
            closeDropdown();
            renderOptions(searchInput ? searchInput.value : '');
        }

        function openDropdown() {
            // Close all others first
            document.querySelectorAll('.search-dropdown .dropdown-menu-custom.show').forEach(m => {
                m.classList.remove('show');
                m.closest('.search-dropdown').querySelector('.dropdown-trigger').classList.remove('open');
            });

            menu.classList.add('show');
            trigger.classList.add('open');
            renderOptions('');
            if (searchInput) {
                searchInput.value = '';
                setTimeout(() => searchInput.focus(), 50);
            }

            // Scroll selected into view
            setTimeout(() => {
                const selected = optionsContainer.querySelector('.dropdown-option.selected');
                if (selected) selected.scrollIntoView({ block: 'nearest' });
            }, 100);
        }

        function closeDropdown() {
            menu.classList.remove('show');
            trigger.classList.remove('open');
        }

        // Trigger click
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            if (menu.classList.contains('show')) {
                closeDropdown();
            } else {
                openDropdown();
            }
        });

        // Search input
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                renderOptions(this.value);
            });
            searchInput.addEventListener('click', function(e) {
                e.stopPropagation();
            });
            // Keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDropdown();
                    trigger.focus();
                }
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const first = optionsContainer.querySelector('.dropdown-option');
                    if (first) selectOption(first.dataset.value);
                }
            });
        }

        // Keyboard on trigger
        trigger.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openDropdown();
            }
            if (e.key === 'Escape') closeDropdown();
        });

        // Prevent menu click from closing
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Restore old value
        if (savedValue) {
            selectOption(savedValue);
        }

        // Initial render
        renderOptions();
    });

    // Close all dropdowns on outside click
    document.addEventListener('click', function() {
        document.querySelectorAll('.search-dropdown .dropdown-menu-custom.show').forEach(m => {
            m.classList.remove('show');
            m.closest('.search-dropdown').querySelector('.dropdown-trigger').classList.remove('open');
        });
    });

    // ========================================
    // FORM SUBMIT LOADING STATE
    // ========================================
    const form = document.getElementById('pendaftaranForm');
    const btn = document.getElementById('btnSubmit');
    if (form && btn) {
        form.addEventListener('submit', function() {
            btn.classList.add('loading');
            btn.disabled = true;
        });
    }
});
</script>
@endsection
