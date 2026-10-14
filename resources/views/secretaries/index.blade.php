@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Secretaries</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Governors and Secretaries</a></li>
                        <li class="breadcrumb-item active">Secretaries</li>
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
                        <h4 class="card-title">All Secretaries</h4>
                        @can('secretary-create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createSecretaryModal">
                            Add Secretary
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
                                <th>Type</th>
                                <th>Phone</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($secretaries as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($item->image)
                                            <img src="{{ asset($item->image) }}" alt="Image" height="50">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>
                                        @if($item->type == 'Military')
                                            <span class="badge bg-primary">Military</span>
                                        @elseif($item->type == 'Principle')
                                            <span class="badge bg-info">Principle</span>
                                        @elseif($item->type == 'Officer')
                                            <span class="badge bg-warning">Officer</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $item->type }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->phone ?? '-' }}</td>
                                    <td>{{ $item->from ? \Carbon\Carbon::parse($item->from)->format('d M, Y') : '-' }}</td>
                                    <td>
                                        @if($item->is_present)
                                            <span class="badge bg-success">Present</span>
                                        @else
                                            {{ $item->to ? \Carbon\Carbon::parse($item->to)->format('d M, Y') : '-' }}
                                        @endif
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('secretary-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editSecretaryModal{{ $item->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('secretary-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('secretaries.destroy', $item->id) }}" method="POST" class="d-inline">
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
                                <div class="modal fade" id="editSecretaryModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel{{ $item->id }}">Edit Secretary</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('secretaries.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Position</label>
                                                            <input type="text" class="form-control" name="position" value="{{ $item->position }}">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Type <span class="text-danger">*</span></label>
                                                            <select class="form-select" name="type" required>
                                                                <option value="" disabled>Select Type</option>
                                                                <option value="Military" {{ $item->type == 'Military' ? 'selected' : '' }}>Military</option>
                                                                <option value="Principle" {{ $item->type == 'Principle' ? 'selected' : '' }}>Principle</option>
                                                                <option value="Officer" {{ $item->type == 'Officer' ? 'selected' : '' }}>Officer</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Phone</label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $item->phone }}">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Fax</label>
                                                            <input type="text" class="form-control" name="fax" value="{{ $item->fax }}">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Intercom</label>
                                                            <input type="text" class="form-control" name="intercom" value="{{ $item->intercom }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5 mb-3">
                                                            <label class="form-label">From Date</label>
                                                            <input type="date" class="form-control" name="from" value="{{ $item->from }}">
                                                        </div>
                                                        <div class="col-md-5 mb-3">
                                                            <label class="form-label">To Date</label>
                                                            <input type="date" class="form-control" name="to" id="editToDate{{ $item->id }}" value="{{ $item->to }}" {{ $item->is_present ? 'disabled' : '' }}>
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
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" rows="4">{{ $item->description }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" class="form-control" name="image" accept="image/*">
                                                        <small class="text-muted">Leave empty to keep current image</small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Secretary</button>
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
    <div class="modal fade" id="createSecretaryModal" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Add Secretary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('secretaries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Position</label>
                                <input type="text" class="form-control" name="position">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-select" name="type" required>
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="Military">Military</option>
                                    <option value="Principle">Principle</option>
                                    <option value="Officer">Officer</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Fax</label>
                                <input type="text" class="form-control" name="fax">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Intercom</label>
                                <input type="text" class="form-control" name="intercom">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label">From Date</label>
                                <input type="date" class="form-control" name="from">
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control" name="to" id="createToDate">
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
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Secretary</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
