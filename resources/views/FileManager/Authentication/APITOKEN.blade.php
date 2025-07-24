@extends('NEW.AUTH.layout')
@section('page_title')
    API Tokens
@endsection
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ Auth::user()->sname}} {{ Auth::user()->fname }} {{ Auth::user()->oname }}'s Profile </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <strong class="p-2">
                        Create API Token
                    </strong>
                    <p>
                        API tokens allow third-party services to authenticate with our application on your behalf.</p>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="tokenname" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 25px"><input value="create"
                                                        style="width: 25px; height:25px" type="checkbox"> Create</label>
                                            </div>
                                            <div class="form-group">
                                                <label style="font-size: 25px"><input value="read"
                                                        style="width: 25px; height:25px" type="checkbox"> Read</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label style="font-size: 25px"><input value="delete"
                                                        style="width: 25px; height:25px" type="checkbox"> Delete</label>
                                            </div>
                                            <div class="form-group">
                                                <label style="font-size: 25px"><input value="update"
                                                        style="width: 25px; height:25px" type="checkbox"> Update</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <input type="submit" value="CREATE" class="btn btn-dark float-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <strong class="p-2">
                        Manage API Tokens
                    </strong>
                    <p>
                        You may delete any of your existing tokens if they are no longer needed.
                    </p>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">Api Name</div>
                                <div class="col-md-2"><a href="#">Permssions</a></div>
                                <div class="col-md-2">
                                    <form>
                                        <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
@endsection
@section('modal')
    @if (Auth::user()->two_factor_secret == '')
        <div class="modal fade" id="confirmpass">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirm Password</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <p>For your security, please confirm your password to continue.</p>
                                <input type="password" name="password" class="form-control" placeholder="password"></input>
                            </div>
                            <div class="form-group float-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                                <button type="button" class="btn btn-primary">CONFIRM PASSWORD</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif
    <div class="modal fade" id="sessions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Log Out Other Browser Sessions</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <p>Please enter your password to confirm you would like to log out of your other browser
                                sessions across all of your devices.</p>
                            <input placeholder="password" type="password" name="password" class="form-control"></input>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                            <button type="button" class="btn btn-primary">LOG OUT OTHER BROWSER SESSIONS</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="sessions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Account</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <p>Are you sure you want to delete your account? Once your account is deleted, all of its
                                resources and data will be permanently deleted. Please enter your password to confirm you
                                would like to permanently delete your account.</p>
                            <input placeholder="password" type="password" name="password" class="form-control"></input>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                            <button type="button" class="btn btn-danger">DELETE ACCOUNT</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
@section('scripts')
    <script>
        var twoFactor = document.getElementById('twoFactor')
        var twoWrapper = document.getElementById('twoWrapper')

        $('#btnEnable').on('click', function() {
            twoWrapper.removeAttribute('hidden', 'hidde')
            twoFactor.setAttribute('hidden', 'hidde')
        })
        $('#btnreset').on('click', function() {
            twoWrapper.setAttribute('hidden', 'hidde')
            twoFactor.removeAttribute('hidden', 'hidde')
        })
        $('#btnlogout').on('click', function() {
            // alert("i am logout")
        })
        $('#btndelete').on('click', function() {
            alert("i am logout")
        })
    </script>
@endsection
