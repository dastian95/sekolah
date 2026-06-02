@extends('layouts.admin')

@section('title', 'Edit Kontak - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Edit Informasi Kontak</h1>
                <p style="margin: 0.25rem 0 0; opacity: 0.9;">Ubah informasi kontak yang ditampilkan di halaman Kontak</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-outline-light" target="_blank">
                <i class="fas fa-eye me-2"></i> Lihat Halaman
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.settings.contact.update') }}">
                    @csrf

                    {{-- Kontak Utama --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-address-book me-2 text-primary"></i> Informasi Kontak</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-envelope me-1 text-muted"></i> Email</label>
                                <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? 'labitechunggulbermutu@gmail.com') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-phone me-1 text-muted"></i> Nomor Telepon</label>
                                <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings['contact_phone'] ?? '+62 816262619') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-map-marker-alt me-1 text-muted"></i> Alamat</label>
                                <textarea name="contact_address" class="form-control" rows="3">{{ old('contact_address', $settings['contact_address'] ?? 'Jl. Kutilang No.3, RT.001/RW.003, Jatimakmur, Kec. Pd. Gede, Kota Bks, Jawa Barat') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Sekolah --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-school me-2 text-primary"></i> Informasi Sekolah</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Sekolah</label>
                                <input type="text" name="contact_school_name" class="form-control" value="{{ old('contact_school_name', $settings['contact_school_name'] ?? 'Laboratorium Islamic Technology-Labitech') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenjang Pendidikan</label>
                                <input type="text" name="contact_school_level" class="form-control" value="{{ old('contact_school_level', $settings['contact_school_level'] ?? 'SD (Sekolah Dasar)') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Motto</label>
                                <input type="text" name="contact_motto" class="form-control" value="{{ old('contact_motto', $settings['contact_motto'] ?? 'Iman - Ilmu - Amal') }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-lg" target="_blank">
                            <i class="fas fa-eye me-2"></i> Preview
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
