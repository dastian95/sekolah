@extends('layouts.admin')

@section('title', 'Certificates')

@section('content')
<div class="container-lg py-4">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: var(--dark-blue);">
                <i class="fas fa-certificate me-2"></i>Certificates
            </h4>
            <p class="text-muted mb-0 small">Manage school accreditation and achievement certificates</p>
        </div>
        <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Certificate
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($certificates->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-certificate fa-3x mb-3 opacity-25"></i>
                    <p class="mb-0">No certificates added yet.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: var(--dark-blue); color: white;">
                            <tr>
                                <th class="ps-3" style="width: 60px;">Order</th>
                                <th>Title</th>
                                <th>Issued By</th>
                                <th>Date</th>
                                <th>Files</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($certificates as $c)
                            <tr>
                                <td class="ps-3 text-muted">{{ $c->sort_order }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $c->title }}</div>
                                    @if($c->description)
                                        <div class="text-muted small">{{ Str::limit($c->description, 60) }}</div>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $c->issued_by ?? '—' }}</td>
                                <td class="text-muted small">
                                    {{ $c->issued_date ? $c->issued_date->format('d M Y') : '—' }}
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        @if($c->file_path)
                                            <a href="{{ asset('storage/'.$c->file_path) }}" target="_blank"
                                               class="btn btn-sm btn-outline-secondary py-0" style="font-size: 0.75rem;">
                                                <i class="fas fa-file-pdf me-1 text-danger"></i>PDF
                                            </a>
                                        @endif
                                        @if($c->thumbnail)
                                            <a href="{{ asset('storage/'.$c->thumbnail) }}" target="_blank"
                                               class="btn btn-sm btn-outline-secondary py-0" style="font-size: 0.75rem;">
                                                <i class="fas fa-image me-1 text-info"></i>Preview
                                            </a>
                                        @endif
                                        @if(!$c->file_path && !$c->thumbnail)
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.certificates.toggle', $c) }}">
                                        @csrf
                                        <button type="submit"
                                                class="badge border-0 {{ $c->is_active ? 'bg-success' : 'bg-secondary' }}"
                                                style="cursor:pointer; padding: 0.4em 0.7em;">
                                            {{ $c->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.certificates.edit', $c) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.certificates.destroy', $c) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this certificate?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
