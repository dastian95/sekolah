@extends('layouts.app')

@section('title', 'Kemitraan - Laboratorium Islamic Technology-Labitech')

@section('content')
<!-- Hero -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 5rem 0 3rem;">
    <div class="container-lg">
        <p style="opacity:0.8; margin-bottom:0.5rem; font-size:0.9rem;">
            <a href="{{ route('home') }}" style="color:white; opacity:0.7;">Beranda</a>
            <i class="fas fa-chevron-right mx-2" style="font-size:0.65rem;"></i>
            <span>Kemitraan</span>
        </p>
        <h1 style="font-size:2.5rem; font-weight:800; margin:0;">
            <i class="fas fa-handshake me-3" style="opacity:0.8;"></i>Kemitraan
        </h1>
        <p style="margin-top:0.75rem; font-size:1.05rem; opacity:0.9;">
            Dokumen kerja sama dan kemitraan Laboratorium Islamic Technology-Labitech
        </p>
    </div>
</section>

<!-- Content -->
<section style="padding: 3rem 0; background: #f8f9fa; min-height: 60vh;">
    <div class="container-lg">

        @if($partnerships->isEmpty())
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center py-5">
                    <i class="fas fa-handshake fa-4x text-muted mb-4" style="opacity:0.3;"></i>
                    <h4 class="fw-bold mb-2">Belum Ada Data Kemitraan</h4>
                    <p class="text-muted">Informasi kemitraan akan segera tersedia.</p>
                </div>
            </div>
        @else
            <div class="row g-4">
                @foreach($partnerships as $p)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="mb-3">
                                <div style="width: 48px; height: 48px; border-radius: 10px; background: var(--primary-blue); display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-handshake text-white fs-5"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-2" style="color: var(--dark-blue); line-height: 1.3;">{{ $p->title }}</h5>
                            @if($p->description)
                                <p class="text-muted small flex-grow-1 mb-3" style="line-height: 1.6;">{{ $p->description }}</p>
                            @else
                                <div class="flex-grow-1"></div>
                            @endif
                            @if($p->file_path)
                                <div class="d-flex gap-2 mt-auto">
                                    <a href="{{ asset('storage/'.$p->file_path) }}" target="_blank"
                                       class="btn btn-sm btn-primary flex-fill">
                                        <i class="fas fa-eye me-1"></i> Lihat PDF
                                    </a>
                                    <a href="{{ asset('storage/'.$p->file_path) }}" download
                                       class="btn btn-sm btn-outline-secondary flex-fill">
                                        <i class="fas fa-download me-1"></i> Unduh
                                    </a>
                                </div>
                            @else
                                <p class="text-muted small mb-0 mt-auto"><i class="fas fa-info-circle me-1"></i>Dokumen belum tersedia</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endsection
