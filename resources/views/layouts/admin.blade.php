<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Dashboard &lsaquo; WHN CMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ ('assets/img/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/select2/css/select2.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/summernote/summernote-lite.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/libs/pace/pace.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/bootstrap-colorpicker.css') }}" rel="stylesheet" type="text/css">

        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
        {{-- CSS assets in head section --}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    </head>

    @yield('style')
    <body data-sidebar="dark">

        <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('admin.inc.header')

            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.inc.vertical_menu')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @include('admin.inc.session')
                        @include('admin.inc.breadcrumbs')
                        @yield('content')

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                @include('admin.inc.footer');
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->

        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('assets/libs/summernote/summernote-lite.min.js') }}"></script>
        <script src="{{asset('assets/dist/bootstrap-tagsinput.js')}}"></script>
        <script src="{{asset('assets/libs/pace/pace.min.js') }}"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.js" integrity="sha512-Ky7SgifG9Q4ANAFvK3k7zkfdrkbM+jBJyT6kgS2cdl8VbNNo2X+kKmq73xieujm0C6HEaXDA5po3r6lmwe4sMg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
        <script src="{{ asset('assets/js/bootstrap-filestyle.min.js') }}"></script>
        <script src="{{asset('assets/js/admin.js')}}"></script>
        @yield('script')


        <script type="text/javascript" charset="utf-8">

        </script>

        <script>

        </script>

        {{--  Remove Themes Image  --}}
        <script type="text/javascript">

        </script>
        <script type="text/javascript">


        </script>

    </body>
</html>
