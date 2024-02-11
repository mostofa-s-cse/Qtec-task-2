<!doctype html>
<html lang="en">
<head>
    <title>@yield('title') </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

{{--    @include('layouts.vite')--}}

    @include('back-end.layouts.header')
    @include('back-end.layouts.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Arial Narrow', sans-serif">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('back-end.layouts.nav')
    <!-- /.navbar -->
    @include('back-end.layouts.sidebar')
    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            @yield('content-header')
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    {{--    footer start --}}
    @include('back-end.layouts.footer')
    {{--    footer end--}}
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
@include('back-end.layouts.js')
@yield('js')
</body>

</html>
