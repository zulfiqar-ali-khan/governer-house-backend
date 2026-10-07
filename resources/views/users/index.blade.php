@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Users</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Access Management</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                        <h4 class="card-title">All Users</h4>
                        @can('user-create')
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#createUserModal"> <i class="fas fa-plus"></i> Create New User</button>
                        @endcan
                    </div>

                    <table id="datatable" class="table table-bordered table-condensed table-custom dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            @if($user->user_type !='admin')
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge bg-secondary">{{ ucfirst($user->user_type) }}</span></td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-info">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('user-edit')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="View"
                                                data-bs-original-title="View">
                                                <button type="button" class="btn btn-sm btn-soft-warning"
                                                    data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>
                                            </li>
                                            @endcan
                                            @can('user-delete')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete"
                                                data-bs-original-title="Delete">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
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
                                @endif

                                <!-- Edit User Modal -->
                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="name{{ $user->id }}"
                                                            class="form-label">Name</label>
                                                        <input type="text" class="form-control"
                                                            id="name{{ $user->id }}" name="name" required
                                                            value="{{ old('name', $user->name) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email{{ $user->id }}"
                                                            class="form-label">Email</label>
                                                        <input type="email" class="form-control"
                                                            id="email{{ $user->id }}" name="email" required
                                                            value="{{ old('email', $user->email) }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="user_type{{ $user->id }}" class="form-label">User
                                                            Type</label>
                                                        <select class="form-control" id="user_type{{ $user->id }}"
                                                            name="user_type" required>
                                                            <option value="admin"
                                                                {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin
                                                            </option>
                                                            <option value="manager"
                                                                {{ $user->user_type == 'manager' ? 'selected' : '' }}>
                                                                Manager</option>
                                                            <option value="staff"
                                                                {{ $user->user_type == 'staff' ? 'selected' : '' }}>Staff
                                                            </option>
                                                            <option value="employees"
                                                                {{ $user->user_type == 'employees' ? 'selected' : '' }}>
                                                                Employees</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password{{ $user->id }}"
                                                            class="form-label">Password</label>
                                                        <input type="password" class="form-control"
                                                            id="password{{ $user->id }}" name="password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="roles{{ $user->id }}"
                                                            class="form-label">Roles</label>
                                                        <select class="form-control select2 select2-multiple"
                                                            multiple="multiple" name="roles[]"
                                                            data-placeholder="Choose roles...">
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}"
                                                                    {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>
                                                                    {{ $role->name }}</option>
                                                            @endforeach
                                                        </select>
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

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="roles" class="form-label d-block">Roles</label>
                            <select class="form-select "  name="roles[]" data-placeholder="Choose roles...">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                dropdownParent: $('#createUserModal')
            });

            // Initialize select2 for dynamically loaded modals
            $('[id^=editUserModal]').on('shown.bs.modal', function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(this)
                });
            });
        });
    </script>
@endsection
