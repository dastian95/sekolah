@extends('layouts.admin')

@section('title', 'Edit Certificate')

@section('content')
<div class="container-lg py-4" style="max-width: 720px;">

    <div class="mb-4">
        <a href="{{ route('admin.certificates.index') }}" class="text-muted text-decoration-none small">
            <i class="fas fa-arrow-left me-1"></i>Back to Certificates
        </a>
        <h4 class="fw-bold mt-2 mb-0" style="color: var(--dark-blue);">
            <i class="fas fa-edit me-2"></i>Edit Certificate
        </h4>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('admin.certificates.update', $certificate) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Certificate Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $certificate->title) }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Issued By <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="text" name="issued_by" class="form-control @error('issued_by') is-invalid @enderror"
                               value="{{ old('issued_by', $certificate->issued_by) }}">
                        @error('issued_by')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Issue Date <span class="text-muted fw-normal">(optional)</span></label>
                        <input type="date" name="issued_date" class="form-control @error('issued_date') is-invalid @enderror"
                               value="{{ old('issued_date', $certificate->issued_date?->format('Y-m-d')) }}">
                        @error('issued_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description <span class="text-muted fw-normal">(optional)</span></label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="3">{{ old('description', $certificate->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">PDF File <span class="text-muted fw-normal">(optional, max 5 MB)</span></label>
                        @if($certificate->file_path)
                            <div class="mb-2">
                                <a href="{{ asset('storage/'.$certificate->file_path) }}" target="_blank"
                                   class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-file-pdf me-1 text-danger"></i>Current File
                                </a>
                                <small class="text-muted ms-2">Upload to replace.</small>
                            </div>
                        @endif
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf">
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Preview Image <span class="text-muted fw-normal">(optional, max 2 MB)</span></label>
                        @if($certificate->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$certificate->thumbnail) }}" alt="Preview"
                                     style="height: 60px; border-radius: 6px; object-fit: cover;">
                                <small class="text-muted ms-2 d-block">Upload to replace.</small>
                            </div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp">
                        @error('thumbnail')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Display Order</label>
                        <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror"
                               value="{{ old('sort_order', $certificate->sort_order) }}" min="0">
                        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 d-flex align-items-center pt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   id="is_active" name="is_active" value="1"
                                   {{ $certificate->is_active ? 'checked' : '' }}
                                   style="width: 2.5rem; height: 1.25rem;">
                            <label class="form-check-label ms-2 fw-semibold" for="is_active">Active (visible to public)</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                    <a href="{{ route('admin.certificates.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
