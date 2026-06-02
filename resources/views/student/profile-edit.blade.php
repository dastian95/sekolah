@extends('layouts.student')

@section('title', 'Ubah Data - ' . $student->nama)

@section('content')
<style>
    .form-section {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 1.25rem;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
    }
    .form-section-header {
        background-color: var(--dark-blue);
        color: white;
        padding: 0.65rem 1.25rem;
        font-weight: 600;
        font-size: 0.95rem;
    }
    .form-section-header i { margin-right: 0.5rem; }
    .form-section-body { padding: 1.25rem; }
    .form-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: #333;
        margin-bottom: 4px;
    }
    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: border-color 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(0,102,204,0.12);
    }
    .required-star { color: #dc3545; margin-left: 2px; }
    .badge-opsional { font-size: 0.65rem; font-weight: 500; vertical-align: middle; }
    .parent-title {
        font-weight: 700;
        font-size: 0.88rem;
        padding-bottom: 0.3rem;
        margin-bottom: 0.75rem;
        border-bottom: 2px solid;
    }
</style>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); color: var(--dark-blue); padding: 1.5rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 1.6rem; font-weight: 700; margin: 0;">Ubah Data Pendaftaran</h1>
                <p style="margin-top: 0.25rem; margin-bottom: 0; opacity: 0.9; font-size: 0.9rem;">Perbarui informasi data diri Anda</p>
            </div>
            <a href="{{ route('student.profile') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Batal
            </a>
        </div>
    </div>
</section>

