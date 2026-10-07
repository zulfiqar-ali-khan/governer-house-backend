@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Contact Us Messages</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">General</a></li>
                        <li class="breadcrumb-item active">Contact Us Messages</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class="card-title">All Messages</h4>
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ Str::limit($message->description, 50) }}</td>
                                    <td>{{ $message->created_at->format('d M, Y h:i A') }}</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View"
                                                data-bs-original-title="View">
                                                <button type="button" class="btn btn-sm btn-soft-info"
                                                    data-bs-toggle="modal" data-bs-target="#viewMessageModal{{ $message->id }}"
                                                    title="View">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </button>
                                            </li>
                                            @can('contact-us-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('contact-us.destroy', $message->id) }}" method="POST" class="d-inline">
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

                                <!-- View Modal -->
                                <div class="modal fade" id="viewMessageModal{{ $message->id }}" tabindex="-1"
                                    aria-labelledby="viewLabel{{ $message->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewLabel{{ $message->id }}">Message Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <strong>Name:</strong>
                                                    <p>{{ $message->name }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Email:</strong>
                                                    <p><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Subject:</strong>
                                                    <p>{{ $message->subject }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Date:</strong>
                                                    <p>{{ $message->created_at->format('d M, Y h:i A') }}</p>
                                                </div>
                                                <div class="mb-3">
                                                    <strong>Message:</strong>
                                                    <p style="white-space: pre-wrap;">{{ $message->description }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
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
@endsection
