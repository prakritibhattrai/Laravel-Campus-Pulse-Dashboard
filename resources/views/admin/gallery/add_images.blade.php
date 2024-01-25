@section('style')
@endsection
@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ $gallery->title }}</h4>
                    <form action="{{ route('gallery.postimages') }}" method="post" id="my_form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}" class="form-control">

                        <input type="hidden" name="photos" value="" class="form-control"
                            placeholder="No File Choosen" id="images_input">

                        <!-- Button trigger modal -->
                        <div class="mb-3">

                            <div class="row ml-10">

                                <button type="button" class="btn btn-light waves-effect col-lg-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" id="images"
                                    style="border-radius:2px;border:1px solid #cccbcb!important; box-shadow:#cccbcb;">
                                    Browse
                                </button>
                                <button type="button" class="btn btn-outline-light hoverbtn col-lg-10"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal" id="images"
                                    style="border:1px solid #dcdbdb!important; border-radius:0;">
                                    <b style="font-weight:500; font-size:14px;">Choose File</b>
                                </button>
                            </div>

                        </div>
                        <div id="preview" class="mb-3">


                        </div>

                        <div class="row justify-content-start">
                            <div class="col-sm-9 mb-3">

                                <div>
                                    <button type="reset" class="btn btn-sm btn-danger ">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary ">Submit</button>
                                </div>
                            </div>
                        </div>


                    </form>



                    <!-- Modal -->

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header" style="background:#f2f3f8;">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-home" type="button" role="tab"
                                                aria-controls="nav-home" aria-selected="true">SELECT IMAGE</button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-profile" type="button" role="tab"
                                                aria-controls="nav-profile" aria-selected="false">UPLOAD IMAGE</button>
                                        </div>
                                    </nav>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                            <div id="image">

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                            <form action="/admin/gallery/storeimages/{{ $gallery->id }}" method="post"
                                                class="dropzone" enctype="multipart/form-data">
                                                @csrf

                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                            aria-labelledby="nav-contact-tab">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="background:#f2f3f8;">
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-bs-dismiss="modal">CLOSE</button>
                                    <button type="button" class="btn btn-primary btn-sm" id="image_send"
                                        data-bs-dismiss="modal">ADD FILES</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <form action="/admin/gallery/storeimages/{{$gallery->id}}" method="post" enctype="multipart/form-data">
            @csrf

                <div class="input-group">
                <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
            </div>
            <img id="holder" style="margin-top:15px;max-height:100px;">
        </form> --}}
    {{-- <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe> --}}
@endsection
