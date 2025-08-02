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
        const tabs = document.querySelectorAll('.mynav');
        // const navItem = document.querySelectorAll('.nav-item');
        tabs.forEach(
            tab => { tab.addEventListener('click', () => {
                // Remove 'active' class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                // Add 'active' class to the clicked tab
                tab.classList.add('active');
                tab.classList.add('menu-open');
            });
        });

        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            @if (session('success'))
                // Swal.fire({
                //     icon: 'success',
                //     title: 'Success',
                //     text: "{{ session('success') }}",
                //     timer: 2500
                // })
                toastr.success('{{ session('success') }}')
            @elseif (session('error'))
                var form = $(this).closest("form");
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    // timer: 3000
                })
                // toastr.error('{{ session('error') }}')
            @elseif (session('warning'))
                Swal.fire({
                    icon: 'warning',
                    title: 'warning',
                    text: "{{ session('warning') }}",
                    // timer: 3000
                })
                // toastr.warning('{{ session('warning') }}')
            @elseif (session('info'))
                // Swal.fire({
                //     icon: 'info',
                //     title: 'information',
                //     text: "{{ session('info') }}",
                //     timer: 3000
                // })
                toastr.info('{{ session('info') }}')
            @endif
        })
    </script>
</body>

</html>
