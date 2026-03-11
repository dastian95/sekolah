@extends('layouts.admin')

@section('title', 'Import Data Siswa - Admin')

@section('content')
<!-- Page Header -->
<section style="background: linear-gradient(135deg, var(--dark-blue) 0%, #2d5a8c 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <div class="d-flex justify-content-between align-items-center">
            <h1 style="font-size: 2rem; font-weight: 700; margin: 0;">Import Data Siswa dari Excel</h1>
            <a href="{{ route('admin.students.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</section>

<!-- Main Content -->
<section style="padding: 3rem 0; background-color: #f8f9fa; min-height: 80vh;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('errors'))
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-circle me-2"></i> Error Details:</h5>
                        <ul class="mb-0">
                            @foreach(session('errors') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Main Card -->
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-upload me-2"></i> Upload File Excel</h5>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('admin.students.import') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="excel_file" class="form-label fw-bold">Pilih File Excel <span class="text-danger">*</span></label>
                                <input 
                                    type="file" 
                                    class="form-control @error('excel_file') is-invalid @enderror" 
                                    id="excel_file" 
                                    name="excel_file" 
                                    accept=".xlsx,.xls,.csv"
                                    required
                                >
                                <div class="form-text">Format: Excel (.xlsx, .xls) atau CSV. Maksimal 5MB.</div>
                                @error('excel_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-lg fw-bold" type="submit" style="background-color: var(--primary-blue); border: none;">
                                    <i class="fas fa-upload me-2"></i> Upload & Import Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Template Instructions -->
                <div class="card shadow-sm border-0">
                    <div class="card-header" style="background-color: var(--dark-blue); color: white;">
                        <h5 class="mb-0"><i class="fas fa-file-excel me-2"></i> Instruksi & Template</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-download me-2" style="color: var(--primary-blue);"></i>
                                Download Template Excel
                            </h6>
                            <p class="mb-3">Gunakan template di bawah ini sebagai panduan struktur file Excel Anda:</p>
                            <a href="{{ route('admin.students.template') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-download me-2"></i> Download Template Excel
                            </a>
                        </div>

                        <hr>

                        <div>
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-list me-2" style="color: var(--primary-blue);"></i>
                                Struktur Kolom Excel
                            </h6>
                            <p class="text-muted mb-3">File Excel Anda harus memiliki kolom-kolom berikut dalam urutan yang benar:</p>
                            
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead style="background-color: #f8f9fa;">
                                        <tr>
                                            <th>No</th>
                                            <th>Kolom</th>
                                            <th>Contoh Data</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><strong>NISN</strong></td>
                                            <td>0012345678</td>
                                            <td>Nomor Induk Siswa Nasional (10 digit)</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><strong>NIS</strong></td>
                                            <td>001</td>
                                            <td>Nomor Induk Sekolah</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td><strong>Nama</strong></td>
                                            <td>Ahmad Fauzi Rahman</td>
                                            <td>Nama lengkap siswa</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td><strong>Jenis Kelamin</strong></td>
                                            <td>L atau P</td>
                                            <td>L = Laki-laki, P = Perempuan</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td><strong>Username</strong></td>
                                            <td>ahmad123</td>
                                            <td>Username untuk login (unik)</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td><strong>Password</strong></td>
                                            <td>mypassword123</td>
                                            <td>Password default (akan di-hash), kosongkan untuk default</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td><strong>Kelas Awal</strong></td>
                                            <td>1</td>
                                            <td>Kelas saat masuk sekolah</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td><strong>Tahun Masuk</strong></td>
                                            <td>2026</td>
                                            <td>Tahun masuk ke sekolah</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td><strong>Sekolah Asal</strong></td>
                                            <td>TK Az-Zahra</td>
                                            <td>Sekolah asal / TK sebelumnya</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td><strong>Tempat Lahir</strong></td>
                                            <td>Jakarta</td>
                                            <td>Kota tempat lahir</td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td><strong>Tanggal Lahir</strong></td>
                                            <td>01/01/2015</td>
                                            <td>Format: DD/MM/YYYY</td>
                                        </tr>
                                        <tr>
                                            <td>12-14</td>
                                            <td colspan="3">Agama, HP, Email (opsional)</td>
                                        </tr>
                                        <tr>
                                            <td>...</td>
                                            <td colspan="3">... dan seterusnya untuk data orang tua dan alamat</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <div>
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-lightbulb me-2" style="color: var(--primary-blue);"></i>
                                Tips Penting
                            </h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Baris pertama adalah header (judul kolom), tidak akan diimport
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    NISN dan NIS harus unik (tidak boleh duplikat)
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Format tanggal gunakan: DD/MM/YYYY (misal: 15/03/2015)
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Kolom yang kosong akan dianggap NULL di database
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Data yang diimport otomatis mendapat status "verified"
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Username akan di-generate otomatis jika dikosongkan
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
