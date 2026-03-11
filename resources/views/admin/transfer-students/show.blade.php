@extends('layouts.admin')

@section('title', 'Detail Pendaftaran Siswa Pindahan - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Detail Pendaftaran Siswa Pindahan</h1>
            <a href="{{ route('admin.transfer-students.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <!-- Data Siswa -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i> Data Calon Siswa</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Nama Lengkap</p>
                                <p class="fw-bold">{{ $transferStudent->full_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">No. Registrasi</p>
                                <p class="fw-bold">{{ $transferStudent->transfer_number }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Jenis Kelamin</p>
                                <p class="fw-bold">{{ $transferStudent->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Tempat Lahir</p>
                                <p class="fw-bold">{{ $transferStudent->birth_place }}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-1">Tanggal Lahir</p>
                                <p class="fw-bold">{{ $transferStudent->birth_date->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Sekolah Sebelumnya -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-school me-2"></i> Data Sekolah Sebelumnya</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="text-muted mb-1">Nama Sekolah</p>
                            <p class="fw-bold">{{ $transferStudent->previous_school }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-muted mb-1">Kelas Saat Ini</p>
                            <p class="fw-bold">{{ $transferStudent->current_class }}</p>
                        </div>
                        <div class="mb-0">
                            <p class="text-muted mb-1">Alasan Pindah</p>
                            <p class="fw-bold">{{ $transferStudent->reason_transfer }}</p>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-family me-2"></i> Data Orang Tua / Wali</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Nama Orang Tua / Wali</p>
                                <p class="fw-bold">{{ $transferStudent->parent_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">No. WhatsApp</p>
                                <p class="fw-bold">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $transferStudent->whatsapp_number) }}" target="_blank" class="text-success">
                                        {{ $transferStudent->whatsapp_number }}
                                        <i class="fas fa-external-link-alt ms-1"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="mb-0">
                            <p class="text-muted mb-1">Alamat Singkat</p>
                            <p class="fw-bold">{{ $transferStudent->address_short ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Pendukung -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-file-pdf me-2"></i> Dokumen Pendukung</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="text-muted mb-1">File Rapor</p>
                            @if($transferStudent->report_card_file)
                                <a href="{{ asset('storage/' . $transferStudent->report_card_file) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download me-1"></i> Unduh Rapor
                                </a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </div>
                        <div class="mb-0">
                            <p class="text-muted mb-1">Surat Pindah</p>
                            @if($transferStudent->transfer_letter_file)
                                <a href="{{ asset('storage/' . $transferStudent->transfer_letter_file) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fas fa-download me-1"></i> Unduh Surat Pindah
                                </a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Status -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-tasks me-2"></i> Status & Catatan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p class="text-muted mb-2">Status Saat Ini</p>
                            <span class="badge bg-{{ $transferStudent->status_badge }} fs-6">{{ $transferStudent->status_label }}</span>
                        </div>

                        <!-- Form Update Status -->
                        <form method="POST" action="{{ route('admin.transfer-students.updateStatus', $transferStudent) }}" class="mb-4">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Perbarui Status</label>
                                <select name="status" id="status" class="form-select" required>
                                    <option value="pending" {{ $transferStudent->status == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                    <option value="contacted" {{ $transferStudent->status == 'contacted' ? 'selected' : '' }}>Sedang Dihubungi</option>
                                    <option value="verified" {{ $transferStudent->status == 'verified' ? 'selected' : '' }}>Diterima</option>
                                    <option value="rejected" {{ $transferStudent->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="admin_note" class="form-label fw-bold">Catatan Admin</label>
                                <textarea name="admin_note" id="admin_note" class="form-control" rows="4" placeholder="Masukkan catatan...">{{ $transferStudent->admin_note }}</textarea>
                                <div class="form-text">Catatan ini hanya terlihat oleh admin.</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </form>

                        <!-- Timeline -->
                        <div class="mt-4">
                            <p class="text-muted mb-3"><small><i class="fas fa-clock me-2"></i> Waktu Pendaftaran</small></p>
                            <p class="fw-bold">{{ $transferStudent->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
