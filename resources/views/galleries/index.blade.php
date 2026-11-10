@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Galleries</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Galleries</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title mb-0">All Gallery Items</h4>
                        @can('gallery-create')
                            <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#createGalleryModal">
                                <i class="fas fa-plus me-1"></i> Add Gallery Item
                            </button>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-condensed table-custom w-100 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($gallery->image && file_exists(public_path($gallery->image)))
                                                <a href="{{ asset($gallery->image) }}" target="_blank">
                                                    <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}"
                                                        class="gallery-thumb-sm">
                                                </a>
                                            @else
                                                <span class="badge bg-light text-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $gallery->title }}</td>
                                        <td>
                                            <span class="badge bg-soft-info text-info">{{ $gallery->category ?? 'General' }}</span>
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($gallery->description, 50) }}</td>
                                        <td>{{ $gallery->order }}</td>
                                        <td>
                                            @if ($gallery->active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                @can('gallery-edit')
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Toggle Status">
                                                        <div class="form-check form-switch form-switch-md mb-0">
                                                            <input type="checkbox" class="form-check-input active-switch"
                                                                data-id="{{ $gallery->id }}"
                                                                {{ $gallery->active ? 'checked' : '' }}>
                                                        </div>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <button type="button" class="btn btn-sm btn-soft-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editGalleryModal{{ $gallery->id }}">
                                                            <i class="mdi mdi-pencil-outline"></i>
                                                        </button>
                                                    </li>
                                                @endcan
                                                @can('gallery-delete')
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <form action="{{ route('galleries.destroy', $gallery->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-soft-danger delete-confirm"
                                                                onclick="return confirm('Are you sure you want to delete this gallery item?')">
                                                                <i class="mdi mdi-delete-outline"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </td>
                                    </tr>

                                    <!-- Edit Gallery Modal -->
                                    <div class="modal fade" id="editGalleryModal{{ $gallery->id }}" tabindex="-1"
                                        aria-labelledby="editGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editGalleryModalLabel{{ $gallery->id }}">
                                                        Edit Gallery Item
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('galleries.update', $gallery->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="title{{ $gallery->id }}"
                                                                    class="form-label">Title <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="title{{ $gallery->id }}" name="title"
                                                                    value="{{ old('title', $gallery->title) }}" required>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="category{{ $gallery->id }}" class="form-label">Category</label>
                                                                <select class="form-select" id="category{{ $gallery->id }}" name="category">
                                                                    <option value="Meetings" {{ old('category', $gallery->category) == 'Meetings' ? 'selected' : '' }}>Meetings</option>
                                                                    <option value="Oath Ceremonies" {{ old('category', $gallery->category) == 'Oath Ceremonies' ? 'selected' : '' }}>Oath Ceremonies</option>
                                                                    <option value="Convocations" {{ old('category', $gallery->category) == 'Convocations' ? 'selected' : '' }}>Convocations</option>
                                                                    <option value="Visits" {{ old('category', $gallery->category) == 'Visits' ? 'selected' : '' }}>Visits</option>
                                                                    <option value="Heritage" {{ old('category', $gallery->category) == 'Heritage' ? 'selected' : '' }}>Heritage</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="order{{ $gallery->id }}"
                                                                    class="form-label">Order</label>
                                                                <input type="number" class="form-control"
                                                                    id="order{{ $gallery->id }}" name="order"
                                                                    value="{{ old('order', $gallery->order) }}">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description{{ $gallery->id }}"
                                                                class="form-label">Description</label>
                                                            <textarea class="form-control" id="description{{ $gallery->id }}" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label d-block">Current Image</label>
                                                            @if ($gallery->image && file_exists(public_path($gallery->image)))
                                                                <div class="mb-2">
                                                                    <img src="{{ asset($gallery->image) }}"
                                                                        alt="{{ $gallery->title }}"
                                                                        class="gallery-thumb-preview">
                                                                </div>
                                                            @endif
                                                            <label for="image{{ $gallery->id }}" class="form-label">Update
                                                                Image (Optional)</label>
                                                            <input type="file" class="form-control"
                                                                id="image{{ $gallery->id }}" name="image"
                                                                accept="image/*">
                                                            <small class="text-muted">Allowed types: jpeg, png, jpg, gif, webp (Max: 5MB)</small>
                                                        </div>

                                                        <div class="form-check form-switch mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="active{{ $gallery->id }}" name="active" value="1"
                                                                {{ $gallery->active ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="active{{ $gallery->id }}">Active</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Gallery</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Gallery Modal -->
    <div class="modal fade" id="createGalleryModal" tabindex="-1" aria-labelledby="createGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGalleryModalLabel">Add New Gallery Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="create_title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_title" name="title"
                                    value="{{ old('title') }}" placeholder="Enter title" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="create_category" class="form-label">Category</label>
                                <select class="form-select" id="create_category" name="category">
                                    <option value="Meetings">Meetings</option>
                                    <option value="Oath Ceremonies">Oath Ceremonies</option>
                                    <option value="Convocations">Convocations</option>
                                    <option value="Visits">Visits</option>
                                    <option value="Heritage">Heritage</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="create_order" class="form-label">Order</label>
                                <input type="number" class="form-control" id="create_order" name="order"
                                    value="{{ old('order', 0) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="create_description" class="form-label">Description</label>
                            <textarea class="form-control" id="create_description" name="description" rows="3"
                                placeholder="Enter description (optional)">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="create_image" class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="create_image" name="image" accept="image/*"
                                required>
                            <small class="text-muted">Allowed types: jpeg, png, jpg, gif, webp (Max: 5MB)</small>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="create_active" name="active"
                                value="1" checked>
                            <label class="form-check-label" for="create_active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Gallery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.active-switch').change(function() {
                var isActive = $(this).prop('checked') ? 1 : 0;
                var galleryId = $(this).data('id');
                var url = '{{ route('galleries.toggle-active', ':id') }}';
                url = url.replace(':id', galleryId);

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        active: isActive
                    },
                    success: function(response) {
                        if (response.success) {
                            if (typeof toastr !== 'undefined') {
                                toastr.success(response.message);
                            }
                        }
                    },
                    error: function() {
                        if (typeof toastr !== 'undefined') {
                            toastr.error('Something went wrong. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection

