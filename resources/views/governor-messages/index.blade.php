@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Governor Messages</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Governor Messages</li>
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
                        <h4 class="card-title">All Messages</h4>
                        @can('governor-message-create')
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#createMessageModal"> <i class="fas fa-plus"></i> Create New</button>
                        @endcan
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>From - To Date</th>
                                <th>Active Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($message->image) }}" alt="Image" height="50">
                                    </td>
                                    <td>{{ $message->title }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->designation }}</td>
                                    <td>{{ $message->from ? \Carbon\Carbon::parse($message->from)->format('d M, Y').' - '.$message->to ? \Carbon\Carbon::parse($message->to)->format('d M, Y') : '' : '' }}</td>
                                    <td>
                                        @can('governor-message-edit')
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input active-switch" data-id="{{ $message->id }}" {{ $message->active ? 'checked' : '' }}>
                                        </div>
                                        @endcan
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('governor-message-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editMessageModal{{ $message->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('governor-message-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('governor-messages.destroy', $message->id) }}" method="POST" class="d-inline">
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
                                <div class="modal fade" id="editMessageModal{{ $message->id }}" tabindex="-1"
                                    aria-labelledby="editLabel{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel{{ $message->id }}">Edit Message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('governor-messages.update', $message->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="title" value="{{ old('title', $message->title) }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="name" value="{{ old('name', $message->name) }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Designation <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="designation" value="{{ old('designation', $message->designation) }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">From Date</label>
                                                            <input type="date" class="form-control" name="from" value="{{ old('from', $message->from) }}">
                                                        </div>
                                                         <div class="col-md-6 mb-3">
                                                            <label class="form-label">To Date</label>
                                                            <input type="date" class="form-control" name="to" value="{{ old('to', $message->to) }}">
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="short_description" rows="2" required>{{ old('short_description', $message->short_description) }}</textarea>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Description <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="description" rows="4" required>{{ old('description', $message->description) }}</textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label">Current Image</label>
                                                            <div class="mb-2">
                                                                <img src="{{ asset($message->image) }}" alt="Image" height="100">
                                                            </div>
                                                            <label class="form-label">Update Image (Optional)</label>
                                                            <input type="file" class="form-control" name="image" accept="image/*">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-check form-switch mb-3">
                                                                <input class="form-check-input" type="checkbox" id="active{{ $message->id }}" name="active" value="1" {{ $message->active ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="active{{ $message->id }}">Set as Active (Will deactivate other messages)</label>
                                                            </div>
                                                        </div>
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
    <div class="modal fade" id="createMessageModal" tabindex="-1" aria-labelledby="createLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Create Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('governor-messages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="designation" value="{{ old('designation') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">From Date</label>
                                <input type="date" class="form-control" name="from" value="{{ old('from') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control" name="to" value="{{ old('to') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="short_description" rows="2" required>{{ old('short_description') }}</textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" checked>
                                    <label class="form-check-label" for="active">Set as Active (Will deactivate other messages)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Message</button>
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
                var url = '{{ route("governor-messages.toggle-active", ":id") }}';
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
                            if (isActive) {
                                $('.active-switch').not(this).prop('checked', false);
                            }
                            window.location.href = '{{ route("governor-messages.index") }}';
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
