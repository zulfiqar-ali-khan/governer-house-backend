@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Sliders</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Sliders</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">All Sliders</h4>
                        @can('slider-create')
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#createSliderModal"> <i class="fas fa-plus"></i> Create New Slider</button>
                        @endcan
                    </div>

                    <table id="datatable"
                        class="table table-bordered table-condensed table-custom  w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Label</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($slider->image) }}" alt="Slider Image" height="50">
                                    </td>
                                    <td>{{ $slider->label }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>{{ $slider->order }}</td>
                                    <td>
                                        @if ($slider->active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('slider-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input active-switch"
                                                        data-id="{{ $slider->id }}"
                                                        {{ $slider->active ? 'checked' : '' }}>
                                                </div>
                                            </li>
                                            @endcan
                                            @can('slider-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSliderModal{{ $slider->id }}" title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('slider-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger delete-confirm"
                                                        title="Delete">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                        </ul>
                                    </td>
                                </tr>

                                <!-- Edit Slider Modal -->
                                <div class="modal fade" id="editSliderModal{{ $slider->id }}" tabindex="-1"
                                    aria-labelledby="editSliderModalLabel{{ $slider->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSliderModalLabel{{ $slider->id }}">Edit
                                                    Slider
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('sliders.update', $slider->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="title{{ $slider->id }}"
                                                            class="form-label">Title</label>
                                                        <input type="text" class="form-control"
                                                            id="title{{ $slider->id }}" name="title"
                                                            value="{{ old('title', $slider->title) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="label{{ $slider->id }}"
                                                            class="form-label">Label</label>
                                                        <input type="text" class="form-control"
                                                            id="label{{ $slider->id }}" name="label"
                                                            value="{{ old('label', $slider->label) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description{{ $slider->id }}"
                                                            class="form-label">Description</label>
                                                        <textarea class="form-control" id="description{{ $slider->id }}" name="description">{{ old('description', $slider->description) }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="order{{ $slider->id }}"
                                                            class="form-label">Order</label>
                                                        <input type="number" class="form-control"
                                                            id="order{{ $slider->id }}" name="order"
                                                            value="{{ old('order', $slider->order) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Image</label>
                                                        <div class="mb-2">
                                                            <img src="{{ asset($slider->image) }}" alt="Slider Image"
                                                                height="100">
                                                        </div>
                                                        <label for="image{{ $slider->id }}" class="form-label">Update
                                                            Image (Optional)</label>
                                                        <input type="file" class="form-control"
                                                            id="image{{ $slider->id }}" name="image"
                                                            accept="image/*">
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="active{{ $slider->id }}" name="active" value="1"
                                                            {{ $slider->active ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="active{{ $slider->id }}">Active</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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

    <!-- Create Slider Modal -->
    <div class="modal fade" id="createSliderModal" tabindex="-1" aria-labelledby="createSliderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSliderModalLabel">Create Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="label" class="form-label">Label</label>
                            <input type="text" class="form-control" id="label" name="label"
                                value="{{ old('label') }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Order</label>
                            <input type="number" class="form-control" id="order" name="order"
                                value="{{ old('order', 0) }}">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                required>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="active" name="active"
                                value="1" checked>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Slider</button>
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
                var sliderId = $(this).data('id');
                var url = '{{ route('sliders.toggle-active', ':id') }}';
                url = url.replace(':id', sliderId);

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        active: isActive
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        }
                    },
                    error: function() {
                        toastr.error('Something went wrong. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
