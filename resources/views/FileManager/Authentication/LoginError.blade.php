@extends('FileManager.FrontEnd._layout')
@section('title')
    Login Error
@endsection
@section('content')
    <section class="text text-white"  style="background-image: url('{{ asset('system/Default/sys4.jpeg') }}'); background-size: cover; background-repeat: no-repeat">

    <div class="justify-content-center" style="height: 50px;background-color: #37517e">

        <marquee class="blink" behavior="scroll" direction="left" scrollamount="5"
            style=" font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bolder; font-size: xx-large;">
            <img src="{{ asset('system/frontEnd/img/bg/word.webp') }}" style="width: 1000px; color: blue;" alt="">
        </marquee>
    </div>
    <div class="page-title" data-aos="fade" style="height: 50px;background-color: #37517e">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1>Login Error</h1>
                </div>
                <div class="col-md-2">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                            <li class="current">LoginError</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="text-center">
            <h2 class="error-title mt-4" data-aos="fade-up" data-aos-delay="400"><strong>Hello</strong> <strong
                    style="color: white">{{ Auth::user()->sname }} {{ Auth::user()->fname }}
                    {{ Auth::user()->oname }}</strong></h2>
            <hr>
            <h3 class="text text-white"><i class="fas fa-exclamation-triangle text-danger mt-1 error-title" data-aos="fade-up"
                    data-aos-delay="400"></i>Your Account Is inactive or Disabled.</h3>
            <p style="font-size: 28px; font: bold;" class="error-text mb-4" data-aos="fade-up" data-aos-delay="500">
                Contact the System Administrator to Activate or Enable your account.
            </p>
            <div class="error-action" data-aos="fade-up" data-aos-delay="700">
                <a href="/" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>
    </section>
@endsection
