@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Visitors</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Visitors</li>
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
                        <h4 class="card-title">All Visitors</h4>
                        @can('visitor-create')
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createVisitorModal">
                            Add Visitor
                        </button>
                        @endcan
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($item->image)
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" height="50" style="object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M, Y') }}</td>
                                    <td>{{ Str::limit($item->description, 50) ?? '-' }}</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('visitor-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editVisitorModal{{ $item->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('visitor-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('visitors.destroy', $item->id) }}" method="POST" class="d-inline">
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
                                <div class="modal fade" id="editVisitorModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editLabel{{ $item->id }}">Edit Visitor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('visitors.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Visit Date <span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" name="date" value="{{ $item->date }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" rows="4">{{ $item->description }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                        <input type="file" class="form-control" name="image" accept="image/*">
                                                        @if($item->image)
                                                            <div class="mt-2">
                                                                <img src="{{ asset($item->image) }}" alt="Current Image" height="60" style="border-radius: 4px;">
                                                                <small class="text-muted d-block mt-1">Leave empty to keep current image</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Visitor</button>
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
    <div class="modal fade" id="createVisitorModal" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Add Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('visitors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Visit Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" required>
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
                        <button type="submit" class="btn btn-primary">Save Visitor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
