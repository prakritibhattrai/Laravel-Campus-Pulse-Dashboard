<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            @if(request()->segment(3))
               <h4 class="mb-sm-0 font-size-18"><a href="{{ route(request()->segment(2)) }}"><i class="bx bx-left-arrow-alt text-bold"></i></a> {{ ucfirst(request()->segment(3)) }}</h4>
            @else
                <h4 class="mb-sm-0 font-size-18">{{ ucfirst(Route::currentRouteName()) }}</h4>
            @endif

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if(request()->segment(1))
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                    @if(request()->segment(2) && !request()->segment(3))
                        <li class="breadcrumb-item active">{{ ucwords(str_replace('-', ' ', (request()->segment(2)))) }}</li>
                    @endif

                    @if(request()->segment(3))
                        <li class="breadcrumb-item"><a href="{{ route(request()->segment(2)) }}">{{ ucwords(str_replace('-', ' ',request()->segment(2))) }}</a></li>
                       <li class="breadcrumb-item active">{{ ucfirst(request()->segment(3)) }}</li>
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
