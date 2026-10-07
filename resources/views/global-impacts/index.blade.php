@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Our Global Impact</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Our Global Impact</li>
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
                        <h4 class="card-title">All Impacts</h4>
                        @can('global-impact-create')
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#createImpactModal"> <i class="fas fa-plus"></i> Create New Impact</button>
                        @endcan
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Heading (Number/Stat)</th>
                                <th>Description (Label)</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($impacts as $impact)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $impact->heading }}</td>
                                    <td>{{ $impact->description }}</td>
                                    <td>{{ $impact->order }}</td>
                                    <td>
                                        @can('global-impact-edit')
                                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                            <input type="checkbox" class="form-check-input active-switch" data-id="{{ $impact->id }}" {{ $impact->active ? 'checked' : '' }}>
                                        </div>
                                        @endcan
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('global-impact-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit"
                                                data-bs-original-title="Edit">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editImpactModal{{ $impact->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('global-impact-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('global-impacts.destroy', $impact->id) }}" method="POST" class="d-inline">
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

                                <!-- Edit Impact Modal -->
                                <div class="modal fade" id="editImpactModal{{ $impact->id }}" tabindex="-1"
                                    aria-labelledby="editImpactModalLabel{{ $impact->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editImpactModalLabel{{ $impact->id }}">Edit Impact</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('global-impacts.update', $impact->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="heading{{ $impact->id }}" class="form-label">Heading (e.g. 150+)</label>
                                                        <input type="text" class="form-control" id="heading{{ $impact->id }}" name="heading" value="{{ old('heading', $impact->heading) }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="description{{ $impact->id }}" class="form-label">Description (e.g. Countries Reached)</label>
                                                        <input type="text" class="form-control" id="description{{ $impact->id }}" name="description" value="{{ old('description', $impact->description) }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="order{{ $impact->id }}" class="form-label">Order</label>
                                                        <input type="number" class="form-control" id="order{{ $impact->id }}" name="order" value="{{ old('order', $impact->order) }}">
                                                    </div>
                                                    <div class="form-check form-switch mb-3">
                                                        <input class="form-check-input" type="checkbox" id="active{{ $impact->id }}" name="active" value="1" {{ $impact->active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="active{{ $impact->id }}">Active</label>
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

    <!-- Create Impact Modal -->
    <div class="modal fade" id="createImpactModal" tabindex="-1" aria-labelledby="createImpactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createImpactModalLabel">Create Impact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('global-impacts.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading (e.g. 150+)</label>
                            <input type="text" class="form-control" id="heading" name="heading" value="{{ old('heading') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (e.g. Countries Reached)</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Order</label>
                            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="active" name="active" value="1" checked>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Impact</button>
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
                var impactId = $(this).data('id');
                var url = '{{ route("global-impacts.toggle-active", ":id") }}';
                url = url.replace(':id', impactId);

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
