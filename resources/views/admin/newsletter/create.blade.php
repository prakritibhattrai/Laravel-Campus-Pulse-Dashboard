@extends('layouts.admin')
@section('content')

         <form action="{{route('publication.store')}}" method="post" enctype="multipart/form-data">
             @csrf
                        <div class="row">

                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title mb-4">Form Grid Layout</h4> -->


                                            <div class="mb-3">
                                                <label for="formrow-firstname-input" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter Title" name="title" value="{{old('title')}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-description-input" class="form-label">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Enter Description"></textarea>

                                            </div>

                                            <div class="mb-3">
                                                <label for="formrow-inputState" class="form-label">Select Category</label>
                                                <select id="formrow-inputState" class="form-select" name="category_id">
                                                    @foreach ($categories as $value)
                                                        <option value="NULL">..Choose..</option>

                                                        <option value="{{$value->id}}">{{$value->title}}</option>
                                                    @endforeach
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
                                            <label for="formFileSm" class="form-label">Choose Image</label>
                                            <input type="file" class="form-control" id="formFileSm" name="image">
                                        </div>

                                                <div class="mb-3">
                                                    <label for="formFileSm" class="form-label">Choose File</label>
                                                    <input type="file" class="form-control" id="formFileSm" name="file">
                                                </div>

                                            <div class="row justify-content-start">
                                                <div class="col-sm-9">

                                                    <div>

                                                        <button type="reset" class="btn btn-sm btn-danger ">Reset</button>
                                                        <button type="submit" class="btn btn-sm btn-primary ">Submit</button>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end row -->

</form>

@endsection
