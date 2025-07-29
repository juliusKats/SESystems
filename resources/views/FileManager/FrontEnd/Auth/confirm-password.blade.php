@extends('FileManager.FrontEnd._layout')
@section('title')
    Forgot Password
@endsection
@section('content')
    <div class="page-title" data-aos="fade">
        <div class="container text text-white">
            <h1>Confirm Password</h1>
        </div>
    </div>

    
    <section id="faq-2" class="faq-2 section light-background"
        style="background-image: url('{{ asset('system/frontEnd/img/bg/bg-8.webp') }}')">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="faq-container">
                        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="card card-outline card-primary">
                                <div class="card-header text-center">
                                    <a href="{{ route('user.entry.page') }}" class="h1"><b>EDBRS</a>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2 text text-gray-600">
                                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                                    </div>
                                    <form action="{{ route('password.confirm') }}" method="post">
                                        @csrf

                                        <div class="form-group mb-1">
                                            <label>Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" name="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                                <button type="submit" class="btn btn-dark">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
