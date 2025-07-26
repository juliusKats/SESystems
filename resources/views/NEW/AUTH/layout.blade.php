<!DOCTYPE html>
<html lang="en">

<head>

    @yield('meta_tag')

    @include('NEW._partials.styling.css')
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('NEW._partials._navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('NEW._partials._sidebar')

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            {{-- @include('NEW._partials.styling.notification') --}}
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
    <script>
        $(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    timer: 2500
                })
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    timer: 3000
                })
            @elseif (session('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'warning',
                    text: "{{ session('warning') }}",
                    timer: 3000
                })
            @elseif (session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'information',
                    text: "{{ session('info') }}",
                    timer: 3000
                })
            @endif
        })
    </script>
</body>

</html>
