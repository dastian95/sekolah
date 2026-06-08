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

                <form method="POST" action="{{ route('admin.settings.homepage.update') }}" enctype="multipart/form-data">
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

                    {{-- Foto Hero Carousel --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-images me-2 text-primary"></i> Foto Slideshow Hero</h5>
                            <span class="badge bg-primary">Maks 5 Foto</span>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3"><i class="fas fa-info-circle me-1"></i> Foto akan tampil bergantian otomatis di homepage. Upload minimal 1 foto. Kosongkan slot yang tidak dipakai.</p>

                            @php
                                $heroSlots = [
                                    'homepage_hero_image'   => 'Foto 1 (Utama)',
                                    'homepage_hero_image_2' => 'Foto 2',
                                    'homepage_hero_image_3' => 'Foto 3',
                                    'homepage_hero_image_4' => 'Foto 4',
                                    'homepage_hero_image_5' => 'Foto 5',
                                ];
                            @endphp

                            <div class="row g-3">
                                @foreach($heroSlots as $key => $label)
                                @php $img = $settings[$key] ?? null; @endphp
                                <div class="col-md-6">
                                    <div class="p-3 rounded border" style="background:#fafafa;">
                                        <p class="fw-bold small mb-2">{{ $label }}</p>
                                        @if($img)
                                            <img src="{{ asset('storage/'.$img) }}" alt="{{ $label }}"
                                                 style="height:110px; width:100%; object-fit:cover; border-radius:8px; margin-bottom:0.5rem;">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="delete_{{ $key }}" id="del_{{ $key }}" value="1">
                                                <label class="form-check-label text-danger small" for="del_{{ $key }}">Hapus foto ini</label>
                                            </div>
                                        @else
                                            <div class="mb-2 text-center text-muted" style="height:80px; background:#f0f0f0; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                        @endif
                                        <input type="file" name="{{ $key }}" class="form-control form-control-sm @error($key) is-invalid @enderror"
                                               accept="image/jpeg,image/png,image/webp">
                                        @error($key)<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <small class="text-muted d-block mt-2">Format: JPG, PNG, WebP. Maks 5MB per foto. Ukuran ideal: 800×500px.</small>

                            <div class="mt-3 row g-3 align-items-center">
                                <div class="col-auto d-flex align-items-center gap-2">
                                    <label class="fw-bold mb-0 text-nowrap">Ganti setiap</label>
                                    <input type="number" name="homepage_hero_interval"
                                           class="form-control form-control-sm" style="width:75px;"
                                           min="1" max="30"
                                           value="{{ old('homepage_hero_interval', $settings['homepage_hero_interval'] ?? 4) }}">
                                    <span class="text-muted">detik</span>
                                </div>
                                <div class="col-auto d-flex align-items-center gap-2">
                                    <label class="fw-bold mb-0 text-nowrap">Animasi</label>
                                    <select name="homepage_hero_animation" class="form-select form-select-sm" style="width:auto;">
                                        @php $anim = $settings['homepage_hero_animation'] ?? 'slide'; @endphp
                                        <option value="slide"      {{ $anim === 'slide'      ? 'selected' : '' }}>Geser (slide)</option>
                                        <option value="fade"       {{ $anim === 'fade'       ? 'selected' : '' }}>Pudar (fade)</option>
                                        <option value="shape-out"  {{ $anim === 'shape-out'  ? 'selected' : '' }}>Shape — lingkaran keluar dari tengah</option>
                                        <option value="shape-in"   {{ $anim === 'shape-in'   ? 'selected' : '' }}>Shape — lingkaran menutup ke tengah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Foto Tentang Kami --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-school me-2 text-success"></i> Foto Tentang Kami</h5>
                        </div>
                        <div class="card-body">
                            @php $aboutImage = $settings['homepage_about_image'] ?? null; @endphp
                            @if($aboutImage)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/'.$aboutImage) }}" alt="Foto Tentang"
                                         style="height:160px; width:auto; border-radius:10px; object-fit:cover; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
                                    <p class="small text-muted mt-1 mb-0">Foto saat ini. Upload baru untuk mengganti.</p>
                                </div>
                            @else
                                <div class="mb-3 p-4 rounded text-center text-muted" style="background:#f8f9fa; border:2px dashed #dee2e6;">
                                    <i class="fas fa-camera fa-2x mb-2 d-block"></i>
                                    Belum ada foto. Jika kosong, bagian ini menampilkan logo sekolah.
                                </div>
                            @endif
                            <input type="file" name="homepage_about_image" class="form-control @error('homepage_about_image') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp">
                            @error('homepage_about_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Foto yang tampil di section Tentang Kami. Format: JPG, PNG, WebP. Maks 2MB.</small>
                        </div>
                    </div>

                    {{-- YouTube --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fab fa-youtube me-2 text-danger"></i> Video YouTube (Section setelah Berita)</h5>
                        </div>
                        <div class="card-body">
                            <label class="form-label fw-bold">URL Video YouTube</label>
                            <input type="url" name="homepage_video_url" class="form-control @error('homepage_video_url') is-invalid @enderror"
                                   value="{{ old('homepage_video_url', $settings['homepage_video_url'] ?? '') }}"
                                   placeholder="https://www.youtube.com/watch?v=XXXXXXXXXXX">
                            @error('homepage_video_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Jika diisi, section YouTube muncul di bawah Berita. Kosongkan untuk menyembunyikan.</small>
                        </div>
                    </div>

                    {{-- Video Profil --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-video me-2 text-primary"></i> Video Profil Sekolah (Section Tentang Kami)</h5>
                        </div>
                        <div class="card-body">
                            @php $videoFile = $settings['homepage_video_file'] ?? null; @endphp
                            @if($videoFile)
                                <div class="mb-3">
                                    <video controls style="width:100%; max-height:200px; border-radius:10px; background:#000;">
                                        <source src="{{ asset('storage/'.$videoFile) }}" type="video/mp4">
                                    </video>
                                    <p class="small text-muted mt-1 mb-0">Video saat ini. Upload baru untuk mengganti.</p>
                                </div>
                            @else
                                <div class="mb-3 p-4 rounded text-center text-muted" style="background:#f8f9fa; border:2px dashed #dee2e6;">
                                    <i class="fas fa-video fa-2x mb-2 d-block"></i>
                                    Belum ada video. Upload untuk menampilkan video profil sekolah.
                                </div>
                            @endif
                            <input type="file" name="homepage_video_file" class="form-control @error('homepage_video_file') is-invalid @enderror"
                                   accept="video/mp4,video/webm,video/ogg">
                            @error('homepage_video_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Format: MP4, WebM, OGG. Maks 100MB. Pindahkan video dari WA ke komputer dulu, lalu upload di sini.</small>
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
