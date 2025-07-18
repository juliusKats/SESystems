@extends('_FMSLayout.Auth.layout')
@section('auth_title')
    Forgot Password
@endsection
@section('main_content')

<div class="card card-primary">
    <div class="card-header">
        <h4>Forgot Password</h4>
    </div>

    <div class="card-body">
        <p class="text-muted">We will send a link to reset your password</p>
        <form method="POST" method="POST" action="{{ route('reset.password.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input  name="email" type="email" class="form-control @error('email') is-invalid @enderror" required autofocus>
                @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Email Password Reset Link
                    </button>
            </div>
        </form>
    </div>
</div>

@endsection

