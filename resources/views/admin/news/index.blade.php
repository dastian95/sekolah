@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Kelola Berita</h1>
                <p style="margin: 0.25rem 0 0; opacity: 0.9;">Tambah, edit, dan hapus berita sekolah</p>
            </div>
            <a href="{{ route('admin.news.create') }}" class="btn btn-warning" style="font-weight: 600;">
                <i class="fas fa-plus me-2"></i> Tambah Berita
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter & Search -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.news.index') }}" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul berita..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Dipublikasi</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- News Table -->
        @if($news->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: var(--dark-blue); color: white;">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 80px;">Foto</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="width: 180px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $index => $item)
                                <tr>
                                    <td>{{ $news->firstItem() + $index }}</td>
                                    <td>
                                        @if($item->featured_image)
                                            <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">
                                        @else
                                            <div style="width: 60px; height: 45px; background: #e9ecef; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="max-width: 300px;">
                                            <strong>{{ Str::limit($item->title, 50) }}</strong>
                                            @if($item->excerpt)
                                                <br><small class="text-muted">{{ Str::limit($item->excerpt, 60) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td><span class="badge bg-info text-dark">{{ $item->category }}</span></td>
                                    <td>{{ $item->author }}</td>
                                    <td>
                                        @if($item->is_published)
                                            <span class="badge bg-success"><i class="fas fa-check me-1"></i> Dipublikasi</span>
                                        @else
                                            <span class="badge bg-secondary"><i class="fas fa-pencil me-1"></i> Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('news.show', $item) }}" class="btn btn-sm btn-outline-primary" target="_blank" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $news->withQueryString()->links() }}
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-newspaper" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <h5 class="text-muted">Belum ada berita</h5>
                    <p class="text-muted mb-3">Mulai tambahkan berita pertama Anda</p>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Tambah Berita Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
