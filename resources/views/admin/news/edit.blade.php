@extends('layouts.admin')

@section('title', 'Edit Berita - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Edit Berita</h1>
                <p style="margin: 0.25rem 0 0; opacity: 0.9;">{{ $news->title }}</p>
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

                        <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ old('title', $news->title) }}" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="general" {{ old('category', $news->category) == 'general' ? 'selected' : '' }}>Umum</option>
                                        <option value="akademik" {{ old('category', $news->category) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="prestasi" {{ old('category', $news->category) == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                        <option value="kegiatan" {{ old('category', $news->category) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                        <option value="pengumuman" {{ old('category', $news->category) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="author" class="form-label fw-bold">Penulis <span class="text-danger">*</span></label>
                                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $news->author) }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="excerpt" class="form-label fw-bold">Ringkasan <small class="text-muted">(opsional)</small></label>
                                <textarea name="excerpt" id="excerpt" class="form-control" rows="2">{{ old('excerpt', $news->excerpt) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label fw-bold">Isi Berita <span class="text-danger">*</span></label>
                                <textarea name="content" id="content" class="form-control" rows="12" required>{{ old('content', $news->content) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="featured_image" class="form-label fw-bold">Gambar Utama <small class="text-muted">(opsional, maks 2MB)</small></label>
                                @if($news->featured_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $news->featured_image) }}" alt="Current image" style="max-height: 150px; border-radius: 8px;">
                                        <br><small class="text-muted">Gambar saat ini. Upload baru untuk mengganti.</small>
                                    </div>
                                @endif
                                <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_published" id="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_published">Dipublikasikan</label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-lg">Batal</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
