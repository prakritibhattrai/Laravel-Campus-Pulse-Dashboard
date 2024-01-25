@extends('layouts.admin')
@section('content')
    <form action="{{ route('sliders.update', $slider->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!--Start Row -->
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{--  <h4 class="card-title mb-4">Edit Slider</h4>  --}}
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Name" name="name"
                                value="{{ $slider->name }}">
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
                                value="{{ $slider->link }}">
                            @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-inputState" class="form-label">Status</label>
                            <select id="formrow-inputState" class="form-select" name="status">
                                <option value="inactive" {{ $slider->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="active" {{ $slider->status == 'active' ? 'selected' : '' }}>Active</option>
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
                        @if ($slider->image)
                            <div class="mb-3">
                                <img src="{{ url($slider->image) }}" class="img-responsive" height="100" width="150"
                                    alt="{{ $slider->title }}">
                            </div>
                        @endif

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
        <!-- End Row -->

    </form>
@endsection
