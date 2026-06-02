@extends('layouts.admin')

@section('title', 'Kemitraan')

@section('content')
<div class="container-lg py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: var(--dark-blue);">
                <i class="fas fa-handshake me-2"></i>Kemitraan
            </h4>
            <p class="text-muted mb-0 small">Kelola dokumen kemitraan yang ditampilkan di halaman publik</p>
        </div>
        <a href="{{ route('admin.partnerships.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Kemitraan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($partnerships->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-handshake fa-3x mb-3 opacity-25"></i>
                    <p class="mb-0">Belum ada data kemitraan.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: var(--dark-blue); color: white;">
                            <tr>
                                <th class="ps-3" style="width: 60px;">Urutan</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>File PDF</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partnerships as $p)
                            <tr>
                                <td class="ps-3 text-muted">{{ $p->sort_order }}</td>
                                <td class="fw-semibold">{{ $p->title }}</td>
                                <td class="text-muted small" style="max-width: 280px;">
                                    {{ Str::limit($p->description, 80) }}
                                </td>
                                <td>
                                    @if($p->file_path)
                                        <a href="{{ asset('storage/'.$p->file_path) }}" target="_blank"
                                           class="btn btn-sm btn-outline-secondary py-0">
                                            <i class="fas fa-file-pdf me-1 text-danger"></i>Lihat PDF
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.partnerships.toggle', $p) }}">
                                        @csrf
                                        <button type="submit"
                                                class="badge border-0 {{ $p->is_active ? 'bg-success' : 'bg-secondary' }}"
                                                style="cursor:pointer; padding: 0.4em 0.7em;">
                                            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.partnerships.edit', $p) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.partnerships.destroy', $p) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus kemitraan ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
