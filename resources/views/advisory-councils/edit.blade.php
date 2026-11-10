@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Edit Council Member</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('advisory-councils.index') }}">Advisory Council</a></li>
                        <li class="breadcrumb-item active">Edit Member</li>
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
                        <h4 class="card-title mb-0">Update Member Information</h4>
                        <a href="{{ route('advisory-councils.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Back to List
                        </a>
                    </div>

                    <form action="{{ route('advisory-councils.update', $advisoryCouncil->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Member Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $advisoryCouncil->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="label" class="form-label">Sector / Domain Label</label>
                                <input type="text" class="form-control" id="label" name="label"
                                    value="{{ old('label', $advisoryCouncil->label) }}"
                                    placeholder="e.g. HIGHER EDUCATION, ECONOMY AND TRADE">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Profile / Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Enter short bio/profile...">{{ old('description', $advisoryCouncil->description) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label d-block">Current Photo</label>
                                @if ($advisoryCouncil->image && file_exists(public_path($advisoryCouncil->image)))
                                    <div class="mb-2">
                                        <img src="{{ asset($advisoryCouncil->image) }}"
                                            alt="{{ $advisoryCouncil->name }}"
                                            class="advisory-thumb-round">
                                    </div>
                                @endif
                                <label for="image" class="form-label">Update Photo (Optional)</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Allowed types: jpeg, png, jpg, gif, webp (Max: 5MB)</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="order" class="form-label">Order</label>
                                <input type="number" class="form-control" id="order" name="order"
                                    value="{{ old('order', $advisoryCouncil->order) }}">
                            </div>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="active" name="active" value="1"
                                {{ $advisoryCouncil->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Active</label>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('advisory-councils.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

