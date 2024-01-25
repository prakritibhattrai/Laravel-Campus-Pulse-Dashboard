@extends('layouts.admin')
@section('content')
    <form action="{{ route('team-types.update', $type->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!--Start Row -->
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title mb-4">Edit Team Type</h4> --}}

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Name" name="name"
                                value="{{ $type->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Slug<small class="font-size-8"> (Slug
                                    will be auto generated if the field is empty)</small></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Slug" name="slug"
                                value="{{ $type->slug }}">
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
                            <button type="submit" class="btn btn-sm btn-primary ">Update</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- End Row -->

    </form>
@endsection
