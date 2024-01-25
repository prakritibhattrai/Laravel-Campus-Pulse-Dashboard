@extends('layouts.admin')
@section('content')

        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
                        <!--Start Row -->
                        <div class="row">

                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                            {{--  <h4 class="card-title mb-4">Create Category</h4>  --}}
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
                                                <label for="formrow-firstname-input" class="form-label">Slug <small> (Slug will be auto generated if the field is empty)</small></label>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="formrow-firstname-input" placeholder="Enter Slug" name="slug" value="{{old('slug')}}">
                                                @error('slug')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Meta Title</label>
                                                <textarea name="meta_title" id="meta_title" cols="30" rows="3" class="form-control" placeholder="Enter Meta Title"></textarea>
                                                @error('meta_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Meta Description</label>
                                                <textarea name="meta_description" id="meta_description" cols="30" rows="5" class="form-control" placeholder="Enter Meta Description"></textarea>
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
                                            <label for="formrow-firstname-input" class="form-label">Order</label>
                                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="formrow-firstname-input" placeholder="Enter Order" min="0" name="order" value="{{ old('order') }}">
                                            @error('order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="formrow-inputState" class="form-label">Parent Category</label>
                                            <select id="formrow-inputState" class="form-select @error('team_type') is-invalid @enderror" name="parent_id">

                                                    <option value="">--Select--</option>
                                                    @foreach($parentCategories as $key => $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>

                                                    @endforeach
                                            </select>
                                            @error('parent_id')
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
