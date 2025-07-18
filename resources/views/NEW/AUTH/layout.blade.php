<!DOCTYPE html>
<html lang="en">

<head>

    @yield('meta_tag')

    @include('NEW._partials.styling.css')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-footer-fixed"   >
    <div class="wrapper" >

        <!-- Navbar -->
        @include('NEW._partials._navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('NEW._partials._sidebar')

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper"  style=" background-image: url('{{ asset('system/Default/bgimage.jpeg') }}'); opacity: 1; position: relative;" >

            @yield('content')


            @yield('modal')
        </div>

        <!-- /.content-wrapper -->
        <!-- Main Footer -->
        @include('NEW._partials._footer')

    </div>
    <!-- ./wrapper -->
 @include('NEW._partials.styling.scripts')

    @yield('scripts')
</body>

</html>
