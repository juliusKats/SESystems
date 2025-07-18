@extends('_FMSLayout.Auth.layout')
@section('page_title')
    Login
@endsection
@section('main_content')
    <div class="card card-primary">
        <div class="card-body"> 
            <form method="POST" action="#" class="needs-validation" novalidate="">
                <div class="form-group row">
                    <label class="col-sm-3">Email</label>
                    <div class="col-md-9">
                        <input id="email" type="email" class="form-control" name="email" required autofocus />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3">Password</label>
                    <div class="col-md-9">
                        <input id="password" type="password" class="form-control" name="password" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" style="width:25px; height:25px;"
                            id="remember-me" />
                        <label class="custom-control-label" for="remember-me">Remember
                            Me</label>
                    </div>
                    <span class="float-right">
                        <a href="auth-forgot-password.html" class="text-big">Forgot Password?</a>
                    </span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Login</button>
                </div>

            </form>
            <div class="text-center">
                <div class="text-job text-muted mb-2">Login With Social</div>
            </div>
            <div class="row form-group">
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                        <span class="fab fa-facebook"></span> Facebook
                    </a>
                </div>
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                        <span class="fab fa-twitter"></span> Twitter
                    </a>
                </div>
            </div>
            <div class="form-group">
                Don't have an account?
                <a href="auth-register.html">Create One</a>
            </div>
        </div>
    </div>
@endsection
