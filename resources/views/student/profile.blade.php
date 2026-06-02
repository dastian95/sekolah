@extends('layouts.student')

@section('title', 'Data Lengkap - ' . $student->nama)

@section('content')
<style>
    .profile-field {
        margin-bottom: 0.6rem;
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
    .section-header {
        background-color: var(--dark-blue);
        color: white;
        padding: 0.65rem 1rem;
        border-radius: 0.375rem 0.375rem 0 0;
        font-weight: 600;
        font-size: 0.95rem;
    }
    .section-header i {
        margin-right: 0.5rem;
    }
    .section-body {
        padding: 1rem;
        background: white;
        border: 1px solid #dee2e6;
        border-top: none;
        border-radius: 0 0 0.375rem 0.375rem;
        margin-bottom: 1rem;
    }
    .parent-divider {
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: 2px solid;
        padding-bottom: 0.3rem;
        margin-bottom: 0.75rem;
        margin-top: 0.5rem;
    }
</style>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 1.5rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 1.6rem; font-weight: 700; margin: 0;">Data Lengkap Pendaftar</h1>
                <p style="margin-top: 0.25rem; margin-bottom: 0; opacity: 0.9; font-size: 0.95rem;">{{ $student->nama }}</p>
            </div>
            <div class="d-flex gap-2">
                @if($student->canEditProfile())
                    <a href="{{ route('student.profile.edit') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i> Ubah Data
                    </a>
                @endif
                <a href="{{ route('student.dashboard') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 1.5rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-9">

                <!-- Data Identitas -->
                <div class="section-header"><i class="fas fa-id-card"></i>Data Identitas</div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Nama Lengkap</p>
                            <p class="field-value">{{ $student->nama }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">NISN</p>
                            <p class="field-value">{{ $student->nisn ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">NIK</p>
                            <p class="field-value">{{ $student->nik ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Jenis Kelamin</p>
                            <p class="field-value">
                                @if($student->jenis_kelamin === 'L')
                                    <i class="fas fa-mars me-1" style="color: #2196F3;"></i>Laki-laki
                                @elseif($student->jenis_kelamin === 'P')
                                    <i class="fas fa-venus me-1" style="color: #E91E63;"></i>Perempuan
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Warga Negara</p>
                            <p class="field-value">{{ $student->warga_negara ?? 'Indonesia' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">No. Registrasi</p>
                            <p class="field-value">{{ $student->registration_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Data Pribadi -->
                <div class="section-header"><i class="fas fa-birthday-cake"></i>Data Pribadi</div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Sekolah Asal</p>
                            <p class="field-value">{{ $student->sekolah_asal ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Tempat Lahir</p>
                            <p class="field-value">{{ $student->tempat_lahir ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Tanggal Lahir</p>
                            <p class="field-value">{{ $student->tanggal_lahir ? $student->tanggal_lahir->format('d M Y') : '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Agama</p>
                            <p class="field-value">{{ $student->agama ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Anak Ke</p>
                            <p class="field-value">{{ $student->anak_ke ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Status Keluarga</p>
                            <p class="field-value">{{ $student->status_keluarga ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Kontak & Akun -->
                <div class="section-header"><i class="fas fa-envelope"></i>Kontak & Akun</div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Email</p>
                            <p class="field-value">{{ $student->email ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">No. HP (WhatsApp)</p>
                            <p class="field-value">
                                @if($student->hp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $student->hp) }}" target="_blank" class="text-decoration-none text-dark">
                                        {{ $student->hp }} <i class="fab fa-whatsapp ms-1" style="color: #25d366;"></i>
                                    </a>
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 profile-field">
                            <p class="field-label">Username</p>
                            <p class="field-value">{{ $student->username ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="section-header"><i class="fas fa-map-marker-alt"></i>Alamat</div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 profile-field">
                            <p class="field-label">Alamat Lengkap</p>
                            <p class="field-value">{{ $student->alamat ?? '-' }}</p>
                        </div>
                        <div class="col-md-3 profile-field">
                            <p class="field-label">RT / RW</p>
                            <p class="field-value">{{ $student->rt ?? '-' }} / {{ $student->rw ?? '-' }}</p>
                        </div>
                        <div class="col-md-3 profile-field">
                            <p class="field-label">Kelurahan</p>
                            <p class="field-value">{{ $student->kelurahan ?? '-' }}</p>
                        </div>
                        <div class="col-md-3 profile-field">
                            <p class="field-label">Kecamatan</p>
                            <p class="field-value">{{ $student->kecamatan ?? '-' }}</p>
                        </div>
                        <div class="col-md-3 profile-field">
                            <p class="field-label">Kabupaten / Kota</p>
                            <p class="field-value">{{ $student->kabupaten ?? '-' }}</p>
                        </div>
                        <div class="col-md-3 profile-field">
                            <p class="field-label">Provinsi</p>
                            <p class="field-value">{{ $student->provinsi ?? '-' }}</p>
                        </div>
                        <div class="col-md-3 profile-field">
                            <p class="field-label">Kode Pos</p>
                            <p class="field-value">{{ $student->kode_pos ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua / Wali -->
                <div class="section-header"><i class="fas fa-users"></i>Data Orang Tua / Wali</div>
                <div class="section-body">
                    <p class="parent-divider" style="color: #2196F3; border-color: #2196F3;">
                        <i class="fas fa-mars me-1"></i>Ayah
                    </p>
                    <div class="row mb-3">
                        <div class="col-md-4 profile-field">
                            <p class="field-label">Nama</p>
                            <p class="field-value">{{ $student->nama_ayah ?? '-' }}</p>
                        </div>
                        <div class="col-md-4 profile-field">
                            <p class="field-label">Pekerjaan</p>
                            <p class="field-value">{{ $student->pekerjaan_ayah ?? '-' }}</p>
                        </div>
                        <div class="col-md-4 profile-field">
                            <p class="field-label">No. HP</p>
                            <p class="field-value">{{ $student->nohp_ayah ?? '-' }}</p>
                        </div>
                    </div>

                    <p class="parent-divider" style="color: #E91E63; border-color: #E91E63;">
                        <i class="fas fa-venus me-1"></i>Ibu
                    </p>
                    <div class="row mb-3">
                        <div class="col-md-4 profile-field">
                            <p class="field-label">Nama</p>
                            <p class="field-value">{{ $student->nama_ibu ?? '-' }}</p>
                        </div>
                        <div class="col-md-4 profile-field">
                            <p class="field-label">Pekerjaan</p>
                            <p class="field-value">{{ $student->pekerjaan_ibu ?? '-' }}</p>
                        </div>
                        <div class="col-md-4 profile-field">
                            <p class="field-label">No. HP</p>
                            <p class="field-value">{{ $student->nohp_ibu ?? '-' }}</p>
                        </div>
                    </div>

                    @if($student->nama_wali)
                        <p class="parent-divider" style="color: #FF9800; border-color: #FF9800;">
                            <i class="fas fa-shield-alt me-1"></i>Wali
                        </p>
                        <div class="row">
                            <div class="col-md-4 profile-field">
                                <p class="field-label">Nama</p>
                                <p class="field-value">{{ $student->nama_wali }}</p>
                            </div>
                            <div class="col-md-4 profile-field">
                                <p class="field-label">No. HP</p>
                                <p class="field-value">{{ $student->nohp_wali ?? '-' }}</p>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-3">
                <!-- Status & Info -->
                <div class="card shadow-sm border-0 mb-3" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue);">
                    <div class="card-body py-3 px-3">
                        <h6 class="fw-bold mb-2" style="font-size: 0.9rem;"><i class="fas fa-info-circle me-2"></i>Informasi Akun</h6>
                        <ul class="list-unstyled mb-0" style="font-size: 0.8rem;">
                            <li class="mb-2">
                                <i class="fas fa-calendar-check me-1"></i>
                                Daftar: {{ $student->created_at->format('d M Y') }}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-clock me-1"></i>
                                Update: {{ $student->updated_at->format('d M Y') }}
                            </li>
                            <li>
                                <i class="fas fa-circle me-1"></i>
                                Status: <strong>{{ $student->status_label }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>

                @if($student->canEditProfile())
                    <a href="{{ route('student.profile.edit') }}" class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-edit me-2"></i> Ubah Data
                    </a>
                @endif

                <!-- Navigation -->
                <div class="card shadow-sm border-0">
                    <div class="card-header py-2" style="background-color: var(--dark-blue); color: white;">
                        <h6 class="mb-0" style="font-size: 0.9rem;"><i class="fas fa-bars me-2"></i>Menu</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('student.dashboard') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2">
                            <span style="font-size: 0.9rem;"><i class="fas fa-home me-2" style="color: var(--primary-blue);"></i>Dashboard</span>
                            <i class="fas fa-chevron-right text-muted" style="font-size: 0.7rem;"></i>
                        </a>
                        <a href="{{ route('student.graduation.status') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2">
                            <span style="font-size: 0.9rem;"><i class="fas fa-clipboard-check me-2" style="color: #28a745;"></i>Status Pendaftaran</span>
                            <i class="fas fa-chevron-right text-muted" style="font-size: 0.7rem;"></i>
                        </a>
                        <a href="{{ route('student.change-password') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 text-muted">
                            <span style="font-size: 0.9rem;"><i class="fas fa-lock me-2"></i>Ubah Password</span>
                            <i class="fas fa-chevron-right text-muted" style="font-size: 0.7rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
