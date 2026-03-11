@extends('layouts.admin')

@section('title', 'Kelola Pendaftaran Siswa Pindahan - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Kelola Pendaftaran Siswa Pindahan</h1>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">
        <!-- Header with Tabs -->
        <div class="row mb-4">
            <div class="col">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.students.index') }}" id="siswa-baru-tab">
                            <i class="fas fa-child me-2"></i> Siswa Baru
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="{{ route('admin.transfer-students.index') }}" id="siswa-pindahan-tab">
                            <i class="fas fa-arrow-right-arrow-left me-2"></i> Siswa Pindahan
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter & Search -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.transfer-students.index') }}" class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau no registrasi..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Sedang Dihubungi</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
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

        <!-- Transfer Students Table -->
        @if($transferStudents->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: var(--dark-blue); color: white;">
                            <tr>
                                <th>No. Registrasi</th>
                                <th>Nama Siswa</th>
                                <th>Sekolah Asal</th>
                                <th>Kelas</th>
                                <th>No. WhatsApp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transferStudents as $student)
                                <tr>
                                    <td><strong>{{ $student->transfer_number }}</strong></td>
                                    <td>{{ $student->full_name }}</td>
                                    <td>{{ $student->previous_school }}</td>
                                    <td>{{ $student->current_class }}</td>
                                    <td><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $student->whatsapp_number) }}" target="_blank" class="text-success">{{ $student->whatsapp_number }}</a></td>
                                    <td>
                                        <span class="badge bg-{{ $student->status_badge }}">{{ $student->status_label }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.transfer-students.show', $student) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </a>
                                        <form method="POST" action="{{ route('admin.transfer-students.updateStatus', $student) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                                <option value="pending" {{ $student->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                                <option value="contacted" {{ $student->status == 'contacted' ? 'selected' : '' }}>Dihubungi</option>
                                                <option value="verified" {{ $student->status == 'verified' ? 'selected' : '' }}>Diterima</option>
                                                <option value="rejected" {{ $student->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $transferStudents->links() }}
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <p style="color: #999;">Belum ada pendaftaran siswa pindahan.</p>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
