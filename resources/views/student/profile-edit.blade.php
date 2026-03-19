@extends('layouts.student')

@section('title', 'Edit Profil - ' . $student->nama_lengkap)

@section('content')
<style>
    .ppdb-hero {
        padding: 50px 0 35px;
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
    .form-section {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
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
    @media (max-width: 767px) {
        .ppdb-hero { padding: 40px 0 25px; }
        .ppdb-hero h1 { font-size: 1.5rem; }
    }
</style>

<!-- Page Header -->
<div class="ppdb-hero" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
    <div class="container-lg">
        <h1>Edit Profil Siswa</h1>
        <p>Perbarui informasi data diri Anda di bawah ini.</p>
    </div>
</div>

<!-- Main Content -->
<section style="padding: 2rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi Kesalahan!</strong> Harap periksa kembali isian Anda.
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Data Diri Siswa -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-user-circle"></i>
                            Data Diri Calon Peserta Didik
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="required">*</span></label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $student->nama_lengkap) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username <span class="required">*</span></label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $student->username) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="required">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telepon" class="form-label">No. HP (WhatsApp) <span class="required">*</span></label>
                                <input type="tel" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $student->telepon) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nisn" class="form-label">NISN <span class="required">*</span></label>
                                <input type="text" class="form-control" id="nisn" name="nisn" value="{{ old('nisn', $student->nisn) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nik" class="form-label">NIK <span class="required">*</span></label>
                                <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $student->nik) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_kk" class="form-label">Nomor Kartu Keluarga (KK) <span class="required">*</span></label>
                                <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ old('no_kk', $student->no_kk) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="required">*</span></label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="required">*</span></label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $student->tempat_lahir) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="required">*</span></label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $student->tanggal_lahir ? $student->tanggal_lahir->format('Y-m-d') : '') }}" required>
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="agama" class="form-label">Agama <span class="required">*</span></label>
                                <input type="text" class="form-control" id="agama" name="agama" value="{{ old('agama', $student->agama) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="anak_ke" class="form-label">Anak Ke-</label>
                                <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $student->anak_ke) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jumlah_saudara" class="form-label">Jumlah Saudara Kandung</label>
                                <input type="number" class="form-control" id="jumlah_saudara" name="jumlah_saudara" value="{{ old('jumlah_saudara', $student->jumlah_saudara) }}">
                            </div>
                              <div class="col-md-6 mb-3">
                                <label for="tinggal_bersama" class="form-label">Tinggal Bersama</label>
                                <input type="text" class="form-control" id="tinggal_bersama" name="tinggal_bersama" value="{{ old('tinggal_bersama', $student->tinggal_bersama) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Alamat Lengkap
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="alamat" class="form-label">Alamat Sesuai KK <span class="required">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $student->alamat) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Data Orang Tua -->
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-users"></i>
                            Data Orang Tua / Wali
                        </div>
                        <!-- Ayah -->
                        <h6 class="mt-2 mb-3 fw-bold">Data Ayah</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah <span class="required">*</span></label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $student->nama_ayah) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $student->pekerjaan_ayah) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                                <input type="text" class="form-control" id="penghasilan_ayah" name="penghasilan_ayah" value="{{ old('penghasilan_ayah', $student->penghasilan_ayah) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="hp_ayah" class="form-label">No. HP Ayah</label>
                                <input type="tel" class="form-control" id="hp_ayah" name="hp_ayah" value="{{ old('hp_ayah', $student->hp_ayah) }}">
                            </div>
                        </div>
                        <!-- Ibu -->
                        <h6 class="mt-4 mb-3 fw-bold">Data Ibu</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu <span class="required">*</span></label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $student->nama_ibu) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $student->pekerjaan_ibu) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                                <input type="text" class="form-control" id="penghasilan_ibu" name="penghasilan_ibu" value="{{ old('penghasilan_ibu', $student->penghasilan_ibu) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="hp_ibu" class="form-label">No. HP Ibu</label>
                                <input type="tel" class="form-control" id="hp_ibu" name="hp_ibu" value="{{ old('hp_ibu', $student->hp_ibu) }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
