@extends('layouts.app')

@section('title', 'Hasil Pencarian untuk "' . e($query) . '"')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Hasil Pencarian untuk: <span class="text-primary">"{{ e($query) }}"</span></h1>
        </div>
    </div>

    <div class="row">
        {{-- Hasil Pencarian Siswa --}}
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i> Hasil Pencarian Siswa ({{ $students->count() }})
                    </h4>
                </div>
                <div class="card-body">
                    @if($students->isEmpty())
                        <p class="text-muted">Tidak ada siswa yang ditemukan.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($students as $student)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $student->nama }}</h6>
                                        <small class="text-muted">NIS: {{ $student->nis ?: '-' }} | NISN: {{ $student->nisn ?: '-' }}</small>
                                    </div>
                                    @if(Auth::guard('admin')->check())
                                        <a href="{{ route('admin.students.show', $student->id_siswa) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        {{-- Hasil Pencarian Berita --}}
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="far fa-newspaper me-2"></i> Hasil Pencarian Berita ({{ $news->count() }})
                    </h4>
                </div>
                <div class="card-body">
                    @if($news->isEmpty())
                        <p class="text-muted">Tidak ada berita yang ditemukan.</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($news as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none">
                                            <h6 class="mb-0">{{ $item->title }}</h6>
                                        </a>
                                        <small class="text-muted">Dipublikasikan pada {{ $item->published_at->format('d M Y') }}</small>
                                    </div>
                                    <a href="{{ route('news.show', $item->slug) }}" class="btn btn-sm btn-outline-secondary">Baca</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="{{ url()->previous() }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
