@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">
                            {{-- Publication List --}}
                        </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('publications.create') }}"
                                        class="btn btn-primary btn-sm waves-effect waves-light" style="color:white;">
                                        Add Publication</a>
                                </li>
                            </ol>
                        </div>

                    </div>

                    <!---- SEARCH -->
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <div class="row">

                            <div class="mb-sm-0">
                                <form action="{{ route('publications') }}" method="get">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="formrow-inputState" class="form-label">Show</label>

                                        </div>
                                        <div class="col-lg-8">
                                            <select id="formrow-inputState" class="form-select form-select-sm"
                                                name="show" onchange="this.form.submit()">
                                                <option value="10" {{ @$show == '10' ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ @$show == '25' ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ @$show == '50' ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ @$show == '100' ? 'selected' : '' }}>100</option>
                                                <option value="500" {{ @$show == '500' ? 'selected' : '' }}>500</option>
                                            </select>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                        @if (isset($_GET['query']))
                            @php
                                $search = htmlentities($_GET['query']);
                            @endphp
                        @else
                            {{ $search = '' }}
                        @endif
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <!-- App Search-->
                                <form action="{{ route('publications') }}" method="get">

                                    <div class="search">
                                        <input type="text" name="query" class="form-control form-control-sm"
                                            placeholder="Search..." id="search" value="{{ $search }}">
                                    </div>
                                </form>
                            </ol>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0" id="myTable">

                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle">S.N</th>
                                    <th class="align-middle">Image</th>
                                    <th class="align-middle">Title</th>
                                    <th class="align-middle">Category</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if($data->count() > 0)
                                    @foreach ($data as $key => $value)
                                        <tr>

                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td>
                                                @if (File::exists($value->image))
                                                    <img src="{{ url($value->image) }}" alt="" class="img-thumbnail"
                                                        width="50px" height="50px">
                                                @else
                                                    <img class="avatar-sm" src="{{ asset('assets/img/default.jpg') }}"
                                                        style="object-fit: contain;" />
                                                @endif

                                            </td>
                                            <td>
                                                {{ $value->title }}
                                            </td>
                                            <td>
                                                {{ @$value->publicationCategory->title }}
                                            </td>

                                            <td>
                                                <form action="{{ route('publications.destroy', $value->id) }}" method="POST">
                                                    <a href="{{ route('publications.edit', $value->id) }}"
                                                        class="btn btn-primary btn-sm waves-effect waves-light">Edit</a>

                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm waves-effect waves-light"
                                                        onclick="return confirm('Are you sure you want to delete?')">
                                                        Delete
                                                    </button>
                                                </form>
                                                <!-- Button trigger modal -->
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center"> No data found in the table</td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                        <span class="pagination_table">
                            {{ $data->links() }}
                        </span>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
