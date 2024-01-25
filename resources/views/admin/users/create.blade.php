@extends('layouts.admin')
@section('content')
<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->


                    <div class="mb-3">
                        <label for="formrow-firstname-input" class="form-label">Name </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="formrow-firstname-input" placeholder="Enter Name" name="name"
                            value="{{ old('name') }}">
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
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div class="row justify-content-center">
                            <div class="col-lg-12">

                                <div class="input-group bg-light rounded">
                                    <input id="password" type="text" id="demo3_21"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password" placeholder="Enter Password">

                                    <button onClick="randomPassword(10);" class="btn btn-primary" type="button"
                                        id="button-addon2">
                                        <i class="fas fa-undo"></i>
                                    </button>

                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                            name="role" value="{{ old('role') }}">
                            <option value="" selected>-- Select --</option>

                            <option value="admin">Admin</option>
                            <option value="author">Author</option>

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
                                <button type="submit" class="btn btn-sm btn-primary ">Submit</button>

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
