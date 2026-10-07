@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Key Initiatives</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Key Initiatives</li>
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
                        <h4 class="card-title">All Initiatives</h4>
                        @can('key-initiative-create')
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#createInitiativeModal"> <i class="fas fa-plus"></i> Create New</button>
                        @endcan
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image/Icon</th>
                                <th>Heading</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($initiatives as $initiative)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div style="width: 50px; height: 50px;">
                                            {!! $initiative->icon !!}
                                        </div>
                                    </td>
                                    <td>{{ $initiative->heading }}</td>
                                    <td>{{ Str::limit($initiative->description, 50) }}</td>
                                    <td>{{ $initiative->link }}</td>
                                    <td>{{ $initiative->order }}</td>
                                    <td>
                                        @can('key-initiative-edit')
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input active-switch" data-id="{{ $initiative->id }}" {{ $initiative->active ? 'checked' : '' }}>
                                        </div>
                                        @endcan
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('key-initiative-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editInitiativeModal{{ $initiative->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('key-initiative-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('key-initiatives.destroy', $initiative->id) }}" method="POST" class="d-inline">
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

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editInitiativeModal{{ $initiative->id }}" tabindex="-1"
                                    aria-labelledby="editLabel{{ $initiative->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel{{ $initiative->id }}">Edit Initiative</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('key-initiatives.update', $initiative->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Heading</label>
                                                        <input type="text" class="form-control" name="heading" value="{{ old('heading', $initiative->heading) }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" rows="3" required>{{ old('description', $initiative->description) }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Read More Link</label>
                                                        <input type="text" class="form-control" name="link" value="{{ old('link', $initiative->link) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Order</label>
                                                        <input type="number" class="form-control" name="order" value="{{ old('order', $initiative->order) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Image/Icon</label>
                                                        <div class="mb-2" style="width: 50px; height: 50px;">
                                                            {!! $initiative->icon !!}
                                                        </div>
                                                        <label class="form-label">Update SVG Code</label>
                                                        <textarea class="form-control" name="icon" rows="3" required>{{ old('icon', $initiative->icon) }}</textarea>
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" id="active{{ $initiative->id }}" name="active" value="1" {{ $initiative->active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="active{{ $initiative->id }}">Active</label>
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

    <!-- Create Modal -->
    <div class="modal fade" id="createInitiativeModal" tabindex="-1" aria-labelledby="createLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Create Initiative</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('key-initiatives.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Heading <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="heading" value="{{ old('heading') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Read More Link</label>
                            <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image/Icon SVG Code <span class="text-danger">*</span></label>
                             <textarea class="form-control" name="icon" rows="3" required>{{ old('icon') }}</textarea>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="active" name="active" value="1" checked>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Initiative</button>
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
                var id = $(this).data('id');
                var url = '{{ route("key-initiatives.toggle-active", ":id") }}';
                url = url.replace(':id', id);

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: {
                        _token: '{{ csrf_token() }}',
                        active: isActive
                    },
                    success: function(response) {
                        if(response.success) {
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
