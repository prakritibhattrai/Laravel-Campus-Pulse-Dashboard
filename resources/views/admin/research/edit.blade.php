@extends('layouts.admin')
@section('content')
    <form action="{{ route('research.update', $detail->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title mb-4">Edit Research</h4> --}}

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Title</label>
                            <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Title" name="title"
                                value="{{ $detail->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-description-input" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5"
                                class="form-control  @error('description') is-invalid @enderror" placeholder="Enter Description">{{ $detail->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-inputState" class="form-label">Select Category</label>
                            <select id="formrow-inputState" class="form-select  @error('category_id') is-invalid @enderror"
                                name="category_id">
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}" {{ $value->id == $detail->id ? 'selected' : '' }}>
                                        {{ $value->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formrow-inputState" class="form-label">Status</label>
                            <select id="formrow-inputState" class="form-select" name="status">
                                <option value="published" {{ $detail->status == 'published' ? 'selected' : '' }}>Published
                                </option>
                                <option value="unpublished" {{ $detail->status == 'unpublished' ? 'selected' : '' }}>Unpublished
                                </option>
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
                            <label for="formFileSm" class="form-label">Choose Image <small>(jpg, jpeg, png, gif)</small></label>
                            <input type="file" class="form-control" id="formFileSm" name="image">
                        </div>
                        @if (File::exists($detail->image))
                            <div class="mb-3">
                                <img src="{{ url($detail->image) }}" alt="" width="150" height="100">
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
        <!-- end row -->

    </form>
@endsection
