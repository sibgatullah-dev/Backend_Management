@extends('admin')
@section('content')

<div class="d-flex justify-content-between mb-3">
    <div class="col-lg-4 mb-3">
        <div class="card rounded shadow-md">
            <div class="card-header bg-primary text-white text-center">
                <h3>Edit Profile</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('update.profile') }}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="form-label">E-mail</label>
                        <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h3>Update Password</h3>
            </div>
            <div class="card-body">
                @if(session('pass_update'))
                    <div class="alert alert-success">{{ session('pass_update') }}</div>
                @endif
                <form action="{{ route('update.password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')
                            <strong  class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if(session('wrong'))
                            <strong class="text-danger">{{ session('wrong') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="form-label">New Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <strong  class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                            <strong  class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h3>Update Profile Picture</h3>
            </div>
            <div class="card-body">
                @if(session('picture_update'))
                    <div class="alert alert-success">{{ session('picture_update') }}</div>
                @endif
                <form action="{{ route('update.picture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Picture</label>
                        <input type="file" name="picture" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="my-5">
                        <img src="{{ asset('uploads/user') }}/{{ Auth::user()->picture }}" id="blah" alt="" width="100">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Update Picture</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
