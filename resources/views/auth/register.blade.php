@extends('layouts._authlayout')
@section('page_title')
    Register
@endsection
@section('auth_content')
    <div class="col-md-6 col-sm-6">
        <div class="card-outline card-primary" style=" border-width: 4px; border-color: blue ">
            <div class="card-header text-center">
                <a href="#"><h1><b>EDBRS</b></h1></a>
            </div>
            <div class="card-body text-primary">

                <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Photo</label>
                            <div id="imgpreview mt-4">
                                <img style="width:100px;height:100px; border-color: blue; border-width: 2px; border-radius: 100%;"
                                    src="{{ asset('system/Default/defaultuser.jpg') }}">
                            </div>
                            <label id="btnupload" class="btn btn-primary mt-4 mb-0">Select Photo</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mb-1">
                                <label>Surname</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('sname') is-invalid @enderror"
                                        placeholder="Surname" name="sname" value="{{ old('sname') }}" required>
                                    @error('sname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label>First Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                        placeholder="Last Name" name="fname" value="{{ old('fname') }}" required>
                                    @error('fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label>Other Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('oname') is-invalid @enderror"
                                        placeholder="Other Name" name="oname" value="{{ old('oname') }}">
                                    @error('oname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-2 row">
                        <label class="col-md-4">Email</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email" name="email" value="{{ old('email') }}">
                                @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group  mb-2 row">
                        <label class="col-md-4">Password</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Password" value="{{ old('password') }}">
                                 @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2 row">
                        <label class="col-md-4">Confirm Password</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    value="{{ old('password_confirmation') }}" placeholder="Retype password">
                                 @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <div class="input-group mb-3">
                            <input id="file-input" type="file" name="userphoto" accept=".png,.jpg,.jpeg"
                                style="display: none" class="form-control">
                        </div>
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="form-group">
                            <div class="icheck-primary">
                                <input type="checkbox" style="width:25px;height:25px;"id="terms" name="terms" required>
                                <label for="agreeTerms" style="font-size: 25px;">
                                    I agree to the <a target="_blank" href="{{ route('terms.show') }}">terms</a>
                                    and <a a target="_blank" href="{{ route('policy.show') }}">Policy</a>
                                </label>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <a href="{{ route('login') }}" class=" btn btn-success text-center">Back to Login</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
