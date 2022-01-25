<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'SAuth Admin')</title>
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
        @yield('before-styles')
        <link rel="stylesheet" href="{{ asset('plugins/dist/css/sauth.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/dist/css/sa-admin.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}">

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- Styles -->
        @yield('before-styles')

        @yield('after-styles')

        <script>
            window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
        </script>
    </head>
    <body class="sidebar-mini layout-fixed layout-navbar-fixed">

        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')

                </section>

                <!-- Main content -->
                <section class="content">
                    @include('backend.includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        @yield('before-scripts')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.js') }}"></script>
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/common/datatable.js') }}"></script>
        <script src="{{ asset('plugins/common/scripts.js') }}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <!-- JavaScripts -->

        @yield('after-scripts')
    </body>
</html>
