@extends('layouts.admin')

@section('title', 'Edit Cabang - ' . $branch->name)

@section('content')
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-size:2rem; font-weight:700; margin:0;">Edit Cabang</h1>
                <p style="margin:0.25rem 0 0; opacity:0.9;">{{ $branch->name }}</p>
            </div>
            <div class="d-flex gap-2">
                @if($branch->slug)
                    <a href="{{ route('branch.show', $branch->slug) }}" target="_blank" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-eye me-1"></i> Lihat Halaman
                    </a>
                @endif
                <a href="{{ route('admin.branches.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>

<section style="padding:2rem 0; background:#f8f9fa; min-height:80vh;">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.branches.update', $branch->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    {{-- Info Dasar --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header fw-bold" style="background:var(--dark-blue); color:white;">
                            <i class="fas fa-info-circle me-2"></i>Informasi Dasar
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label fw-bold">Nama Cabang <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $branch->name) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Warna Tema</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="color" name="color" id="colorPicker"
                                               value="{{ old('color', $branch->color ?: '#1a3a5c') }}"
                                               class="form-control form-control-color" style="width:60px; height:42px; cursor:pointer;">
                                        <input type="text" id="colorHex" class="form-control"
                                               value="{{ old('color', $branch->color ?: '#1a3a5c') }}"
                                               placeholder="#1a3a5c" style="font-family:monospace;">
                                    </div>
                                    <small class="text-muted">Warna utama halaman cabang ini</small>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="4"
                                              placeholder="Tuliskan deskripsi singkat tentang cabang ini...">{{ old('description', $branch->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kontak --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header fw-bold" style="background:var(--dark-blue); color:white;">
                            <i class="fas fa-address-card me-2"></i>Informasi Kontak
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-bold">Alamat</label>
                                    <input type="text" name="address" class="form-control"
                                           value="{{ old('address', $branch->address) }}"
                                           placeholder="Contoh: Jl. Merdeka No. 1, Jakarta Selatan">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Telepon / WhatsApp</label>
                                    <input type="text" name="phone" class="form-control"
                                           value="{{ old('phone', $branch->phone) }}"
                                           placeholder="Contoh: +62 812 3456 7890">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ old('email', $branch->email) }}"
                                           placeholder="Contoh: jakarta@labitech.sch.id">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Logo --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header fw-bold" style="background:var(--dark-blue); color:white;">
                            <i class="fas fa-image me-2"></i>Logo Cabang <small style="font-weight:400; opacity:0.8;">(opsional, maks 1MB)</small>
                        </div>
                        <div class="card-body p-4">
                            @if($branch->logo)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $branch->logo) }}" alt="Logo" style="height:80px; border-radius:8px; background:#f0f0f0; padding:0.5rem;">
                                    <p class="small text-muted mt-1 mb-0">Logo saat ini. Upload baru untuk mengganti.</p>
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control" accept="image/png,image/jpeg,image/webp">
                        </div>
                    </div>

                    {{-- Preview Warna --}}
                    <div class="card shadow-sm border-0 mb-4" id="colorPreviewCard">
                        <div class="card-header fw-bold" style="background:var(--dark-blue); color:white;">
                            <i class="fas fa-palette me-2"></i>Preview Tampilan
                        </div>
                        <div class="card-body p-0 overflow-hidden" style="border-radius:0 0 0.375rem 0.375rem;">
                            <div id="colorPreviewBar" style="background:{{ $branch->color ?: '#1a3a5c' }}; padding:2rem; color:white; text-align:center;">
                                <h4 class="fw-bold mb-1">Cabang {{ $branch->name }}</h4>
                                <p class="mb-0" style="opacity:0.85;">Begini tampilan warna di halaman cabang</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mb-4">
                        <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<script>
(function() {
    var picker = document.getElementById('colorPicker');
    var hex    = document.getElementById('colorHex');
    var bar    = document.getElementById('colorPreviewBar');

    function syncColor(val) {
        if (/^#[0-9A-Fa-f]{6}$/.test(val)) {
            picker.value = val;
            hex.value    = val;
            if (bar) bar.style.background = val;
        }
    }

    picker.addEventListener('input', function() { syncColor(this.value); });
    hex.addEventListener('input', function() { syncColor(this.value); });
    // keep hidden input in sync
    picker.addEventListener('change', function() { hex.value = this.value; syncColor(this.value); });
})();
</script>
@endsection
