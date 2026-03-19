@extends('layouts.student')

@section('title', 'Profil Siswa - ' . auth('students')->user()->nama)

@section('content')
<style>
    .profile-accordion .accordion-button {
        background-color: var(--dark-blue);
        color: white;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .profile-accordion .accordion-button:not(.collapsed) {
        background-color: var(--dark-blue);
        color: white;
        box-shadow: none;
    }
    .profile-accordion .accordion-button:hover {
        filter: brightness(1.15);
    }
    .profile-accordion .accordion-button::after {
        filter: brightness(0) invert(1);
        transition: transform 0.4s ease;
    }
    .profile-accordion .accordion-button:focus {
        box-shadow: none;
    }
    .profile-accordion .accordion-collapse {
        transition: height 0.4s ease, opacity 0.35s ease;
    }
    .profile-accordion .accordion-collapse.collapsing {
        transition: height 0.4s ease;
    }
    .profile-accordion .accordion-body {
        padding: 0.75rem 1rem;
        animation: fadeInBody 0.3s ease;
    }
    @keyframes fadeInBody {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .profile-accordion .accordion-item {
        border: none;
        margin-bottom: 0.5rem;
        border-radius: 0.5rem !important;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    .profile-field {
        margin-bottom: 0.4rem;
        padding: 0.3rem 0;
    }
    .profile-field .field-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 0;
        line-height: 1.2;
    }
    .profile-field .field-value {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0;
        line-height: 1.4;
    }
    .parent-section-title {
        font-weight: 600;
        font-size: 0.9rem;
        border-bottom: 2px solid;
        padding-bottom: 0.35rem;
        margin-bottom: 0.5rem;
    }
</style>
@php $siswa = auth('students')->user(); @endphp

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 1.5rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 1.6rem; font-weight: 700; margin: 0;">Profil Lengkap</h1>
                <p style="margin-top: 0.25rem; margin-bottom: 0; opacity: 0.9; font-size: 0.95rem;">{{ $siswa->nama }}</p>
            </div>
            <a href="{{ route('student.dashboard') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 1.5rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-9">
                <div class="accordion profile-accordion" id="profilAccordion">

                    <!-- Data Identitas -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIdentitas">
                                <i class="fas fa-id-card me-2"></i>Data Identitas
                            </button>
                        </h2>
                        <div id="collapseIdentitas" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Nama Lengkap</p>
                                        <p class="field-value">{{ $siswa->nama }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">NISN</p>
                                        <p class="field-value">{{ $siswa->nisn }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">NIS</p>
                                        <p class="field-value">{{ $siswa->nis ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Jenis Kelamin</p>
                                        <p class="field-value">
                                            @if($siswa->jenis_kelamin == 'L')
                                                <i class="fas fa-mars" style="color: #2196F3;"></i> Laki-laki
                                            @else
                                                <i class="fas fa-venus" style="color: #E91E63;"></i> Perempuan
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">NIK</p>
                                        <p class="field-value">{{ $siswa->nik ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Warga Negara</p>
                                        <p class="field-value">{{ $siswa->warga_negara ?? 'Indonesia' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pribadi -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePribadi">
                                <i class="fas fa-birthday-cake me-2"></i>Data Pribadi
                            </button>
                        </h2>
                        <div id="collapsePribadi" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Tempat Lahir</p>
                                        <p class="field-value">{{ $siswa->tempat_lahir }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Tanggal Lahir</p>
                                        <p class="field-value">{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d M Y') : '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Agama</p>
                                        <p class="field-value">{{ $siswa->agama ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Anak Ke</p>
                                        <p class="field-value">{{ $siswa->anak_ke ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Status Keluarga</p>
                                        <p class="field-value">{{ $siswa->status_keluarga ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Akademik & Kontak (digabung) -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAkademik">
                                <i class="fas fa-book me-2"></i>Data Akademik & Kontak
                            </button>
                        </h2>
                        <div id="collapseAkademik" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Tahun Masuk</p>
                                        <p class="field-value">{{ $siswa->tahun_masuk ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Kelas Awal</p>
                                        <p class="field-value">{{ $siswa->kelas_awal ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Sekolah Asal</p>
                                        <p class="field-value">{{ $siswa->sekolah_asal ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Email</p>
                                        <p class="field-value">{{ $siswa->email }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">No. HP</p>
                                        <p class="field-value">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siswa->hp) }}" target="_blank" class="text-decoration-none">
                                                {{ $siswa->hp }}
                                                <i class="fab fa-whatsapp ms-1" style="color: #25d366;"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Alamat -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlamat">
                                <i class="fas fa-map-marker-alt me-2"></i>Data Alamat
                            </button>
                        </h2>
                        <div id="collapseAlamat" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 profile-field">
                                        <p class="field-label">Alamat Lengkap</p>
                                        <p class="field-value">{{ $siswa->alamat ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3 profile-field">
                                        <p class="field-label">RT / RW</p>
                                        <p class="field-value">{{ $siswa->rt ?? '-' }} / {{ $siswa->rw ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3 profile-field">
                                        <p class="field-label">Kelurahan</p>
                                        <p class="field-value">{{ $siswa->kelurahan ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3 profile-field">
                                        <p class="field-label">Kecamatan</p>
                                        <p class="field-value">{{ $siswa->kecamatan ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3 profile-field">
                                        <p class="field-label">Kabupaten / Kota</p>
                                        <p class="field-value">{{ $siswa->kabupaten ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3 profile-field">
                                        <p class="field-label">Provinsi</p>
                                        <p class="field-value">{{ $siswa->provinsi ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3 profile-field">
                                        <p class="field-label">Kode Pos</p>
                                        <p class="field-value">{{ $siswa->kode_pos ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Orang Tua / Wali -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrtu">
                                <i class="fas fa-users me-2"></i>Data Orang Tua / Wali
                            </button>
                        </h2>
                        <div id="collapseOrtu" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <!-- Ayah -->
                                <p class="parent-section-title" style="border-color: var(--primary-blue);">
                                    <i class="fas fa-mars me-1" style="color: #2196F3;"></i>Data Ayah
                                </p>
                                <div class="row mb-2">
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Nama</p>
                                        <p class="field-value">{{ $siswa->nama_ayah ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Tanggal Lahir</p>
                                        <p class="field-value">{{ $siswa->tgl_lahir_ayah ? $siswa->tgl_lahir_ayah->format('d M Y') : '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Pendidikan</p>
                                        <p class="field-value">{{ $siswa->pendidikan_ayah ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Pekerjaan</p>
                                        <p class="field-value">{{ $siswa->pekerjaan_ayah ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">No. HP</p>
                                        <p class="field-value">{{ $siswa->nohp_ayah ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Alamat</p>
                                        <p class="field-value">{{ $siswa->alamat_ayah ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Ibu -->
                                <p class="parent-section-title" style="border-color: #E91E63;">
                                    <i class="fas fa-venus me-1" style="color: #E91E63;"></i>Data Ibu
                                </p>
                                <div class="row mb-2">
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Nama</p>
                                        <p class="field-value">{{ $siswa->nama_ibu ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Tanggal Lahir</p>
                                        <p class="field-value">{{ $siswa->tgl_lahir_ibu ? $siswa->tgl_lahir_ibu->format('d M Y') : '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Pendidikan</p>
                                        <p class="field-value">{{ $siswa->pendidikan_ibu ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Pekerjaan</p>
                                        <p class="field-value">{{ $siswa->pekerjaan_ibu ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">No. HP</p>
                                        <p class="field-value">{{ $siswa->nohp_ibu ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4 profile-field">
                                        <p class="field-label">Alamat</p>
                                        <p class="field-value">{{ $siswa->alamat_ibu ?? '-' }}</p>
                                    </div>
                                </div>

                                <!-- Wali (jika ada) -->
                                @if($siswa->nama_wali)
                                    <p class="parent-section-title" style="border-color: #FF9800;">
                                        <i class="fas fa-shield-alt me-1" style="color: #FF9800;"></i>Data Wali
                                    </p>
                                    <div class="row">
                                        <div class="col-md-4 profile-field">
                                            <p class="field-label">Nama</p>
                                            <p class="field-value">{{ $siswa->nama_wali }}</p>
                                        </div>
                                        <div class="col-md-4 profile-field">
                                            <p class="field-label">Tanggal Lahir</p>
                                            <p class="field-value">{{ $siswa->tgl_lahir_wali ? $siswa->tgl_lahir_wali->format('d M Y') : '-' }}</p>
                                        </div>
                                        <div class="col-md-4 profile-field">
                                            <p class="field-label">Pendidikan</p>
                                            <p class="field-value">{{ $siswa->pendidikan_wali ?? '-' }}</p>
                                        </div>
                                        <div class="col-md-4 profile-field">
                                            <p class="field-label">Pekerjaan</p>
                                            <p class="field-value">{{ $siswa->pekerjaan_wali ?? '-' }}</p>
                                        </div>
                                        <div class="col-md-4 profile-field">
                                            <p class="field-label">No. HP</p>
                                            <p class="field-value">{{ $siswa->nohp_wali ?? '-' }}</p>
                                        </div>
                                        <div class="col-md-4 profile-field">
                                            <p class="field-label">Alamat</p>
                                            <p class="field-value">{{ $siswa->alamat_wali ?? '-' }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <!-- Info Card -->
                <div class="card shadow-sm border-0 mb-3" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue);">
                    <div class="card-body py-2 px-3">
                        <h6 class="fw-bold mb-2" style="font-size: 0.9rem;"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.8rem;">
                            <li class="mb-1">
                                <i class="fas fa-calendar-check me-1"></i>
                                Dibuat: {{ $siswa->created_at->format('d M Y') }}
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-clock me-1"></i>
                                Update: {{ $siswa->updated_at->format('d M Y') }}
                            </li>
                            <li>
                                <i class="fas fa-check-circle me-1"></i>
                                Status: {{ $siswa->status ?? 'Aktif' }}
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="card shadow-sm border-0">
                    <div class="card-header py-2" style="background-color: var(--dark-blue); color: white;">
                        <h6 class="mb-0" style="font-size: 0.9rem;"><i class="fas fa-bars me-2"></i>Menu</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('student.dashboard') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2">
                            <span style="font-size: 0.9rem;"><i class="fas fa-home me-2" style="color: var(--primary-blue);"></i> Dashboard</span>
                            <i class="fas fa-chevron-right text-muted" style="font-size: 0.7rem;"></i>
                        </a>
                        <a href="{{ route('student.graduation.status') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2">
                            <span style="font-size: 0.9rem;"><i class="fas fa-graduation-cap me-2" style="color: #28a745;"></i> Status Kelulusan</span>
                            <i class="fas fa-chevron-right text-muted" style="font-size: 0.7rem;"></i>
                        </a>
                        <a href="{{ route('student.change-password') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2">
                            <span style="font-size: 0.9rem;"><i class="fas fa-key me-2" style="color: #ff9800;"></i> Ubah Password</span>
                            <i class="fas fa-chevron-right text-muted" style="font-size: 0.7rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
