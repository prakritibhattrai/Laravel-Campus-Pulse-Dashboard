@extends('layouts.admin')
@section('content')
    <form action="{{ route('research-categories.update', $detail->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title mb-4">Edit Research Category</h4> --}}

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Title" name="title"
                                value="{{ $detail->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Slug <small>(Slug will be auto generated if the
                                field is empty)</small></label>
                            <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter Slug"
                                name="slug" value="{{ $detail->slug }}">
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
@endsection
