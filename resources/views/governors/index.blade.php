@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Governors</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Governors and Secretaries</a></li>
                        <li class="breadcrumb-item active">Governors</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">All Governors</h4>
                        @can('governor-create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createGovernorModal">
                            Add Governor
                        </button>
                        @endcan
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($governors as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset($item->image) }}" alt="Image" height="50">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->from)->format('d M, Y') }}</td>
                                    <td>
                                        @if($item->is_present)
                                            <span class="badge bg-success">Present</span>
                                        @else
                                            {{ $item->to ? \Carbon\Carbon::parse($item->to)->format('d M, Y') : '-' }}
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('governor-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editGovernorModal{{ $item->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('governor-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('governors.destroy', $item->id) }}" method="POST" class="d-inline">
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
                                <div class="modal fade" id="editGovernorModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel{{ $item->id }}">Edit Governor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('governors.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Position <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="position" value="{{ $item->position }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5 mb-3">
                                                            <label class="form-label">From Date <span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" name="from" value="{{ $item->from }}" required>
                                                        </div>
                                                        <div class="col-md-5 mb-3">
                                                            <label class="form-label">To Date</label>
                                                            <input type="date" class="form-control" name="to" id="editToDate{{ $item->id }}" value="{{ $item->to }}" {{ $item->is_present ? 'disabled' : 'required' }}>
                                                        </div>
                                                        <div class="col-md-2 mb-3 d-flex align-items-end">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="is_present" id="editIsPresent{{ $item->id }}" value="1" {{ $item->is_present ? 'checked' : '' }} onchange="document.getElementById('editToDate{{ $item->id }}').disabled = this.checked; if(this.checked) document.getElementById('editToDate{{ $item->id }}').value = '';">
                                                                <label class="form-check-label" for="editIsPresent{{ $item->id }}">
                                                                    Present
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="description" rows="4" required>{{ $item->description }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" class="form-control" name="image" accept="image/*">
                                                        <small class="text-muted">Leave empty to keep current image</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Governor</button>
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
    <div class="modal fade" id="createGovernorModal" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Add Governor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('governors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="position" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label">From Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="from" required>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control" name="to" id="createToDate" required>
                            </div>
                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_present" id="createIsPresent" value="1" onchange="document.getElementById('createToDate').disabled = this.checked; if(this.checked) document.getElementById('createToDate').value = '';">
                                    <label class="form-check-label" for="createIsPresent">
                                        Present
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Governor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