<section style="padding: 1.5rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <form action="{{ route('student.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-circle me-1"></i>Ada kesalahan input:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Kolom bertanda <span class="badge bg-secondary badge-opsional">Opsional</span> tidak wajib diisi.
                        Field bertanda <span class="required-star">*</span> wajib diisi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                    {{-- Data Akun --}}
                    <div class="form-section">
                        <div class="form-section-header"><i class="fas fa-user-circle"></i>Data Akun</div>
                        <div class="form-section-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="required-star">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" name="nama"
                                           value="{{ old('nama', $student->nama) }}"
                                           placeholder="{{ $student->nama ?: 'Contoh: Ahmad Fauzi' }}"
                                           required>
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username <span class="required-star">*</span></label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                           id="username" name="username"
                                           value="{{ old('username', $student->username) }}"
                                           placeholder="{{ $student->username ?: 'Contoh: ahmad_fauzi' }}"
                                           required>
                                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="required-star">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email"
                                           value="{{ old('email', $student->email) }}"
                                           placeholder="{{ $student->email ?: 'Contoh: ahmad@gmail.com' }}"
                                           required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="hp" class="form-label">No. HP (WhatsApp) <span class="required-star">*</span></label>
                                    <input type="tel" class="form-control @error('hp') is-invalid @enderror"
                                           id="hp" name="hp"
                                           value="{{ old('hp', $student->hp) }}"
                                           placeholder="{{ $student->hp ?: 'Contoh: 08123456789' }}"
                                           required>
                                    @error('hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Identitas --}}
                    <div class="form-section">
                        <div class="form-section-header"><i class="fas fa-id-card"></i>Data Identitas</div>
                        <div class="form-section-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="sekolah_asal" class="form-label">Sekolah Asal <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('sekolah_asal') is-invalid @enderror"
                                           id="sekolah_asal" name="sekolah_asal"
                                           value="{{ old('sekolah_asal', $student->sekolah_asal) }}"
                                           placeholder="{{ $student->sekolah_asal ?: 'Contoh: TK Al-Ikhlas' }}">
                                    @error('sekolah_asal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nisn" class="form-label">NISN <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                           id="nisn" name="nisn"
                                           value="{{ old('nisn', $student->nisn) }}"
                                           placeholder="{{ $student->nisn ?: 'Contoh: 0012345678' }}">
                                    @error('nisn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nik" class="form-label">NIK <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                           id="nik" name="nik"
                                           value="{{ old('nik', $student->nik) }}"
                                           placeholder="{{ $student->nik ?: 'Contoh: 3201234567890001' }}">
                                    @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="required-star">*</span></label>
                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L" {{ old('jenis_kelamin', $student->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $student->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="agama" class="form-label">Agama <span class="required-star">*</span></label>
                                    <select class="form-select @error('agama') is-invalid @enderror"
                                            id="agama" name="agama" required>
                                        <option value="">-- Pilih Agama --</option>
                                        @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                                            <option value="{{ $agama }}" {{ old('agama', $student->agama) === $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                        @endforeach
                                    </select>
                                    @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="required-star">*</span></label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                           id="tempat_lahir" name="tempat_lahir"
                                           value="{{ old('tempat_lahir', $student->tempat_lahir) }}"
                                           placeholder="{{ $student->tempat_lahir ?: 'Contoh: Jakarta' }}"
                                           required>
                                    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="required-star">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                           id="tanggal_lahir" name="tanggal_lahir"
                                           value="{{ old('tanggal_lahir', $student->tanggal_lahir ? $student->tanggal_lahir->format('Y-m-d') : '') }}"
                                           required>
                                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="anak_ke" class="form-label">Anak Ke- <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="number" class="form-control @error('anak_ke') is-invalid @enderror"
                                           id="anak_ke" name="anak_ke" min="1"
                                           value="{{ old('anak_ke', $student->anak_ke) }}"
                                           placeholder="{{ $student->anak_ke ?: 'Contoh: 1' }}">
                                    @error('anak_ke')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status_keluarga" class="form-label">Status Keluarga <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <select class="form-select @error('status_keluarga') is-invalid @enderror"
                                            id="status_keluarga" name="status_keluarga">
                                        <option value="">-- Pilih Status --</option>
                                        @foreach(['Anak Kandung','Anak Tiri','Anak Angkat'] as $st)
                                            <option value="{{ $st }}" {{ old('status_keluarga', $student->status_keluarga) === $st ? 'selected' : '' }}>{{ $st }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_keluarga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="form-section">
                        <div class="form-section-header"><i class="fas fa-map-marker-alt"></i>Alamat</div>
                        <div class="form-section-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="alamat" class="form-label">Alamat Lengkap <span class="required-star">*</span></label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                                              id="alamat" name="alamat" rows="3"
                                              placeholder="{{ $student->alamat ?: 'Contoh: Jl. Merdeka No. 12' }}"
                                              required>{{ old('alamat', $student->alamat) }}</textarea>
                                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="rt" class="form-label">RT <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                           id="rt" name="rt"
                                           value="{{ old('rt', $student->rt) }}"
                                           placeholder="{{ $student->rt ?: '001' }}">
                                    @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="rw" class="form-label">RW <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                           id="rw" name="rw"
                                           value="{{ old('rw', $student->rw) }}"
                                           placeholder="{{ $student->rw ?: '005' }}">
                                    @error('rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kelurahan" class="form-label">Kelurahan / Desa <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('kelurahan') is-invalid @enderror"
                                           id="kelurahan" name="kelurahan"
                                           value="{{ old('kelurahan', $student->kelurahan) }}"
                                           placeholder="{{ $student->kelurahan ?: 'Contoh: Pasar Rebo' }}">
                                    @error('kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                           id="kecamatan" name="kecamatan"
                                           value="{{ old('kecamatan', $student->kecamatan) }}"
                                           placeholder="{{ $student->kecamatan ?: 'Contoh: Pasar Rebo' }}">
                                    @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kabupaten" class="form-label">Kabupaten / Kota <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                           id="kabupaten" name="kabupaten"
                                           value="{{ old('kabupaten', $student->kabupaten) }}"
                                           placeholder="{{ $student->kabupaten ?: 'Contoh: Jakarta Timur' }}">
                                    @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi" class="form-label">Provinsi <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                           id="provinsi" name="provinsi"
                                           value="{{ old('provinsi', $student->provinsi) }}"
                                           placeholder="{{ $student->provinsi ?: 'Contoh: DKI Jakarta' }}">
                                    @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kode_pos" class="form-label">Kode Pos <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                           id="kode_pos" name="kode_pos"
                                           value="{{ old('kode_pos', $student->kode_pos) }}"
                                           placeholder="{{ $student->kode_pos ?: '13760' }}">
                                    @error('kode_pos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Data Orang Tua --}}
                    <div class="form-section">
                        <div class="form-section-header"><i class="fas fa-users"></i>Data Orang Tua / Wali</div>
                        <div class="form-section-body">

                            <p class="parent-title" style="color: #2196F3; border-color: #2196F3;">
                                <i class="fas fa-mars me-1"></i>Data Ayah
                            </p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah <span class="required-star">*</span></label>
                                    <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                           id="nama_ayah" name="nama_ayah"
                                           value="{{ old('nama_ayah', $student->nama_ayah) }}"
                                           placeholder="{{ $student->nama_ayah ?: 'Contoh: Budi Santoso' }}"
                                           required>
                                    @error('nama_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <select class="form-select @error('pekerjaan_ayah') is-invalid @enderror"
                                            id="pekerjaan_ayah" name="pekerjaan_ayah">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        @php
                                            $pekerjaan = ['PNS','TNI/Polri','Pegawai Swasta','Wiraswasta','Pedagang','Petani','Nelayan','Buruh','Guru/Dosen','Dokter/Tenaga Medis','Tidak Bekerja','Lainnya'];
                                        @endphp
                                        @foreach($pekerjaan as $p)
                                            <option value="{{ $p }}" {{ old('pekerjaan_ayah', $student->pekerjaan_ayah) === $p ? 'selected' : '' }}>{{ $p }}</option>
                                        @endforeach
                                    </select>
                                    @error('pekerjaan_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nohp_ayah" class="form-label">No. HP Ayah <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="tel" class="form-control @error('nohp_ayah') is-invalid @enderror"
                                           id="nohp_ayah" name="nohp_ayah"
                                           value="{{ old('nohp_ayah', $student->nohp_ayah) }}"
                                           placeholder="{{ $student->nohp_ayah ?: 'Contoh: 08111234567' }}">
                                    @error('nohp_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <p class="parent-title mt-3" style="color: #E91E63; border-color: #E91E63;">
                                <i class="fas fa-venus me-1"></i>Data Ibu
                            </p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                           id="nama_ibu" name="nama_ibu"
                                           value="{{ old('nama_ibu', $student->nama_ibu) }}"
                                           placeholder="{{ $student->nama_ibu ?: 'Contoh: Siti Rahayu' }}">
                                    @error('nama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <select class="form-select @error('pekerjaan_ibu') is-invalid @enderror"
                                            id="pekerjaan_ibu" name="pekerjaan_ibu">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        @foreach($pekerjaan as $p)
                                            <option value="{{ $p }}" {{ old('pekerjaan_ibu', $student->pekerjaan_ibu) === $p ? 'selected' : '' }}>{{ $p }}</option>
                                        @endforeach
                                    </select>
                                    @error('pekerjaan_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nohp_ibu" class="form-label">No. HP Ibu <span class="badge bg-secondary badge-opsional">Opsional</span></label>
                                    <input type="tel" class="form-control @error('nohp_ibu') is-invalid @enderror"
                                           id="nohp_ibu" name="nohp_ibu"
                                           value="{{ old('nohp_ibu', $student->nohp_ibu) }}"
                                           placeholder="{{ $student->nohp_ibu ?: 'Contoh: 08111234567' }}">
                                    @error('nohp_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <p class="parent-title mt-3" style="color: #FF9800; border-color: #FF9800;">
                                <i class="fas fa-shield-alt me-1"></i>Data Wali <span class="badge bg-secondary badge-opsional">Opsional</span>
                            </p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_wali" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control @error('nama_wali') is-invalid @enderror"
                                           id="nama_wali" name="nama_wali"
                                           value="{{ old('nama_wali', $student->nama_wali) }}"
                                           placeholder="{{ $student->nama_wali ?: 'Kosongkan jika tidak ada' }}">
                                    @error('nama_wali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nohp_wali" class="form-label">No. HP Wali</label>
                                    <input type="tel" class="form-control @error('nohp_wali') is-invalid @enderror"
                                           id="nohp_wali" name="nohp_wali"
                                           value="{{ old('nohp_wali', $student->nohp_wali) }}"
                                           placeholder="{{ $student->nohp_wali ?: 'Contoh: 08111234567' }}">
                                    @error('nohp_wali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-2 mb-4">
                        <a href="{{ route('student.profile') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection
