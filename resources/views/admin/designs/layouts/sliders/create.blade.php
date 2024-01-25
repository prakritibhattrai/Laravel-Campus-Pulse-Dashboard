@extends('layouts.admin')
@section('content')
    <form action="{{ route('sliders.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!--Start Row -->
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{--  <h4 class="card-title mb-4">Create Slider</h4>  --}}
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
                            <label for="formrow-firstname-input" class="form-label">Link</label>
                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Link" name="link"
                                value="{{ old('link') }}">
                            @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-inputState" class="form-label">Status</label>
                            <select id="formrow-inputState" class="form-select" name="status">
                                <option value="inactive">Inactive</option>
                                <option value="active">Active</option>
                            </select>
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
                            <label for="formFileSm" class="form-label">Choose Image <small> (jpg, png, jpeg, gif) </small></label>
                            <input type="file" class="form-control" id="formFileSm" name="image">
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
        <!-- End Row -->

    </form>
@endsection
