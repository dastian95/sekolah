@extends('layouts.admin')

@section('title', 'Pengaturan Pendaftaran')

@section('content')
<div class="container-lg py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: var(--dark-blue);">
                <i class="fas fa-clipboard-list me-2"></i>Pengaturan Pendaftaran
            </h4>
            <p class="text-muted mb-0 small">Atur buka/tutup, periode, dan kapasitas pendaftaran peserta didik baru</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Form --}}
        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.settings.registration.update') }}">
                @csrf

                {{-- Status Pendaftaran --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold" style="background: var(--dark-blue); color:white;">
                        <i class="fas fa-toggle-on me-2"></i>Status Pendaftaran
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   id="registration_open" name="registration_open" value="1"
                                   {{ ($settings['registration_open'] ?? '1') === '1' ? 'checked' : '' }}
                                   style="width: 3rem; height: 1.5rem;">
                            <label class="form-check-label ms-2 fw-semibold fs-6" for="registration_open">
                                Pendaftaran Dibuka
                            </label>
                        </div>
                        <small class="text-muted mt-1 d-block">
                            Jika dimatikan, halaman pendaftaran akan menampilkan pesan tutup meski periode & kuota masih tersedia.
                        </small>
                    </div>
                </div>

                {{-- Periode --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold" style="background: var(--dark-blue); color:white;">
                        <i class="fas fa-calendar-alt me-2"></i>Periode Pendaftaran
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Opsional — kosongkan jika tidak ada batas waktu. Sistem otomatis tutup di luar periode ini.
                        </p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Buka</label>
                                <input type="datetime-local" class="form-control @error('registration_start_date') is-invalid @enderror"
                                       name="registration_start_date"
                                       value="{{ old('registration_start_date', isset($settings['registration_start_date']) ? \Carbon\Carbon::parse($settings['registration_start_date'])->format('Y-m-d\TH:i') : '') }}">
                                @error('registration_start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Tutup</label>
                                <input type="datetime-local" class="form-control @error('registration_end_date') is-invalid @enderror"
                                       name="registration_end_date"
                                       value="{{ old('registration_end_date', isset($settings['registration_end_date']) ? \Carbon\Carbon::parse($settings['registration_end_date'])->format('Y-m-d\TH:i') : '') }}">
                                @error('registration_end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kapasitas --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold" style="background: var(--dark-blue); color:white;">
                        <i class="fas fa-users me-2"></i>Kuota / Kapasitas
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jumlah Maksimum Pendaftar</label>
                                <input type="number" class="form-control @error('registration_capacity') is-invalid @enderror"
                                       name="registration_capacity" min="1" max="10000"
                                       value="{{ old('registration_capacity', $settings['registration_capacity'] ?? '100') }}">
                                @error('registration_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Pendaftar Saat Ini</label>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fs-4 fw-bold" style="color: var(--primary-blue);">{{ $totalPendaftar }}</span>
                                    <span class="text-muted">/ {{ $settings['registration_capacity'] ?? '100' }} kuota</span>
                                </div>
                                @php
                                    $cap = (int)($settings['registration_capacity'] ?? 100);
                                    $pct = $cap > 0 ? min(100, round($totalPendaftar / $cap * 100)) : 0;
                                    $barClass = $pct >= 90 ? 'bg-danger' : ($pct >= 70 ? 'bg-warning' : 'bg-success');
                                @endphp
                                <div class="progress mt-2" style="height: 8px;">
                                    <div class="progress-bar {{ $barClass }}" style="width: {{ $pct }}%"></div>
                                </div>
                                <small class="text-muted">{{ $pct }}% terisi</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pesan Tutup --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold" style="background: var(--dark-blue); color:white;">
                        <i class="fas fa-comment-slash me-2"></i>Pesan Saat Tutup
                    </div>
                    <div class="card-body">
                        <label class="form-label fw-semibold">Pesan yang ditampilkan kepada calon pendaftar</label>
                        <textarea class="form-control @error('registration_closed_message') is-invalid @enderror"
                                  name="registration_closed_message" rows="3"
                                  placeholder="Pendaftaran peserta didik baru saat ini sedang ditutup...">{{ old('registration_closed_message', $settings['registration_closed_message'] ?? '') }}</textarea>
                        @error('registration_closed_message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Google Form --}}
                <div class="card mb-4">
                    <div class="card-header fw-bold" style="background: var(--dark-blue); color:white;">
                        <i class="fab fa-google me-2"></i>Link Google Form Pendaftaran
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            Tempel URL Google Form pendaftaran. Formulir akan ditampilkan langsung (embedded) di halaman pendaftaran.
                        </p>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Google Form — Siswa Baru</label>
                            <input type="url" class="form-control @error('registration_google_form_baru') is-invalid @enderror"
                                   name="registration_google_form_baru"
                                   value="{{ old('registration_google_form_baru', $settings['registration_google_form_baru'] ?? '') }}"
                                   placeholder="https://docs.google.com/forms/d/e/.../viewform">
                            @error('registration_google_form_baru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Google Form — Siswa Pindahan</label>
                            <input type="url" class="form-control @error('registration_google_form_pindahan') is-invalid @enderror"
                                   name="registration_google_form_pindahan"
                                   value="{{ old('registration_google_form_pindahan', $settings['registration_google_form_pindahan'] ?? '') }}"
                                   placeholder="https://docs.google.com/forms/d/e/.../viewform">
                            @error('registration_google_form_pindahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="alert alert-info py-2 mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Salin URL dari tombol "Kirim" di Google Form, pilih tab <strong>Link</strong>, lalu tempel di sini.
                        </div>
                    </div>
                </div>

                {{-- Toggle Penerimaan Pindahan --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0"><i class="fas fa-exchange-alt me-2 text-info"></i> Penerimaan Siswa Pindahan</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   id="registration_pindahan_open" name="registration_pindahan_open" value="1"
                                   {{ ($settings['registration_pindahan_open'] ?? '1') === '1' ? 'checked' : '' }}
                                   style="width: 3rem; height: 1.5rem;">
                            <label class="form-check-label ms-2 fw-semibold fs-6" for="registration_pindahan_open">
                                Penerimaan Pindahan Dibuka
                            </label>
                        </div>
                        <small class="text-muted d-block mt-2">Jika dimatikan, kartu "Siswa Pindahan" tidak tampil di halaman pendaftaran.</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Simpan Pengaturan
                </button>
            </form>
        </div>

        {{-- Info Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0" style="background: #f0f7ff;">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color: var(--dark-blue);">
                        <i class="fas fa-info-circle me-2"></i>Cara Kerja Sistem
                    </h6>
                    <ul class="list-unstyled small text-muted">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Toggle <strong>Dibuka</strong> = pendaftaran aktif</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Jika toggle <strong>Dimatikan</strong>, pendaftaran tutup meski periode & kuota masih ada</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Jika <strong>di luar periode tanggal</strong>, pendaftaran otomatis tutup</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Jika <strong>kuota penuh</strong>, pendaftaran otomatis tutup</li>
                        <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Periode & kuota opsional — kosongkan jika tidak diperlukan</li>
                    </ul>
                </div>
            </div>

            @php
                $isOpen = \App\Models\SiteSetting::isRegistrationOpen();
            @endphp
            <div class="card mt-3 border-0 {{ $isOpen ? 'bg-success' : 'bg-danger' }} text-white">
                <div class="card-body text-center py-3">
                    <i class="fas {{ $isOpen ? 'fa-door-open' : 'fa-door-closed' }} fa-2x mb-2"></i>
                    <div class="fw-bold fs-6">Status Sekarang</div>
                    <div class="fs-5 fw-bold">{{ $isOpen ? 'PENDAFTARAN DIBUKA' : 'PENDAFTARAN DITUTUP' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
