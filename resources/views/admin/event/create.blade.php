@extends('layouts.admin')
@section('content')
    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title mb-4">Create Event</h4> --}}

                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Title" name="title"
                                value="{{ old('title') }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter Slug"
                                name="slug" value="{{ old('slug') }}">
                        </div>

                        <div class="mb-3">
                            <label for="formrow-description-input" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description"></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Venue</label>
                            <input type="text" class="form-control @error('veneu') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Venue" name="veneu"
                                value="{{ old('veneu') }}">
                            @error('veneu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="formrow-firstname-input"
                                placeholder="Enter Meta Title" name="meta_title" value="{{ old('meta_titles') }}">
                        </div>
                        <div class="mb-3">
                            <label for="formrow-description-input" class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="description" cols="30" rows="5" class="form-control"
                                placeholder="Enter Description"></textarea>

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
                            <label for="formrow-firstname-input" class="form-label">Fee</label>
                            <input type="text" class="form-control @error('fee') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Fee" name="fee"
                                value="{{ old('fee') }}">
                            @error('fee')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Organizer</label>
                            <input type="text" class="form-control @error('organizer') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Organizer" name="organizer"
                                value="{{ old('organizer') }}">
                            @error('organizer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="example-date-input" class="col-md-12 col-form-label">Start Date</label>
                                <input class="form-control @error('start_date') is-invalid @enderror" type="date"
                                    value="2019-08-19" id="example-date-input" name="start_date">
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="example-date-input" class="col-md-12 col-form-label">End Date</label>
                                <input class="form-control @error('end_date') is-invalid @enderror" type="date"
                                    value="2019-08-19" id="example-date-input" name="end_date">
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="example-time-input" class="col-form-label">Start From</label>
                                <input class="form-control @error('start_time') is-invalid @enderror" type="time"
                                    value="13:45:00" id="example-time-input" name="start_time">
                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="example-time-input" class="col-form-label">End At</label>
                                <input class="form-control @error('end_time') is-invalid @enderror" type="time"
                                    value="13:45:00" id="example-time-input" name="end_time">
                                @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formrow-inputState" class="form-label">Status</label>
                            <select id="formrow-inputState" class="form-select" name="status">
                                <option value="unpublished">Unpublished</option>
                                <option value="published">published</option>
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
        <!-- end row -->

    </form>
@endsection
