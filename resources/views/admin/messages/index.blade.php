@extends('layouts.admin')

@section('title', 'Pesan Kontak')

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
        <h2 class="fw-bold mb-1">Pesan Kontak</h2>
        <p class="text-muted mb-0">Pesan masuk dari halaman kontak website.</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Dashboard
    </a>
</div>

<!-- Filter & Search -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-2">
        <form method="GET" class="row align-items-center g-2">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama, email, atau subjek..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100"><i class="fas fa-search me-1"></i> Cari</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Messages Table -->
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background: #f8f9fa;">
                <tr>
                    <th style="width: 30px;"></th>
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr style="{{ !$msg->is_read ? 'background: #f0f7ff; font-weight: 600;' : '' }}">
                        <td>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger" style="width: 8px; height: 8px; padding: 0; border-radius: 50; display: inline-block;"></span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size: 0.9rem;">{{ $msg->name }}</div>
                            <div class="text-muted" style="font-size: 0.75rem; font-weight: 400;">{{ $msg->email }}</div>
                        </td>
                        <td style="font-size: 0.9rem;">{{ $msg->subject }}</td>
                        <td style="font-size: 0.85rem; font-weight: 400;">{{ Str::limit($msg->message, 50) }}</td>
                        <td style="font-size: 0.8rem; color: #6c757d; font-weight: 400;">{{ $msg->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-sm btn-outline-primary" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                            Belum ada pesan masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
        <div class="card-footer bg-white border-0">
            {{ $messages->withQueryString()->links() }}
        </div>
    @endif
</div>

</div>
@endsection
