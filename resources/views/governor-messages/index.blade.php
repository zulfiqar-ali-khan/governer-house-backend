@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Governor Messages & Profile Management</h4>
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="card-title mb-1">All Governor Messages</h4>
                            <p class="text-muted font-size-13 mb-0">Manage Governor homepage messages and comprehensive biographical profiles.</p>
                        </div>
                        @can('governor-message-create')
                        <a href="{{ route('governor-messages.create') }}" class="btn btn-success waves-effect waves-light">
                            <i class="fas fa-plus me-1"></i> Create Message & Profile
                        </a>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Portrait</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Tenure (From - To)</th>
                                    <th>Active Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($message->image) }}" alt="Governor Photo" class="rounded border" height="50" width="45" style="object-fit: cover;">
                                        </td>
                                        <td>
                                            <strong>{{ $message->title }}</strong>
                                        </td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->designation }}</td>
                                        <td>
                                            @if($message->from)
                                                {{ \Carbon\Carbon::parse($message->from)->format('d M, Y') }}
                                                @if($message->to)
                                                    – {{ \Carbon\Carbon::parse($message->to)->format('d M, Y') }}
                                                @else
                                                    – Present
                                                @endif
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('governor-message-edit')
                                            <div class="form-check form-switch form-switch-md mb-0" dir="ltr">
                                                <input type="checkbox" class="form-check-input active-switch" data-id="{{ $message->id }}" {{ $message->active ? 'checked' : '' }}>
                                                <label class="form-check-label font-size-12 ms-1 text-muted">{{ $message->active ? 'Active' : 'Inactive' }}</label>
                                            </div>
                                            @else
                                            <span class="badge {{ $message->active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $message->active ? 'Active' : 'Inactive' }}
                                            </span>
                                            @endcan
                                        </td>
                                        <td>
                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View Public Profile" data-bs-original-title="View Public Profile">
                                                    <a href="{{ route('governor-profile') }}" target="_blank" class="btn btn-sm btn-soft-info" title="View Profile on Website">
                                                        <i class="mdi mdi-eye-outline"></i>
                                                    </a>
                                                </li>
                                                @can('governor-message-edit')
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit Profile" data-bs-original-title="Edit Profile">
                                                    <a href="{{ route('governor-messages.edit', $message->id) }}" class="btn btn-sm btn-soft-warning" title="Edit Message & Profile">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('governor-message-delete')
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                                                    <form action="{{ route('governor-messages.destroy', $message->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-soft-danger delete-confirm" title="Delete">
                                                            <i class="mdi mdi-delete-outline"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                @endcan
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
