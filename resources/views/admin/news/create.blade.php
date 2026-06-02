@extends('layouts.admin')

@section('title', 'Tambah Berita - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Tambah Berita Baru</h1>
                <p style="margin: 0.25rem 0 0; opacity: 0.9;">Buat artikel berita baru untuk sekolah</p>
            </div>
            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ old('title') }}" placeholder="Masukkan judul berita" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>Umum</option>
                                        <option value="akademik" {{ old('category') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="prestasi" {{ old('category') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                        <option value="kegiatan" {{ old('category') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                        <option value="pengumuman" {{ old('category') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="author" class="form-label fw-bold">Penulis <span class="text-danger">*</span></label>
                                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', Auth::user()->name) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="excerpt" class="form-label fw-bold">Ringkasan <small class="text-muted">(opsional)</small></label>
                                <textarea name="excerpt" id="excerpt" class="form-control" rows="2" placeholder="Ringkasan singkat berita...">{{ old('excerpt') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label fw-bold">Isi Berita <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control" rows="12" placeholder="Tulis isi berita di sini..." required>{{ old('content') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="featured_image" class="form-label fw-bold">Gambar Utama <small class="text-muted">(opsional, maks 2MB)</small></label>
                                <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" name="action" value="publish" class="btn btn-success btn-lg">
                                    <i class="fas fa-globe me-2"></i> Publikasikan
                                </button>
                                <button type="submit" name="action" value="draft" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-save me-2"></i> Simpan Draft
                                </button>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-outline-danger btn-lg ms-auto">Batal</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
