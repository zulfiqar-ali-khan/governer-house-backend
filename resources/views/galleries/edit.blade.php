@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Gallery Item</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('galleries.index') }}">Galleries</a></li>
                        <li class="breadcrumb-item active">Edit Gallery Item</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title mb-0">Update Gallery Information</h4>
                        <a href="{{ route('galleries.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $gallery->title) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="order" class="form-label">Display Order</label>
                                <input type="number" class="form-control" id="order" name="order"
                                    value="{{ old('order', $gallery->order) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $gallery->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Current Image</label>
                            @if ($gallery->image && file_exists(public_path($gallery->image)))
                                <div class="mb-2">
                                    <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                                        class="gallery-thumb-preview">
                                </div>
                            @endif
                            <label for="image" class="form-label">Replace Image (Optional)</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="text-muted">Allowed formats: jpeg, png, jpg, gif, webp (Max: 5MB)</small>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="active" name="active" value="1"
                                {{ $gallery->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Active</label>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Gallery Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

