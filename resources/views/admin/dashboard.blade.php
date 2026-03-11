@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-4">

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<style>
    .stat-card {
        border-radius: 12px;
        padding: 1.25rem;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.12) !important;
    }
    .stat-card .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }
    .stat-card .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1;
    }
    .stat-card .stat-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    .stat-card .stat-sub {
        font-size: 0.75rem;
        margin-top: 0.5rem;
    }
    .activity-item {
        padding: 0.6rem 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .activity-item:last-child {
        border-bottom: none;
    }
    .activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .quick-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 10px;
        text-decoration: none;
        color: #333;
        transition: all 0.2s ease;
        border: 1px solid #e8e8e8;
        margin-bottom: 0.5rem;
    }
    .quick-link:hover {
        background: #f0f7ff;
        border-color: #0066cc;
        color: #0066cc;
        transform: translateX(4px);
    }
    .quick-link i {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }
</style>

<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard Admin</h2>
        <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->name }}! Berikut ringkasan data sekolah.</p>
    </div>
    <div class="text-muted">
        <i class="fas fa-calendar me-1"></i> {{ now()->translatedFormat('l, d F Y') }}
    </div>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card card shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label mb-0">Total Siswa</p>
                    <p class="stat-value text-primary">{{ $totalStudents }}</p>
                    <p class="stat-sub text-success mb-0"><i class="fas fa-user-check me-1"></i>{{ $activeStudents }} aktif</p>
                </div>
                <div class="stat-icon" style="background: #e8f4fd; color: #0066cc;">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card card shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label mb-0">Total Berita</p>
                    <p class="stat-value" style="color: #28a745;">{{ $totalNews }}</p>
                    <p class="stat-sub text-muted mb-0"><i class="fas fa-globe me-1"></i>{{ $publishedNews }} dipublikasi</p>
                </div>
                <div class="stat-icon" style="background: #e8f5e9; color: #28a745;">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card card shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label mb-0">Siswa Pindahan</p>
                    <p class="stat-value" style="color: #ff9800;">{{ $totalTransfers }}</p>
                    <p class="stat-sub mb-0" style="color: #ff9800;"><i class="fas fa-clock me-1"></i>{{ $pendingTransfers }} pending</p>
                </div>
                <div class="stat-icon" style="background: #fff3e0; color: #ff9800;">
                    <i class="fas fa-exchange-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card card shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label mb-0">Pesan Kontak</p>
                    <p class="stat-value" style="color: #9c27b0;">{{ $totalMessages }}</p>
                    <p class="stat-sub mb-0" style="color: #e91e63;"><i class="fas fa-envelope me-1"></i>{{ $unreadMessages }} belum dibaca</p>
                </div>
                <div class="stat-icon" style="background: #f3e5f5; color: #9c27b0;">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Column -->
    <div class="col-lg-8">
        <!-- Gender Distribution -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0 pt-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-chart-pie me-2 text-primary"></i>Distribusi Siswa</h6>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: #e3f2fd; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                <i class="fas fa-mars" style="color: #2196F3;"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold">Laki-laki</span>
                                    <span class="fw-bold text-primary">{{ $maleCount }}</span>
                                </div>
                                <div class="progress" style="height: 8px; border-radius: 4px;">
                                    <div class="progress-bar bg-primary" style="width: {{ $totalStudents > 0 ? ($maleCount / $totalStudents * 100) : 0 }}%; border-radius: 4px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: #fce4ec; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                <i class="fas fa-venus" style="color: #E91E63;"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold">Perempuan</span>
                                    <span class="fw-bold" style="color: #E91E63;">{{ $femaleCount }}</span>
                                </div>
                                <div class="progress" style="height: 8px; border-radius: 4px;">
                                    <div class="progress-bar" style="background: #E91E63; width: {{ $totalStudents > 0 ? ($femaleCount / $totalStudents * 100) : 0 }}%; border-radius: 4px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="d-inline-flex align-items-center gap-3">
                            <div class="text-center">
                                <div style="font-size: 2.5rem; font-weight: 800; color: #0066cc;">{{ $totalStudents }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">Total Siswa</div>
                            </div>
                            <div style="width: 1px; height: 50px; background: #e0e0e0;"></div>
                            <div class="text-center">
                                <div style="font-size: 2.5rem; font-weight: 800; color: #28a745;">{{ $graduatedStudents }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">Lulus</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Siswa Terbaru -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-user-plus me-2 text-success"></i>Siswa Terbaru</h6>
                <a href="{{ route('admin.students.index') }}" class="text-decoration-none" style="font-size: 0.85rem;">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="card-body pt-0">
                @forelse($recentStudents as $student)
                    <div class="activity-item">
                        <div class="activity-dot" style="background: {{ $student->jenis_kelamin == 'L' ? '#2196F3' : '#E91E63' }};"></div>
                        <div style="flex: 1;">
                            <div class="fw-bold" style="font-size: 0.9rem;">{{ $student->nama }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">NISN: {{ $student->nisn }} · {{ $student->status ?? 'Aktif' }}</div>
                        </div>
                        <span class="text-muted" style="font-size: 0.7rem;">{{ $student->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">Belum ada data siswa.</p>
                @endforelse
            </div>
        </div>

        <!-- Pesan Kontak Terbaru -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-envelope me-2" style="color: #9c27b0;"></i>Pesan Kontak Terbaru</h6>
                <a href="{{ route('admin.messages.index') }}" class="text-decoration-none" style="font-size: 0.85rem;">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            <div class="card-body pt-0">
                @forelse($recentMessages as $msg)
                    <div class="activity-item">
                        <div class="activity-dot" style="background: {{ $msg->is_read ? '#ccc' : '#e91e63' }};"></div>
                        <div style="flex: 1;">
                            <div class="fw-bold" style="font-size: 0.9rem;">
                                {{ $msg->subject }}
                                @if(!$msg->is_read)
                                    <span class="badge bg-danger ms-1" style="font-size: 0.6rem;">Baru</span>
                                @endif
                            </div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ $msg->name }} · {{ $msg->email }}</div>
                        </div>
                        <span class="text-muted" style="font-size: 0.7rem;">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">Belum ada pesan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-4">
        <!-- Quick Links -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0 pt-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-bolt me-2" style="color: #ff9800;"></i>Menu Cepat</h6>
            </div>
            <div class="card-body pt-0">
                <a href="{{ route('admin.students.index') }}" class="quick-link">
                    <i class="fas fa-users" style="background: #e8f4fd; color: #0066cc;"></i>
                    <span>Kelola Siswa</span>
                </a>
                <a href="{{ route('admin.news.index') }}" class="quick-link">
                    <i class="fas fa-newspaper" style="background: #e8f5e9; color: #28a745;"></i>
                    <span>Kelola Berita</span>
                </a>
                <a href="{{ route('admin.news.create') }}" class="quick-link">
                    <i class="fas fa-plus-circle" style="background: #e8f5e9; color: #28a745;"></i>
                    <span>Buat Berita Baru</span>
                </a>
                <a href="{{ route('admin.transfer-students.index') }}" class="quick-link">
                    <i class="fas fa-exchange-alt" style="background: #fff3e0; color: #ff9800;"></i>
                    <span>Siswa Pindahan</span>
                </a>
                <a href="{{ route('admin.messages.index') }}" class="quick-link">
                    <i class="fas fa-envelope" style="background: #f3e5f5; color: #9c27b0;"></i>
                    <span>Pesan Masuk
                        @if($unreadMessages > 0)
                            <span class="badge bg-danger ms-1">{{ $unreadMessages }}</span>
                        @endif
                    </span>
                </a>
                <a href="{{ route('admin.settings.about') }}" class="quick-link">
                    <i class="fas fa-cog" style="background: #fce4ec; color: #e91e63;"></i>
                    <span>Edit Tentang Kami</span>
                </a>
                <a href="{{ route('admin.settings.contact') }}" class="quick-link">
                    <i class="fas fa-phone-alt" style="background: #e0f2f1; color: #009688;"></i>
                    <span>Edit Info Kontak</span>
                </a>
            </div>
        </div>

        <!-- Berita Terbaru -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-newspaper me-2 text-primary"></i>Berita Terbaru</h6>
                <a href="{{ route('admin.news.index') }}" class="text-decoration-none" style="font-size: 0.85rem;">Semua</a>
            </div>
            <div class="card-body pt-0">
                @forelse($recentNews as $news)
                    <div class="activity-item">
                        <div class="activity-dot" style="background: {{ $news->is_published ? '#28a745' : '#ffc107' }};"></div>
                        <div style="flex: 1;">
                            <div class="fw-bold" style="font-size: 0.85rem;">{{ Str::limit($news->title, 35) }}</div>
                            <div class="text-muted" style="font-size: 0.7rem;">
                                @if($news->is_published)
                                    <span class="text-success"><i class="fas fa-check-circle"></i> Published</span>
                                @else
                                    <span class="text-warning"><i class="fas fa-clock"></i> Draft</span>
                                @endif
                                · {{ $news->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3">Belum ada berita.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

</div>
@endsection
