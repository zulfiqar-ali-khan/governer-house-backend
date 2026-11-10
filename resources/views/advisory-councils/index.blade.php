@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Governor's Advisory Council</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Advisory Council</li>
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
                        <h4 class="card-title mb-0">All Council Members</h4>
                        @can('advisory-council-create')
                            <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="#createAdvisoryModal">
                                <i class="fas fa-plus me-1"></i> Add Council Member
                            </button>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-condensed table-custom w-100 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Label / Sector</th>
                                    <th>Description / Bio</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advisoryCouncils as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($member->image && file_exists(public_path($member->image)))
                                                <img src="{{ asset($member->image) }}" alt="{{ $member->name }}"
                                                    class="advisory-thumb-round">
                                            @else
                                                <div class="advisory-avatar-placeholder">
                                                    <i class="bx bx-user"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $member->name }}</td>
                                        <td>
                                            @if ($member->label)
                                                <span class="badge bg-soft-warning text-warning font-size-12">
                                                    {{ strtoupper($member->label) }}
                                                </span>
                                            @else
                                                <span class="text-muted fst-italic">No Label</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($member->description, 60) }}</td>
                                        <td>{{ $member->order }}</td>
                                        <td>
                                            @can('advisory-council-edit')
                                                <div class="form-check form-switch form-switch-md mb-0">
                                                    <input type="checkbox" class="form-check-input active-switch"
                                                        data-id="{{ $member->id }}"
                                                        {{ $member->active ? 'checked' : '' }}>
                                                </div>
                                            @else
                                                <span class="badge bg-{{ $member->active ? 'success' : 'danger' }}">
                                                    {{ $member->active ? 'Active' : 'Inactive' }}
                                                </span>
                                            @endcan
                                        </td>
                                        <td>
                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                @can('advisory-council-edit')
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <button type="button" class="btn btn-sm btn-soft-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editAdvisoryModal{{ $member->id }}">
                                                            <i class="mdi mdi-pencil-outline"></i>
                                                        </button>
                                                    </li>
                                                @endcan
                                                @can('advisory-council-delete')
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <form action="{{ route('advisory-councils.destroy', $member->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-soft-danger delete-confirm"
                                                                onclick="return confirm('Are you sure you want to delete this council member?')">
                                                                <i class="mdi mdi-delete-outline"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </td>
                                    </tr>

                                    <!-- Edit Advisory Modal -->
                                    <div class="modal fade" id="editAdvisoryModal{{ $member->id }}" tabindex="-1"
                                        aria-labelledby="editAdvisoryModalLabel{{ $member->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editAdvisoryModalLabel{{ $member->id }}">
                                                        Edit Council Member
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('advisory-councils.update', $member->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="name{{ $member->id }}"
                                                                    class="form-label">Member Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    id="name{{ $member->id }}" name="name"
                                                                    value="{{ old('name', $member->name) }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="label{{ $member->id }}"
                                                                    class="form-label">Sector / Domain Label</label>
                                                                <input type="text" class="form-control"
                                                                    id="label{{ $member->id }}" name="label"
                                                                    value="{{ old('label', $member->label) }}"
                                                                    placeholder="e.g. HIGHER EDUCATION, ECONOMY AND TRADE">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description{{ $member->id }}"
                                                                class="form-label">Profile / Description</label>
                                                            <textarea class="form-control" id="description{{ $member->id }}" name="description" rows="3"
                                                                placeholder="Enter short profile...">{{ old('description', $member->description) }}</textarea>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-8 mb-3">
                                                                <label class="form-label d-block">Current Photo</label>
                                                                @if ($member->image && file_exists(public_path($member->image)))
                                                                    <div class="mb-2">
                                                                        <img src="{{ asset($member->image) }}"
                                                                            alt="{{ $member->name }}"
                                                                            class="advisory-thumb-round">
                                                                    </div>
                                                                @endif
                                                                <label for="image{{ $member->id }}" class="form-label">Update
                                                                    Photo (Optional)</label>
                                                                <input type="file" class="form-control"
                                                                    id="image{{ $member->id }}" name="image"
                                                                    accept="image/*">
                                                                <small class="text-muted">Allowed types: jpeg, png, jpg, gif, webp (Max: 5MB)</small>
                                                            </div>
                                                            <div class="col-md-4 mb-3">
                                                                <label for="order{{ $member->id }}"
                                                                    class="form-label">Order</label>
                                                                <input type="number" class="form-control"
                                                                    id="order{{ $member->id }}" name="order"
                                                                    value="{{ old('order', $member->order) }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-check form-switch mb-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="active{{ $member->id }}" name="active" value="1"
                                                                {{ $member->active ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="active{{ $member->id }}">Active</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update Member</button>
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

    <!-- Create Advisory Modal -->
    <div class="modal fade" id="createAdvisoryModal" tabindex="-1" aria-labelledby="createAdvisoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAdvisoryModalLabel">Add New Council Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('advisory-councils.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="create_name" class="form-label">Member Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="create_name" name="name"
                                    value="{{ old('name') }}" placeholder="Enter member name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="create_label" class="form-label">Sector / Domain Label</label>
                                <input type="text" class="form-control" id="create_label" name="label"
                                    value="{{ old('label') }}" placeholder="e.g. HIGHER EDUCATION, ECONOMY AND TRADE">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="create_description" class="form-label">Profile / Description</label>
                            <textarea class="form-control" id="create_description" name="description" rows="3"
                                placeholder="Enter short bio/profile...">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="create_image" class="form-label">Photo (Optional)</label>
                                <input type="file" class="form-control" id="create_image" name="image" accept="image/*">
                                <small class="text-muted">Allowed types: jpeg, png, jpg, gif, webp (Max: 5MB)</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="create_order" class="form-label">Order</label>
                                <input type="number" class="form-control" id="create_order" name="order"
                                    value="{{ old('order', 0) }}">
                            </div>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="create_active" name="active"
                                value="1" checked>
                            <label class="form-check-label" for="create_active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Member</button>
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
                var memberId = $(this).data('id');
                var url = '{{ route('advisory-councils.toggle-active', ':id') }}';
                url = url.replace(':id', memberId);

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

