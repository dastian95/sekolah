@extends('layouts.admin')

@section('title', 'Detail Pesan - ' . $message->subject)

@section('content')
<div class="container py-4">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Detail Pesan</h2>
        <p class="text-muted mb-0">Dari: {{ $message->name }}</p>
    </div>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0 pt-3">
                <h5 class="fw-bold mb-0">{{ $message->subject }}</h5>
            </div>
            <div class="card-body">
                <div class="p-3" style="background: #f8f9fa; border-radius: 10px; line-height: 1.8;">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>
            <div class="card-footer bg-white border-0 d-flex justify-content-between">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-reply me-1"></i> Balas via Email
                </a>
                @if($message->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank" class="btn btn-success btn-sm">
                        <i class="fab fa-whatsapp me-1"></i> Balas via WhatsApp
                    </a>
                @endif
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 pt-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-info-circle me-2"></i>Info Pengirim</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted" style="font-size: 0.8rem;">Nama</label>
                    <p class="fw-bold mb-0">{{ $message->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted" style="font-size: 0.8rem;">Email</label>
                    <p class="fw-bold mb-0">
                        <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                    </p>
                </div>
                @if($message->phone)
                <div class="mb-3">
                    <label class="text-muted" style="font-size: 0.8rem;">No. Telepon</label>
                    <p class="fw-bold mb-0">{{ $message->phone }}</p>
                </div>
                @endif
                <div class="mb-3">
                    <label class="text-muted" style="font-size: 0.8rem;">Dikirim</label>
                    <p class="fw-bold mb-0">{{ $message->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <label class="text-muted" style="font-size: 0.8rem;">Status</label>
                    <p class="mb-0">
                        @if($message->is_read)
                            <span class="badge bg-success"><i class="fas fa-check me-1"></i>Sudah Dibaca</span>
                        @else
                            <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Belum Dibaca</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
