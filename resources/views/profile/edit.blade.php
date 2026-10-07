@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ __('Profile') }}</h4>
            </div>
        </div>
    </div>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row space-y-6">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Profile Information</h2>
                        <p>Update your account's profile information and email address.</p>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input id="name" name="name" type="text" class="form-control"
                                    value="{{ old('name', $user->name) }}" required autofocus />
                                @if ($errors->has('name'))
                                    <div class="text-danger mt-1">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Profile
                                    Image</label>
                                <input id="image" name="image" type="file" class="form-control" accept="image/*" />
                                @if ($errors->has('image'))
                                    <div class="text-danger mt-1">{{ $errors->first('image') }}</div>
                                @endif
                            </div>

                                <div class="col-md-4">
                                    <div class="mt-2">
                                        <img src="{{ $user->image ? asset('images/profile/' . $user->image) : asset('avatar.png') }}" alt="Profile Image"
                                            class="img-thumbnail rounded-2" width="120">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Update Password</h2>
                        <p>Ensure your account is using a long, random password to stay secure.</p>
                        <div class="row">

                            <div class="col-md-4">
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current
                                    Password</label>
                                <input id="current_password" name="current_password" type="password" class="form-control"
                                    autocomplete="current-password" />
                                @if ($errors->has('current_password'))
                                    <div class="text-danger mt-1">{{ $errors->first('current_password') }}</div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New
                                    Password</label>
                                <input id="password" name="password" type="password" class="form-control"
                                    autocomplete="new-password" />
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-1">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700 mb-1">Confirm
                                    Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="form-control" autocomplete="new-password" />
                                @if ($errors->has('password_confirmation'))
                                    <div class="text-danger mt-1">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>

                        </div>



                        <div class="flex items-center gap-4 mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-success">
                                    {{ __('Saved.') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
