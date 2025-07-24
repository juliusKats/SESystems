@extends('NEW.AUTH.layout')
@section('page_title')
    Profile
@endsection
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ Auth::user()->sname }} {{ Auth::user()->fname }} {{ Auth::user()->oname }}'s Profile </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">{{ session('success') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">{{ session('error') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-5">
                    <strong class="p-2">Profile Information</strong>
                    <p>Update your account's profile information and email address</p>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <label>Photo</label>
                            <div id="imgpreview">
                                @if (Auth::user()->profile_photo_path)
                                    <img style="width:100px;height:100px; border-color: blue; border-width: 2px; border-radius: 100%;"
                                        src="{{ url('storage/profile/' . Auth()->user()->profile_photo_path) }}">
                                @else
                                    <img style="width:100px;height:100px; border-color: blue; border-width: 2px; border-radius: 100%;"
                                        src="{{ asset('system/Default/defaultuser.jpg') }}">
                                @endif
                            </div>

                            <div class="mt-2">
                                <button id="btnupload" class="btn btn-primary">Select A New Photo</button>
                                @if (Auth::user()->profile_photo_path != null)
                                    <form method="post" action="{{ route('remove-user-photo', Auth::user()->id) }}"
                                        style="display: inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="submit" value="Remove Photo" class="btn btn-danger">
                                    </form>
                                @endif
                            </div>
                            <div class="mt-2">
                                <form method="post" enctype="multipart/form-data"
                                    action="{{ route('update-profile', Auth::user()->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <input id="file-input" type="file" name="userphoto" accept=".png,.jpg,.jpeg"
                                        class="form-control" style="display: none">
                                    <div class="form-group row">
                                        <label class="col-md-3">Surname</label>
                                        <div class="col-md-9">
                                            <input type="text" name="sname" value="{{ Auth::user()->sname }}"
                                                class="form-control  @error('sname')is-invalid @enderror">
                                        </div>
                                        @error('sname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">First Name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="fname" value="{{ Auth::user()->fname }}"
                                                class="form-control @error('fname')is-invalid @enderror">
                                        </div>
                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">Other name</label>
                                        <div class="col-md-9">
                                            <input type="text" name="oname" value="{{ Auth::user()->oname }}"
                                                class="form-control  @error('oname')is-invalid @enderror">
                                        </div>
                                        @error('oname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">Email</label>
                                        <div class="col-md-9">
                                            <input type="email" readonly name="email" value="{{ Auth::user()->email }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="SAVE" class="btn btn-dark float-right">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <strong class="p-2">Update Password</strong>
                    <p>Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="mt-2">
                                <form method="post" action="{{ route('update.password', Auth::user()->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-md-4">Current Password</label>
                                        <div class="col-md-8">
                                            <input type="password" name="userpass" required
                                                class="form-control  @error('userpass')is-invalid @enderror">
                                        </div>
                                        @error('userpass')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">New Password</label>
                                        <div class="col-md-8">
                                            <input minlength="5" type="password" name="newpass" required minlength="5"
                                                class="form-control  @error('newpass')is-invalid @enderror">
                                        </div>
                                        @error('newpass')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4">Confirm Password</label>
                                        <div class="col-md-8">
                                            <input type="password" name="confirm_password" required minlength="5"
                                                class="form-control  @error('confirm_password')is-invalid @enderror">
                                            @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="SAVE" class="btn btn-dark float-right">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{-- <div class="row">
            <div class="col-md-5">
                <strong class="p-2">Two Factor Authentication</strong>
                <p>Add additional security to your account using two factor authentication.</p>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div hidden id="twoWrapper">
                            <h4><strong>
                                    Finish enabling two factor authentication.
                                </strong>
                            </h4>
                            <p>
                                When two factor authentication is enabled, you will be prompted for a secure, random
                                token during authentication. You may retrieve this token from your phone's Google
                                Authenticator application.
                            </p>
                            <p>
                                <strong>
                                    To finish enabling two factor authentication, scan the following QR code using your
                                    phone's authenticator application or enter the setup key and provide the generated
                                    OTP code.
                                </strong>
                            </p>
                            <div>
                                QR
                            </div>
                            <di>
                                Setup Key: IPFHRG7DACTZ4YW7
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type ="text" name="verificationcode" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type ="submit" class="btn btn-success" value="Confirm">
                                    <input id="btnreset" type="reset" class="btn btn-danger" value="Cancel">
                                </div>

                            </di>
                        </div>

                        <strong class="p-2">You have not enabled two factor authentication.</strong>
                        <p>When two factor authentication is enabled, you will be prompted for a secure, random token
                            during authentication. You may retrieve this token from your phone's Google Authenticator
                            application.</p>

                        <div id="twoFactor" class="mt-2">
                            <button id="btnEnable" class="btn btn-dark"
                                @if (Auth::user()->two_factor_secret == null) data-toggle="modal"
                                    data-target="#confirmpass" @endif>Enable</button>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <strong class="p-2">Browser Sessions</strong>
                    <p>Manage and log out your active sessions on other browsers and devices.</p>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                If necessary, you may log out of all of your other browser sessions across all of your
                                devices. Some of your recent sessions are listed below; however, this list may not be
                                exhaustive. If you feel your account has been compromised, you should also update your
                                password.
                            </p>
                            @if (count($activesessions) > 0)
                                <div class="mt-1 space-y-6">
                                    @foreach ($activesessions as $session)
                                        <?php

                                        $ad = new Karmendra\LaravelAgentDetector\AgentDetector($session->user_agent);
                                        ?>
                                        <div class="flex items-center">
                                            <div>
                                                @if ($ad->isDesktop())
                                                    <i class="fa fa-light fa-desktop"
                                                        style="font-size: 48px; color: blue;"></i>
                                                        @if($ad->platform()) {{ $ad->platform() }}
                                                        @else
                                                        {{ _('Unknown') }}
                                                        @endif -

                                                        @if($ad->browser()) {{ $ad->browser() }}
                                                        @else
                                                        {{ _('Unknown') }}
                                                        @endif
                                                        <br>
                                                        {{ $session->ip_address }}
                                                    <hr>
                                                @elseif($ad->isSmartphone())
                                                    <i class="fa fa-light fa-mobile"
                                                        style="font-size: 48px; color: blue;"></i>
                                                    <hr>
                                                @elseif($ad->isMobile())
                                                    <i class="fa fa-light fa-mobile"
                                                        style="font-size: 48px; color: blue;"></i>
                                                    <hr>
                                                @elseif($ad->isTablet())
                                                    <i class="fa fa-light fa-tablet"
                                                        style="font-size: 48px; color: blue;"></i>
                                                    <hr>
                                                @else
                                                    <i class="fa fa-light fa-tv"
                                                        style="font-size: 48px; color: blue;"></i>
                                                @endif

                                            </div>
                                            <div class="ms-3">
                                                <div class="text-sm text-gray-600">
                                                     @if($ad->platform()) {{ $ad->platform() }}
                                                        @else
                                                        {{ _('Unknown') }}
                                                        @endif -
                                                     @if($ad->browser()) {{ $ad->browser() }}
                                                        @else
                                                        {{ _('Unknown') }}
                                                        @endif
                                                </div>
                                                <div>
                                                    {{ $session->ip_address }}
                                                    {{$session->id}}

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            {{-- <div class="card">
                            <div class="user-block mb-3">
                                <img class="img-circle img-bordered-sm"
                                    src="{{ asset('system/dist/img/user1-128x128.jpg') }}" alt="user image">
                                <span class="username">
                                    <a href="#">Jonathan Burke Jr.</a>

                                </span>
                                <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                        </div> --}}
                            <hr>

                            <div class="mt-2">
                                <button id="btnlogout" class="btn btn-dark" data-toggle="modal"
                                    data-target="#sessions">LOG
                                    OUT OTHER BROWSER SESSIONS</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{-- <div class="row">
            <div class="col-md-5">
                <strong class="p-2">Delete Account</strong>
                <p>Permanently delete your account.</p>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <p>Once your account is deleted, all of its resources and data will be permanently deleted.
                            Before deleting your account, please download any data or information that you wish to
                            retain.</p>

                        <div class="mt-2">
                            <button id="btndelete" class="btn btn-danger" data-toggle="modal"
                                data-target="#deletion">DELETE ACCOUNT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
                                <input type="password" name="password" class="form-control"
                                    placeholder="password"></input>
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
                    <form method="post" action="{{ route('logout.sessions') }}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <p>Please enter your password to confirm you would like to log out of your other browser
                                sessions across all of your devices.</p>
                            <input placeholder="password" type="password" name="password" class="form-control"></input>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                            <input type="submit" class="btn btn-primary" value="LOG OUT OTHER BROWSER SESSIONS">
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
        $('#btnupload').on('click', function() {
            $('#file-input').trigger('click');
        })
        const img = document.getElementById('file-input')

        img.addEventListener('change', function() {
            getImgData();
        })

        function getImgData() {
            const files = img.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener('load', function() {
                    // imgpreview.setAttribute('class','profile-user-img img-fluid img-circle')
                    imgpreview.style.display = "block"
                    imgpreview.innerHTML = '<img style="width:150px;height:150px;border-radius:100%" src="' + this
                        .result + '" />';
                })
            }
        }


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
