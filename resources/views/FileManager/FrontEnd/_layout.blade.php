<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@include('FileManager.FrontEnd._partials.header')

<body class="starter-page-page">


    <main class="main">
        <header id="header" class="header d-flex align-items-center sticky-top">
            <div class="container-fluid container-xl position-relative d-flex align-items-center">

                <a href="{{ route('user.entry.page') }}" class="logo d-flex align-items-center me-auto">
                    <img src="{{ asset('system/Default/logo.png') }}" alt="">
                    <h1 class="sitename">EDBRS</h1>
                </a>

                @include('FileManager.FrontEnd._partials.navbar')

            </div>
        </header>
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
                                        placeholder="Enter Your Telephone number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Telephone</label>
                                <div class="col-md-9" style="display: inline">
                                    <input type="tel" class="form-control" name="mobile"
                                            placeholder="Enter Mobile number with country code" minlength=10 required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter your email (Optional)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Question/Inquiry</label>
                                <textarea class="form-control" rows="5" name="question"
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
        $('#CCode').on('change',function(){
            var hml =$(this).val();
            alert(hml)
        })

    </script>

</body>

</html>
