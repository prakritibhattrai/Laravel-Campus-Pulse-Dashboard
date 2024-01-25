@extends('layouts.admin')
@section('content')
    <form action="{{ route('privacy-policies.update', $privacyPolicy->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!--Start Row -->
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{--  <h4 class="card-title mb-4">Privacy Policy</h4>  --}}

                        <div class="mb-3">
                            <label for="formrow-description-input" class="form-label">Content</label>
                            <textarea name="content" id="description" cols="30" rows="5" class="form-control"
                                placeholder="Enter Content">{{ $privacyPolicy->content }}</textarea>
                        </div>
                    </div>
                    <!-- end card body -->
                    <div class="card-footer">
                        <div class="row justify-content-start">
                            <div class="col-sm-9">
                                <div>
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
