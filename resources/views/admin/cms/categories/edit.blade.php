@extends('layouts.admin')
@section('content')
         <form action="{{route('categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
             @csrf
             @method('put')
             <!--Start Row -->
                        <div class="row">

                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                            {{--  <h4 class="card-title mb-4">Edit Category</h4>  --}}
                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="formrow-firstname-input" placeholder="Enter Name" name="name" value="{{ $category->name }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Slug (Slug will be auto generated if the field is empty)</label>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="formrow-firstname-input" placeholder="Enter Slug" name="slug" value="{{ $category->slug }}">
                                                @error('slug')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Meta Title</label>
                                                <textarea name="meta_title" id="meta_title" cols="30" rows="3" class="form-control" placeholder="Enter Meta Title">{{ $category->meta_title }}</textarea>
                                                @error('meta_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Meta Description</label>
                                                <textarea name="meta_description" id="meta_description" cols="30" rows="5" class="form-control" placeholder="Enter Meta Description">{{ $category->meta_description }}</textarea>
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
                                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="formrow-firstname-input" placeholder="Enter Order" min="0" name="order" value="{{ $category->order }}">
                                            @error('order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="formrow-inputState" class="form-label">Parent Category</label>
                                            <select id="formrow-inputState" class="form-select @error('parent_id') is-invalid @enderror" name="parent_id">

                                                    <option value="">--Select--</option>
                                                    @foreach($parentCategories as $key => $parentCategory)
                                                        <option value="{{ $parentCategory->id }}" {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>{{$parentCategory->name}}</option>
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
                                                <option value="inactive" {{ $category->status == 'inactive' ? 'selected': '' }}>Inactive</option>
                                                <option value="active" {{ $category->status == 'active' ? 'selected': '' }}>Active</option>
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
