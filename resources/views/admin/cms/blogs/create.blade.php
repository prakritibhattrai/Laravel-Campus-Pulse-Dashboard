@extends('layouts.admin')
@section('content')
        <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                        <!--Start Row -->
                        <div class="row">

                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                            {{--  <h4 class="card-title mb-4">Create Blog</h4>  --}}
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="formrow-firstname-input" placeholder="Enter Name" name="name" value="{{old('name')}}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Slug</label>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="formrow-firstname-input" placeholder="Enter Slug" name="slug" value="{{old('slug')}}">
                                                @error('slug')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-description-input" class="form-label">Summary</label>
                                                <textarea name="summary" id="summary" cols="30" rows="2" class="form-control" placeholder="Enter Summary"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-description-input" class="form-label">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Enter Description"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Meta Title</label>
                                                <textarea name="meta_title" id="meta_title" cols="30" rows="2" class="form-control" placeholder="Enter Meta Title"></textarea>
                                                @error('meta_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Meta Description</label>
                                                <textarea name="meta_description" id="meta_description" cols="30" rows="3" class="form-control" placeholder="Enter Meta Description"></textarea>
                                                @error('meta_description')
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
                                            <label for="formrow-inputState" class="form-label">Category</label>
                                            <select id="formrow-inputState" class="form-select @error('category_id') is-invalid @enderror" name="category_id">

                                                    <option value="">--Select--</option>
                                                    @foreach($categories as $key => $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="formrow-inputState" class="form-label">Select Tag</label>
                                            <div class="bs-example">
                                                <input type="text" name="tags" data-role="tagsinput" id="tags" class="form-control"
                                                    placeholder="Enter tags">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formrow-inputState" class="form-label">Status</label>
                                            <select id="formrow-inputState" class="form-select" name="status">
                                                    <option value="inactive">Inactive</option>
                                                    <option value="active">Active</option>
                                            </select>
                                        </div>

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
