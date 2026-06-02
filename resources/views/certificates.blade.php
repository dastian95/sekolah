@extends('layouts.app')

@section('title', 'Certificates - Laboratorium Islamic Technology-Labitech')

@section('content')
<!-- Hero -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 5rem 0 3rem;">
    <div class="container-lg">
        <p style="opacity:0.8; margin-bottom:0.5rem; font-size:0.9rem;">
            <a href="{{ route('home') }}" style="color:white; opacity:0.7;">Home</a>
            <i class="fas fa-chevron-right mx-2" style="font-size:0.65rem;"></i>
            <span>Certificates</span>
        </p>
        <h1 style="font-size:2.5rem; font-weight:800; margin:0;">
            <i class="fas fa-certificate me-3" style="opacity:0.8;"></i>Certificates
        </h1>
        <p style="margin-top:0.75rem; font-size:1.05rem; opacity:0.9;">
            Accreditation and achievement certificates of Laboratorium Islamic Technology-Labitech
        </p>
    </div>
</section>

<!-- Content -->
<section style="padding: 3rem 0; background: #f8f9fa; min-height: 60vh;">
    <div class="container-lg">

        @if($certificates->isEmpty())
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center py-5">
                    <i class="fas fa-certificate fa-4x text-muted mb-4" style="opacity:0.3;"></i>
                    <h4 class="fw-bold mb-2">No Certificates Yet</h4>
                    <p class="text-muted">Certificate information will be available soon.</p>
                </div>
            </div>
        @else
            <div class="row g-4">
                @foreach($certificates as $cert)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">

                        {{-- Thumbnail or default banner --}}
                        @if($cert->thumbnail)
                            <img src="{{ asset('storage/'.$cert->thumbnail) }}" alt="{{ $cert->title }}"
                                 style="width: 100%; height: 180px; object-fit: cover;">
                        @else
                            <div style="width:100%; height:180px; background: linear-gradient(135deg, var(--dark-blue), #2d5a8c); display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-certificate fa-4x" style="color: rgba(255,255,255,0.3);"></i>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="fw-bold mb-1" style="color: var(--dark-blue); line-height: 1.3;">{{ $cert->title }}</h5>

                            <div class="d-flex flex-wrap gap-2 mb-2">
                                @if($cert->issued_by)
                                    <span class="badge bg-light text-dark border" style="font-size:0.75rem;">
                                        <i class="fas fa-building me-1 text-muted"></i>{{ $cert->issued_by }}
                                    </span>
                                @endif
                                @if($cert->issued_date)
                                    <span class="badge bg-light text-dark border" style="font-size:0.75rem;">
                                        <i class="fas fa-calendar me-1 text-muted"></i>{{ $cert->issued_date->format('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            @if($cert->description)
                                <p class="text-muted small flex-grow-1 mb-3" style="line-height: 1.6;">{{ $cert->description }}</p>
                            @else
                                <div class="flex-grow-1"></div>
                            @endif

                            @if($cert->file_path)
                                <div class="d-flex gap-2 mt-auto">
                                    <a href="{{ asset('storage/'.$cert->file_path) }}" target="_blank"
                                       class="btn btn-sm btn-primary flex-fill">
                                        <i class="fas fa-eye me-1"></i> View Certificate
                                    </a>
                                    <a href="{{ asset('storage/'.$cert->file_path) }}" download
                                       class="btn btn-sm btn-outline-secondary flex-fill">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>
                            @else
                                <p class="text-muted small mb-0 mt-auto">
                                    <i class="fas fa-info-circle me-1"></i>Document not available yet
                                </p>
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
