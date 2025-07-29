@extends('FileManager.FrontEnd._layout')
@section('title')
Login
@endsection
@section('content')
<div class="justify-content-center" style="height: 50px;background-color: #37517e">
        <marquee class="blink" behavior="scroll" direction="left" scrollamount="5"
            style=" font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bolder; font-size: xx-large;">
            <img src="{{ asset('system/frontEnd/img/bg/word.webp') }}" style="width: 1000px; color: blue;" alt="">
        </marquee>
    </div>
    <div class="page-title" data-aos="fade">
        <div class="container text text-white">
            <div class="row">
                <div class="col-md-10">
                    <h1>Login</h1>
                </div>
                <div class="col-md-2">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                            <li class="current">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
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
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3">Email</label>
                                            <div class="col-md-9">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Enter Email" name="email" value="{{ old('email') }}">
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
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror "
                                                    name="password" placeholder="Password" value="{{ old('password') }}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="icheck-primary">
                                                <input type="checkbox" style="width:25px;height:25px;"id="remeber_me"
                                                    name="remember" id="remember_me">
                                                <label for="agreeTerms" style="font-size: 25px;">Remeber Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <a href="{{ route('front.user.register') }}" class="text-center">Don't Have Account</a>
                                            </div>
                                            @if (Route::has('password.request'))
                                                <div class="col-md-6">
                                                    <a class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                        href="{{ route('forget.password.get') }}">
                                                        Forgot your password?
                                                    </a>
                                                </div>
                                            @endif
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
