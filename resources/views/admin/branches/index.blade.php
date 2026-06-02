@extends('layouts.admin')

@section('title', 'Kelola Cabang Sekolah')

@section('content')
<div class="container py-4">

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-1"><i class="fas fa-map-marker-alt text-primary me-2"></i>Kelola Cabang Sekolah</h2>
        <p class="text-muted mb-0">Tambah, hapus, atau nonaktifkan cabang yang tampil di halaman utama</p>
    </div>
    <a href="{{ route('home') }}" class="btn btn-outline-primary" target="_blank">
        <i class="fas fa-eye me-1"></i> Lihat Halaman Utama
    </a>
</div>

{{-- Add New Branch --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-bottom">
        <h5 class="mb-0"><i class="fas fa-plus-circle me-2 text-success"></i> Tambah Cabang Baru</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.branches.store') }}" class="row align-items-end g-3">
            @csrf
            <div class="col-md-8">
                <label class="form-label fw-bold">Nama Cabang</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                    placeholder="Contoh: Depok, Tangerang, Bekasi..." value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-plus me-1"></i> Tambah Cabang
                </button>
            </div>
        </form>
        <div class="alert alert-info mt-3 mb-0 py-2">
            <i class="fas fa-info-circle me-1"></i>
            Cabang baru otomatis dalam status <strong>Coming Soon</strong> (nonaktif). Klik tombol <strong>Publikasikan</strong> untuk mengaktifkannya.
        </div>
    </div>
</div>

{{-- Branch List --}}
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list me-2 text-primary"></i> Daftar Cabang ({{ $branches->count() }})</h5>
        <div>
            <span class="badge bg-success me-1">{{ $branches->where('is_active', true)->count() }} Aktif</span>
            <span class="badge bg-secondary">{{ $branches->where('is_active', false)->count() }} Coming Soon</span>
        </div>
    </div>
    <div class="card-body p-0">
        @if($branches->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-building fa-3x text-muted mb-3 d-block"></i>
                <p class="text-muted">Belum ada cabang. Tambahkan cabang pertama di atas.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;" class="text-center">#</th>
                            <th>Nama Cabang</th>
                            <th style="width: 150px;" class="text-center">Status</th>
                            <th style="width: 300px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="branch-list">
                        @foreach($branches as $branch)
                        <tr data-id="{{ $branch->id }}" style="transition: all 0.2s;">
                            <td class="text-center text-muted">
                                <i class="fas fa-grip-vertical" style="cursor: grab;" title="Drag untuk urutkan"></i>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.1rem;
                                        {{ $branch->is_active ? 'background: #e8f5e9; color: #2e7d32;' : 'background: #f5f5f5; color: #9e9e9e;' }}">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $branch->name }}</strong>
                                        @if(!$branch->is_active)
                                            <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem;">Coming Soon</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($branch->is_active)
                                    <span class="badge bg-success px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary px-3 py-2">
                                        <i class="fas fa-clock me-1"></i> Coming Soon
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    {{-- Toggle Status --}}
                                    <form method="POST" action="{{ route('admin.branches.toggle', $branch) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($branch->is_active)
                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Nonaktifkan (Coming Soon)"
                                                onclick="return confirm('Nonaktifkan cabang {{ $branch->name }}? Status akan berubah menjadi Coming Soon.')">
                                                <i class="fas fa-pause-circle me-1"></i> Nonaktifkan
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Publikasikan (Aktifkan)">
                                                <i class="fas fa-check-circle me-1"></i> Publikasikan
                                            </button>
                                        @endif
                                    </form>

                                    {{-- Edit Detail --}}
                                    <a href="{{ route('admin.branches.edit', $branch) }}" class="btn btn-sm btn-outline-primary" title="Edit Detail & Warna">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('admin.branches.destroy', $branch) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Cabang"
                                            onclick="return confirm('Yakin ingin menghapus cabang {{ $branch->name }}? Aksi ini tidak dapat dibatalkan!')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModal{{ $branch->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('admin.branches.update', $branch) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Edit Nama Cabang</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label fw-bold">Nama Cabang</label>
                                            <input type="text" name="name" class="form-control" value="{{ $branch->name }}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

{{-- Legend --}}
<div class="card shadow-sm border-0 mt-4">
    <div class="card-body">
        <h6 class="fw-bold mb-3"><i class="fas fa-question-circle me-1 text-info"></i> Keterangan Status</h6>
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-2 mb-2">
                    <span class="badge bg-success mt-1">Aktif</span>
                    <small class="text-muted">Cabang ditampilkan dan bisa diklik oleh pengunjung di halaman utama.</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-2 mb-2">
                    <span class="badge bg-secondary mt-1" style="white-space: nowrap;">Coming Soon</span>
                    <small class="text-muted">Cabang ditampilkan tapi tidak bisa diklik. Tampil dengan label "Coming Soon".</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-start gap-2 mb-2">
                    <span class="badge bg-danger mt-1">Hapus</span>
                    <small class="text-muted">Cabang dihapus sepenuhnya dari daftar dan tidak tampil di halaman utama.</small>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
