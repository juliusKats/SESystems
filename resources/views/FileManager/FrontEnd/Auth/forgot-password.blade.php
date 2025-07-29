@extends('FileManager.FrontEnd._layout')
@section('title')
   Forgot Password
@endsection
@section('content')
    <div class="page-title" data-aos="fade">
        <div class="container text text-white">
            <h1>Password Reset</h1>
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
                                    <form action="{{ route('password.email') }}" method="post">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <div class="input-group">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" name="email">
                                                 @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                           
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-dark">EMAIL PASSWORD RESET
                                                    LINK</button>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2">
                                                <a href="{{ route('front.user.login') }}" class="btn btn-danger float-right">Cancel</a>
                                            </div>
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
