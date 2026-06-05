@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<section style="background: linear-gradient(135deg, #0a1628 0%, #0d2b5e 100%); color: white; padding: 2rem 0;">
    <div class="container-lg">
        <h1 style="font-size:2rem; font-weight:700; margin:0;"><i class="fas fa-users-cog me-2"></i>Manajemen Pengguna</h1>
        <p style="margin:0.25rem 0 0; opacity:0.8;">Kelola akun admin dan superadmin sistem</p>
    </div>
</section>

<section style="padding:2rem 0; background:#f8f9fa; min-height:80vh;">
    <div class="container-lg">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- Daftar Pengguna --}}
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-list me-2 text-primary"></i>Daftar Pengguna</h5>
                        <span class="badge bg-secondary">{{ $users->count() }} akun</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background:#f8f9fa;">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->isPrimarySuperadmin())
                                            <span class="badge ms-1" style="background: linear-gradient(135deg, #ffd700, #ffaa00); color:#000; font-size:0.65rem;">UTAMA</span>
                                        @endif
                                        @if($user->id === auth()->id())
                                            <span class="badge bg-info ms-1" style="font-size:0.65rem;">Anda</span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ $user->email }}</td>
                                    <td>
                                        @if($user->role === 'superadmin')
                                            <span class="badge bg-dark">Superadmin</span>
                                        @else
                                            <span class="badge bg-primary">Admin</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->id !== auth()->id())
                                        <div class="d-flex gap-1">
                                            {{-- Toggle Aktif --}}
                                            @if(auth()->user()->isPrimarySuperadmin() || $user->role === 'admin')
                                            <form method="POST" action="{{ route('superadmin.users.toggle', $user->id) }}">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-sm {{ $user->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    <i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                </button>
                                            </form>
                                            @endif

                                            {{-- Reset Password --}}
                                            @if(auth()->user()->isPrimarySuperadmin() || $user->role === 'admin')
                                            <button class="btn btn-sm btn-outline-info" title="Reset Password"
                                                    data-bs-toggle="modal" data-bs-target="#resetModal"
                                                    data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                                                <i class="fas fa-key"></i>
                                            </button>
                                            @endif

                                            {{-- Hapus --}}
                                            @if(auth()->user()->isPrimarySuperadmin() || $user->role === 'admin')
                                            <form method="POST" action="{{ route('superadmin.users.destroy', $user->id) }}"
                                                  onsubmit="return confirm('Hapus akun {{ $user->name }}? Tidak bisa dibatalkan.')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                        @else
                                        <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Form Tambah --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-user-plus me-2 text-success"></i>Tambah Akun</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('superadmin.users.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Username</label>
                                <input type="text" name="name" class="form-control" required placeholder="contoh: lt.admin2" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="email@labitech.sch.id" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="Minimal 6 karakter">
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Level</label>
                                <select name="role" class="form-select">
                                    <option value="admin">Admin</option>
                                    @if(auth()->user()->isPrimarySuperadmin())
                                    <option value="superadmin">Superadmin</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-plus me-2"></i>Tambah Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Modal Reset Password --}}
<div class="modal fade" id="resetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-key me-2"></i>Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="resetForm">
                @csrf @method('PATCH')
                <div class="modal-body">
                    <p>Reset password untuk: <strong id="resetUserName"></strong></p>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" required placeholder="Minimal 6 karakter">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('resetModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const userId = btn.getAttribute('data-user-id');
    const userName = btn.getAttribute('data-user-name');
    document.getElementById('resetUserName').textContent = userName;
    document.getElementById('resetForm').action = '/admin/superadmin/users/' + userId + '/reset-password';
});
</script>
@endpush
@endsection
