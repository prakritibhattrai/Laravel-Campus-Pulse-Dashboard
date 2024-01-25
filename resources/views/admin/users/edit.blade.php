@extends('layouts.admin')
@section('content')
<form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->

                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Name </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="formrow-firstname-input" placeholder="Enter Name" name="name"
                            value="{{ $user->name }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="formrow-email-input" class="form-label">Email </label>
                        <input type="email" width="90" class="form-control @error('email') is-invalid @enderror"
                            id="formrow-email-input" placeholder="Enter Email" name="email"
                            value="{{ $user->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                    <div class="mb-3">
                        <label for="formrow-inputState" class="form-label">Role</label>
                        <select id="formrow-inputState"
                            class="select2 form-control select2-multiple @error('role') is-invalid @enderror"
                            name="role" value="{{ $user->role }}">

                            <option value="admin" {{ $user->role == 'admin'?'selected':'' }}>Admin</option>
                            <option value="author" {{ $user->role == 'author'?'selected':'' }}>Author</option>

                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <!-- end card body -->
                <div class="card-footer">
                    <div class="row justify-content-start">
                        <div class="col-sm-9">

                            <div>

                                <button type="reset" class="btn btn-sm btn-danger ">Reset</button>
                                <button type="submit" class="btn btn-sm btn-primary ">Update</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

    </div>
    <!-- end row -->

</form>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-check-all me-2"></i>
                        Great, {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('password.email') }}" class="form-horizontal" method="POST">
                    @csrf
                    <div class="mb-3">

                        <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $user->email }}" required autocomplete="email" autofocus
                            id="useremail" placeholder="Enter email">
                        <label for="formrow-inputState" class="form-label">Reset Password</label>
                        <select id="formrow-inputState" class="form-select" name="verification"
                            value="{{ old('role') }}">
                            <option value="yes">Yes</option>
                        </select>

                    </div>

                    <div class="text-end">
                        <button class="btn btn-sm btn-primary w-md waves-effect waves-light"
                            type="submit">{{ __('Send Password Reset Link') }}</button>
                    </div>

                </form>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>

@endsection
<script>
    function randomPassword(length) {
        var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        password.value = pass;
    }
</script>
