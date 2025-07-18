@extends('layouts._authlayout')
@section('page_title') Login @endsection
@section('auth_content')

<div class="col-md-6 col-sm-6">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>EDBRS</a>
        </div>
        <div class="card-body">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-md-3">Email</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" name="email" value="{{ old('email') }}">
                         @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="form-group row  mb-3">
                    <label class="col-md-3">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" placeholder="Password" value="{{ old('password') }}">
                         @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                        <div class="icheck-primary">
                            <input type="checkbox" style="width:25px;height:25px;"id="remeber_me" name="remember" id="remember_me">
                            <label for="agreeTerms" style="font-size: 25px;">Remeber Me</label>
                        </div>
                    </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                         <a href="{{ route('register') }}" class="text-center">Don't Have Account</a>
                    </div>
                    @if (Route::has('password.request'))
                    <div class="col-md-6">
                        <a class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                    </div>
                    @endif
                </div>
            </form>
        </div>


    </div>
</div>
@endsection
