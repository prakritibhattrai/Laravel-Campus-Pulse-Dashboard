@extends('layouts.admin')
@section('content')
    <form action="{{ route('teams.update', $team->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <!--Start Row -->
        <div class="row">

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title mb-4">Edit Team</h4> --}}
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Name" name="name"
                                value="{{ $team->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formrow-description-input" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                placeholder="Enter Description">{{ $team->description }}</textarea>

                        </div>
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Position</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror"
                                id="formrow-firstname-input" placeholder="Enter Position" name="position"
                                value="{{ $team->position }}">
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
                                value="{{ $team->order }}">
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
                                    <option value="{{ $type->id }}"
                                        {{ $type->id == $team->team_type ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('team_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formrow-inputState" class="form-label">Status</label>
                            <select id="formrow-inputState" class="form-select" name="status">
                                <option value="inactive" {{ $team->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="active" {{ $team->status == 'active' ? 'selected' : '' }}>Active</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Choose Image <small>(jpg, png, jpeg, gif)</small></label>
                            <input type="file" class="form-control" id="formFileSm" name="image">
                        </div>
                        @if ($team->image)
                            <div class="mb-3">
                                <img class="img-fluid" src="{{ url($team->image) }}" height="100" width="100">
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
        <!-- End Row -->

    </form>
@endsection
