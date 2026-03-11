@extends('layouts.admin')

@section('title', 'Edit Tentang Kami - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Edit Halaman Tentang Kami</h1>
                <p style="margin: 0.25rem 0 0; opacity: 0.9;">Ubah konten halaman Tentang Kami</p>
            </div>
            <a href="{{ route('about') }}" class="btn btn-outline-light" target="_blank">
                <i class="fas fa-eye me-2"></i> Lihat Halaman
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.settings.about.update') }}">
                    @csrf

                    {{-- Deskripsi Sekolah --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-school me-2 text-primary"></i> Deskripsi Sekolah</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Paragraf 1</label>
                                <textarea name="about_description_1" class="form-control" rows="3">{{ old('about_description_1', $settings['about_description_1'] ?? 'SDIT Labitech Insan Mulia (Sekolah Dasar Islam Terpadu Labitech Insan Mulia) adalah lembaga pendidikan tingkat sekolah dasar yang berbasis Islam Terpadu. Kami berkomitmen untuk menjadi pusat pembelajaran yang menggabungkan kurikulum nasional dengan nilai-nilai Islam.') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Paragraf 2</label>
                                <textarea name="about_description_2" class="form-control" rows="3">{{ old('about_description_2', $settings['about_description_2'] ?? 'Dengan visi menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global, kami terus berinovasi dalam mengembangkan kurikulum dan metode pembelajaran.') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Paragraf 3</label>
                                <textarea name="about_description_3" class="form-control" rows="3">{{ old('about_description_3', $settings['about_description_3'] ?? 'SDIT Labitech Insan Mulia berlokasi di Kota Bekasi, Jawa Barat dan terus berkomitmen untuk menjangkau lebih banyak peserta didik yang ingin mendapatkan pendidikan berkualitas berbasis Islam.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Visi, Misi, Nilai --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-bullseye me-2 text-primary"></i> Visi, Misi & Nilai</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Visi</label>
                                <textarea name="about_vision" class="form-control" rows="3">{{ old('about_vision', $settings['about_vision'] ?? 'Menjadi sekolah pilihan yang menghasilkan lulusan berkarakter, berprestasi, dan berkompetensi global.') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Misi</label>
                                <textarea name="about_mission" class="form-control" rows="3">{{ old('about_mission', $settings['about_mission'] ?? 'Menyelenggarakan pendidikan berkualitas dengan metode pembelajaran inovatif dan membentuk generasi yang berdisiplin dan bermoral tinggi.') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nilai</label>
                                <textarea name="about_values" class="form-control" rows="3">{{ old('about_values', $settings['about_values'] ?? 'Integritas, Keunggulan, Inovasi, Kerjasama, dan Pengabdian untuk menciptakan lingkungan belajar yang positif.') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Statistik --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-white border-bottom">
                            <h5 class="mb-0"><i class="fas fa-chart-bar me-2 text-primary"></i> Statistik</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Kelas Paralel</label>
                                    <input type="text" name="about_stat_branches" class="form-control" value="{{ old('about_stat_branches', $settings['about_stat_branches'] ?? '6') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Tenaga Pengajar</label>
                                    <input type="text" name="about_stat_teachers" class="form-control" value="{{ old('about_stat_teachers', $settings['about_stat_teachers'] ?? '30+') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Peserta Didik</label>
                                    <input type="text" name="about_stat_students" class="form-control" value="{{ old('about_stat_students', $settings['about_stat_students'] ?? '300+') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-bold">Tahun Pengalaman</label>
                                    <input type="text" name="about_stat_years" class="form-control" value="{{ old('about_stat_years', $settings['about_stat_years'] ?? '10+') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('about') }}" class="btn btn-outline-secondary btn-lg" target="_blank">
                            <i class="fas fa-eye me-2"></i> Preview
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
