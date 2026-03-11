@extends('layouts.admin')

@section('title', 'Edit Halaman Utama - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Edit Halaman Utama</h1>
                <p style="margin: 0.25rem 0 0; opacity: 0.9;">Ubah banner penerimaan siswa & cabang sekolah</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-light" target="_blank">
                <i class="fas fa-eye me-2"></i> Lihat Halaman
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.settings.homepage.update') }}">
                    @csrf

                    {{-- Banner Penerimaan Siswa Baru --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-bullhorn me-2 text-primary"></i> Banner Penerimaan Siswa Baru</h5>
                        </div>
                        <div class="card-body">
                            <!-- Preview -->
                            <div class="mb-4 p-3 rounded" style="background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%); color: white;">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="background: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fas fa-bullhorn" style="color: #0066cc; font-size: 1.2rem;"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0" style="font-size: 0.85rem; opacity: 0.9;" id="preview-subtitle">{{ $settings['homepage_banner_subtitle'] ?? 'DAFTAR SEKARANG' }}</p>
                                        <p class="mb-0 fw-bold" id="preview-title">{{ $settings['homepage_banner_title'] ?? 'Penerimaan Siswa Baru 2026' }}</p>
                                    </div>
                                </div>
                                <small class="d-block mt-2 opacity-75"><i class="fas fa-eye me-1"></i> Preview banner</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Teks Kecil (Subtitle)</label>
                                <input type="text" name="homepage_banner_subtitle" class="form-control"
                                    value="{{ old('homepage_banner_subtitle', $settings['homepage_banner_subtitle'] ?? 'DAFTAR SEKARANG') }}"
                                    placeholder="Contoh: DAFTAR SEKARANG"
                                    oninput="document.getElementById('preview-subtitle').textContent = this.value">
                                <small class="text-muted">Teks kecil di atas judul banner</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Banner</label>
                                <input type="text" name="homepage_banner_title" class="form-control"
                                    value="{{ old('homepage_banner_title', $settings['homepage_banner_title'] ?? 'Penerimaan Siswa Baru 2026') }}"
                                    placeholder="Contoh: Penerimaan Siswa Baru 2026"
                                    oninput="document.getElementById('preview-title').textContent = this.value">
                                <small class="text-muted">Judul utama yang ditampilkan di banner</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Link Banner <span class="text-muted fw-normal">(opsional)</span></label>
                                <input type="text" name="homepage_banner_link" class="form-control"
                                    value="{{ old('homepage_banner_link', $settings['homepage_banner_link'] ?? '') }}"
                                    placeholder="Contoh: /pendaftaran atau https://example.com/daftar">
                                <small class="text-muted">URL tujuan saat banner diklik. Kosongkan jika tidak perlu link.</small>
                            </div>
                        </div>
                    </div>

                    {{-- Cabang Sekolah --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2 text-success"></i> Cabang Sekolah</h5>
                            <a href="{{ route('admin.branches.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-cog me-1"></i> Kelola Cabang
                            </a>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-0">
                                Kelola cabang sekolah (tambah, hapus, aktifkan, nonaktifkan) melalui halaman <strong>Kelola Cabang</strong>.
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
