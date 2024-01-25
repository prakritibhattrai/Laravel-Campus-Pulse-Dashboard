@extends('layouts.admin')
@section('content')
    <form action="{{ route('team-types.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!--Start Row -->
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title mb-4">Create Team Type</h4> --}}

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Name</label>
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
                            <label for="formrow-firstname-input" class="form-label">Slug <small>(Slug will be auto generated
                                    if the field is empty)</small></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Slug" name="slug"
                                value="{{ old('slug') }}">
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="row justify-content-start">
                    <div class="col-sm-9">

                        <div>

                            <button type="reset" class="btn btn-sm btn-danger ">Reset</button>
                            <button type="submit" class="btn btn-sm btn-primary ">Submit</button>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end col -->

        </div>
        <!-- End Row -->

    </form>
@endsection
