@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Pindahan - SDIT Labitech Insan Mulia')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 3rem 0;">
    <div class="container-lg">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin: 0;">Pendaftaran Siswa Pindahan</h1>
        <p style="margin-top: 0.5rem; font-size: 1.1rem; opacity: 0.9;">Penerimaan Siswa Pindahan (Transfer) SDIT Labitech Insan Mulia</p>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 style="color: var(--dark-blue); font-weight: 700;">Formulir Pendaftaran Siswa Pindahan</h2>
                            <p class="text-muted">Silakan lengkapi data calon siswa dan orang tua di bawah ini. Dokumen pendukung sangat membantu proses seleksi.</p>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('pendaftaran-pindahan.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- Data Siswa -->
                            <h4 class="mb-3" style="color: var(--primary-blue); border-bottom: 2px solid var(--secondary-yellow); display: inline-block; padding-bottom: 5px;">Data Calon Siswa</h4>
                            
                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="nama_siswa" name="full_name" value="{{ old('full_name') }}" placeholder="Sesuai Akta Kelahiran" required>
                                @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('birth_place') is-invalid @enderror" id="tempat_lahir" name="birth_place" value="{{ old('birth_place') }}" required>
                                    @error('birth_place')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="tanggal_lahir" name="birth_date" value="{{ old('birth_date') }}" required>
                                    @error('birth_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="jk_lk" value="L" {{ old('gender') == 'L' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_lk">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="jk_pr" value="P" {{ old('gender') == 'P' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_pr">Perempuan</label>
                                    </div>
                                </div>
                                @error('gender')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Data Sekolah Sebelumnya -->
                            <h4 class="mb-3 mt-4" style="color: var(--primary-blue); border-bottom: 2px solid var(--secondary-yellow); display: inline-block; padding-bottom: 5px;">Data Sekolah Sebelumnya</h4>

                            <div class="mb-3">
                                <label for="sekolah_sebelumnya" class="form-label fw-bold">Nama Sekolah Sebelumnya <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('previous_school') is-invalid @enderror" id="sekolah_sebelumnya" name="previous_school" value="{{ old('previous_school') }}" placeholder="Nama sekolah asal" required>
                                @error('previous_school')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kelas_saat_ini" class="form-label fw-bold">Kelas Saat Ini <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('current_class') is-invalid @enderror" id="kelas_saat_ini" name="current_class" value="{{ old('current_class') }}" placeholder="Contoh: Kelas 3 SD" required>
                                @error('current_class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="alasan_pindah" class="form-label fw-bold">Alasan Pindah <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('reason_transfer') is-invalid @enderror" id="alasan_pindah" name="reason_transfer" rows="4" placeholder="Jelaskan alasan anak pindah ke sekolah kami" required>{{ old('reason_transfer') }}</textarea>
                                @error('reason_transfer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Data Orang Tua -->
                            <h4 class="mb-3 mt-4" style="color: var(--primary-blue); border-bottom: 2px solid var(--secondary-yellow); display: inline-block; padding-bottom: 5px;">Data Orang Tua / Wali</h4>

                            <div class="mb-3">
                                <label for="parent_name" class="form-label fw-bold">Nama Orang Tua / Wali <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('parent_name') is-invalid @enderror" id="parent_name" name="parent_name" value="{{ old('parent_name') }}" required>
                                @error('parent_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_wa" class="form-label fw-bold">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('whatsapp_number') is-invalid @enderror" id="no_wa" name="whatsapp_number" value="{{ old('whatsapp_number') }}" placeholder="08xxxxxxxxxx" required>
                                <div class="form-text">Informasi seleksi akan dikirimkan melalui WhatsApp.</div>
                                @error('whatsapp_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label fw-bold">Alamat Singkat (Kelurahan/Kecamatan)</label>
                                <textarea class="form-control @error('address_short') is-invalid @enderror" id="alamat" name="address_short" rows="3">{{ old('address_short') }}</textarea>
                                @error('address_short')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Dokumen Pendukung -->
                            <h4 class="mb-3 mt-4" style="color: var(--primary-blue); border-bottom: 2px solid var(--secondary-yellow); display: inline-block; padding-bottom: 5px;">Dokumen Pendukung</h4>

                            <div class="mb-3">
                                <label for="rapor" class="form-label fw-bold">File Rapor (PDF/JPG/PNG) <span class="text-muted">(Opsional)</span></label>
                                <input type="file" class="form-control @error('report_card_file') is-invalid @enderror" id="rapor" name="report_card_file" accept=".pdf,.jpg,.jpeg,.png" maxlength="5120">
                                <div class="form-text">Maksimal 5MB. Format: PDF, JPG, atau PNG</div>
                                @error('report_card_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="surat_pindah" class="form-label fw-bold">Surat Pindah dari Sekolah Lama (PDF/JPG/PNG) <span class="text-muted">(Opsional)</span></label>
                                <input type="file" class="form-control @error('transfer_letter_file') is-invalid @enderror" id="surat_pindah" name="transfer_letter_file" accept=".pdf,.jpg,.jpeg,.png" maxlength="5120">
                                <div class="form-text">Maksimal 5MB. Format: PDF, JPG, atau PNG</div>
                                @error('transfer_letter_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 mt-5">
                                <button class="btn btn-primary btn-lg fw-bold" type="submit" style="background-color: var(--primary-blue); border: none;">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pendaftaran Pindahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
