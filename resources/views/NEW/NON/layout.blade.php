<!DOCTYPE html>
<html lang="en">

<head>
    @yield('meta_tag')
    @include('NEW._partials.styling.css')
</head>

<body class="hold-transition layout-navbar-fixed layout-footer-fixed layout-top-nav" style="background-color: blueviolet">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('NEW._partials._navbar')
        <!-- /.navbar -->

        <div class="content-wrapper">
            @yield('content')




        </div>

        <!-- Main Footer -->
        @include('NEW._partials._footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('NEW._partials.styling.scripts')
    @yield('scripts')
</body>

</html>
