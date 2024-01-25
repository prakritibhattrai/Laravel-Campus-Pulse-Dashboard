@extends('layouts.admin')
@section('content')
    <form action="{{ route('teams.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!--Start Row -->
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title mb-4">Create Team</h4> --}}
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-description-input" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                placeholder="Enter Description"></textarea>

                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Position</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Position" name="position"
                                value="{{ old('position') }}">
                            @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Order" name="order"
                                value="{{ old('order') }}">
                            @error('order')
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
                            <label for="formrow-inputState" class="form-label">Type</label>
                            <select id="formrow-inputState" class="form-select @error('team_type') is-invalid @enderror"
                                name="team_type">

                                <option value="">--Select--</option>
                                @foreach ($types as $key => $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('type')
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

                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Choose Image <small>(jpg, png, jpeg, gif)</small></label>
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
