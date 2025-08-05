<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@include('FileManager.FrontEnd._partials.header')

<body class="starter-page-page">


    <main class="main">
        @include('FileManager.FrontEnd._partials.navbar')

<!--        </header>-->
        @yield('content')

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inquire From Us</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action={{ route('user.inquiry') }}>
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-3">Full Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="fullname" minlength="5" required
                                        placeholder="Enter Your Full Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Telephone</label>
                                <div class="col-md-9" style="display: inline">
                                    <input type="tel" class="form-control" name="mobile"
                                            placeholder="Enter Mobile number." minlength=10>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" required
                                        placeholder="Enter your email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Subject</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="subject" required minlength="5" maxlength="25"
                                        placeholder="Subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="5" name="question" required
                                    placeholder="Type your question. Between 10 and 200 Characters" minlength="5" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </main>


    <!-- Vendor JS Files -->
    @include('FileManager.FrontEnd._partials.footer')
    <!-- Vendor JS Files -->
    @include('FileManager.FrontEnd._partials.scripts')

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
