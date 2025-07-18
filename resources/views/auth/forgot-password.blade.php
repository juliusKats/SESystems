@extends('layouts._authlayout')
@section('page_title')
    Forgot Password
@endsection
@section('auth_content')
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>EDBRS</b></a>
            </div>
            <div class="card-body">
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                        <button type="submit" class="btn btn-dark">EMAIL PASSWORD RESET LINK</button>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <a href="{{ route('login') }}" class="btn btn-danger float-right">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
