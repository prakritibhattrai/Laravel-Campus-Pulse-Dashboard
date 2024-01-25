@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('themes.update', $theme?->id) }}" id="theme" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">

                        <div class="d-flex align-self-center">
                            <div class="flex-fill">
                                <p class="card-title-desc">Please do not modify until its necessary &#128515;</p>
                            </div>
                        </div>

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab"
                                    aria-selected="false">
                                    <span class="d-block d-sm-none"><i class="fas fa-tachometer-alt"></i></span>
                                    <span class="d-none d-sm-block"><i class="fas fa-tachometer-alt me-2"></i>General</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#local" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block"><i class="fas fa-home me-2"></i>Styles</span>
                                </a>
                            </li>

                        </ul>

                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="general" role="tabpanel">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="formrow-name-input" class="form-label">Main Logo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <input type="file" name="logo" class="filestyle" data-input="false"
                                                    data-badge="true">
                                            </div>
                                            <div class="mb-3 themeimage_background">
                                                @if (@$theme->logo !== null)
                                                    <img src="{{ url($theme->logo) }}" data-id="{{ $theme->id }}"
                                                        data-name="logo" alt="" class="img-fluid image_background"
                                                        width="70" height="60">
                                                    <div class="icon removeimage" data-name="logo">
                                                        <i class="bx bx-x-circle"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="formrow-name-input" class="form-label">Footer Logo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <input type="file" name="footer_logo" class="filestyle" data-input="false"
                                                    data-badge="true">

                                            </div>
                                            <div class="mb-3 themeimage_background">
                                                @if (@$theme->footer_logo !== null)
                                                    <img src="{{ url($theme->footer_logo) }}" alt=""
                                                        class="img-fluid image_background" width="70"
                                                        data-id="{{ $theme->id }}" data-name="footer_logo">
                                                    <div class="icon removeimage" data-name="footer_logo">
                                                        <i class="bx bx-x-circle"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="formrow-name-input" class="form-label">Favicon</label>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <input type="file" name="favicon" class="filestyle" data-input="false"
                                                    data-badge="true">
                                            </div>
                                            <div class="mb-3 themeimage_background">
                                                @if (@$theme->favicon !== null)
                                                    <img src="{{ url($theme->favicon) }}" alt=""
                                                        class="img-fluid image_background" width="70"
                                                        data-id="{{ $theme->id }}" data-name="favicon">
                                                    <div class="icon removeimage" data-name="favicon">
                                                        <i class="bx bx-x-circle"></i>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="local" role="tabpanel">

                                    <div class="mb-3 row">
                                        <label for="logo_height" class="col-md-2 col-form-label">Logo Height</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="logo_height"
                                                placeholder="Enter Logo Height" id="logo_height"
                                                value="{{ $theme?->logo_height }}" />
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="logo_width" class="col-md-2 col-form-label">Logo Width</label>
                                        <div class="col-md-10">
                                            <input class="form-control" type="text" name="logo_width" id="logo_width"
                                                placeholder="Enter Logo Width" value="{{ $theme?->logo_width }}" />
                                        </div>
                                    </div>

                                </div>

                            </div>

                    </div>
                    <div class="card-footer">
                        <div class="flex-end">
                            <button type="submit" class="btn btn-primary btn-sm btn-right"> <i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
    // Via JavaScript
    $(":file").filestyle({
    input: false,
    iconName: "bx bx-ruble",
    badge:true
    });
@endsection
