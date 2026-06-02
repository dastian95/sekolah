@extends('layouts.admin')

@section('title', 'Kelola Data Pendaftar - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Kelola Data Pendaftar</h1>
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
                        <a class="nav-link active" href="{{ route('admin.students.index') }}" id="siswa-baru-tab">
                            <i class="fas fa-child me-2"></i> Pendaftar Baru
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('admin.transfer-students.index') }}" id="siswa-pindahan-tab">
                            <i class="fas fa-arrow-right-arrow-left me-2"></i> Pendaftar Pindahan
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
                <div class="row mb-3">
                    <div class="col">
                        <a href="{{ route('admin.students.importForm') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-upload me-2"></i> Import Data Excel
                        </a>
                    </div>
                </div>
                <form method="GET" action="{{ route('admin.students.index') }}" class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, no registrasi, atau NISN..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Baru Daftar</option>
                            <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Tidak Diterima</option>
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

        <!-- Students Table -->
        @if($students->count() > 0)
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: var(--dark-blue); color: white;">
                            <tr>
                                <th>No. Registrasi</th>
                                <th>Nama Pendaftar</th>
                                <th>Jenis Kelamin</th>
                                <th>Nama Orang Tua</th>
                                <th>No. WhatsApp</th>
                                <th>Status</th>
                                <th>Tgl Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td><strong>{{ $student->registration_number ?? '-' }}</strong></td>
                                    <td>{{ $student->nama }}</td>
                                    <td>
                                        @if($student->jenis_kelamin == 'L')
                                            <span class="badge bg-primary"><i class="fas fa-mars me-1"></i>Laki-laki</span>
                                        @elseif($student->jenis_kelamin == 'P')
                                            <span class="badge bg-danger"><i class="fas fa-venus me-1"></i>Perempuan</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $student->nama_ayah ?? '-' }}</td>
                                    <td>
                                        @php $waNumber = $student->nohp_ayah ?? $student->hp; @endphp
                                        @if($waNumber)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waNumber) }}" target="_blank" class="text-success"><i class="fab fa-whatsapp me-1"></i>{{ $waNumber }}</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $student->status_badge }}">{{ $student->status_label }}</span>
                                    </td>
                                    <td><small class="text-muted">{{ $student->created_at?->format('d/m/Y') ?? '-' }}</small></td>
                                    <td>
                                        <!-- Detail Button -->
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $student->id_siswa }}" title="Lihat Detail">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </button>
                                        <!-- Status Update -->
                                        <form method="POST" action="{{ route('admin.students.updateStatus', $student) }}" class="d-inline ms-1">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select form-select-sm d-inline-block" style="width: auto; min-width: 120px;" onchange="this.form.submit()">
                                                <option value="pending" {{ $student->status == 'pending' ? 'selected' : '' }}>Baru Daftar</option>
                                                <option value="contacted" {{ $student->status == 'contacted' ? 'selected' : '' }}>Sedang Diproses</option>
                                                <option value="verified" {{ $student->status == 'verified' ? 'selected' : '' }}>Diterima</option>
                                                <option value="rejected" {{ $student->status == 'rejected' ? 'selected' : '' }}>Tidak Diterima</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Detail Modals (placed OUTSIDE table to avoid broken HTML) --}}
            @foreach($students as $student)
                <div class="modal fade" id="detailModal{{ $student->id_siswa }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white;">
                                <h5 class="modal-title"><i class="fas fa-user-graduate me-2"></i>Detail Pendaftar - {{ $student->nama }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Data Pendaftar -->
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-id-card me-2"></i>Data Pendaftar</h6>
                                        <table class="table table-sm table-borderless">
                                            <tr><td class="text-muted" style="width:40%">No. Registrasi</td><td><strong>{{ $student->registration_number ?? '-' }}</strong></td></tr>
                                            <tr><td class="text-muted">NISN</td><td>{{ $student->nisn ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">NIS</td><td>{{ $student->nis ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">Nama Lengkap</td><td><strong>{{ $student->nama }}</strong></td></tr>
                                            <tr><td class="text-muted">Jenis Kelamin</td><td>{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : ($student->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td></tr>
                                            <tr><td class="text-muted">Tempat Lahir</td><td>{{ $student->tempat_lahir ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">Tanggal Lahir</td><td>{{ $student->tanggal_lahir?->format('d F Y') ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">Sekolah Asal</td><td>{{ $student->sekolah_asal ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">Alamat</td><td>{{ $student->alamat ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">No. HP</td><td>{{ $student->hp ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">Email</td><td>{{ $student->email ?? '-' }}</td></tr>
                                        </table>
                                    </div>
                                    <!-- Data Orang Tua -->
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-users me-2"></i>Data Orang Tua</h6>
                                        <table class="table table-sm table-borderless">
                                            <tr><td colspan="2" class="fw-bold" style="color: var(--dark-blue);"><i class="fas fa-male me-1"></i> Ayah</td></tr>
                                            <tr><td class="text-muted" style="width:40%">Nama</td><td>{{ $student->nama_ayah ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">No. HP</td><td>
                                                @if($student->nohp_ayah)
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $student->nohp_ayah) }}" target="_blank" class="text-success"><i class="fab fa-whatsapp me-1"></i>{{ $student->nohp_ayah }}</a>
                                                @else - @endif
                                            </td></tr>
                                            <tr><td class="text-muted">Pekerjaan</td><td>{{ $student->pekerjaan_ayah ?? '-' }}</td></tr>
                                            <tr><td colspan="2" class="fw-bold pt-3" style="color: var(--dark-blue);"><i class="fas fa-female me-1"></i> Ibu</td></tr>
                                            <tr><td class="text-muted">Nama</td><td>{{ $student->nama_ibu ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">No. HP</td><td>
                                                @if($student->nohp_ibu)
                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $student->nohp_ibu) }}" target="_blank" class="text-success"><i class="fab fa-whatsapp me-1"></i>{{ $student->nohp_ibu }}</a>
                                                @else - @endif
                                            </td></tr>
                                            <tr><td class="text-muted">Pekerjaan</td><td>{{ $student->pekerjaan_ibu ?? '-' }}</td></tr>
                                        </table>
                                        <h6 class="fw-bold text-primary mb-3 mt-3"><i class="fas fa-clipboard-check me-2"></i>Status Pendaftaran</h6>
                                        <table class="table table-sm table-borderless">
                                            <tr><td class="text-muted" style="width:40%">Status</td><td><span class="badge bg-{{ $student->status_badge }}">{{ $student->status_label }}</span></td></tr>
                                            <tr><td class="text-muted">Tgl Daftar</td><td>{{ $student->created_at?->format('d F Y, H:i') ?? '-' }}</td></tr>
                                            <tr><td class="text-muted">Catatan Admin</td><td>{{ $student->admin_note ?? '-' }}</td></tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{ route('admin.students.updateStatus', $student) }}" class="d-flex gap-2 align-items-center flex-wrap">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="admin_note" class="form-control form-control-sm" placeholder="Catatan admin..." value="{{ $student->admin_note }}" style="min-width: 180px; flex: 1;">
                                    <select name="status" class="form-select form-select-sm" style="width: 150px;">
                                        <option value="pending" {{ $student->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                        <option value="contacted" {{ $student->status == 'contacted' ? 'selected' : '' }}>Dihubungi</option>
                                        <option value="verified" {{ $student->status == 'verified' ? 'selected' : '' }}>Diterima</option>
                                        <option value="rejected" {{ $student->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save me-1"></i>Simpan</button>
                                </form>
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $students->links() }}
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-inbox" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                    <p style="color: #999;">Belum ada pendaftaran siswa baru.</p>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
