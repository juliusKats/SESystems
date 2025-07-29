@extends('FileManager.FrontEnd._layout')
@section('title')
    Verify Email
@endsection
@section('content')
    <div class="page-title" data-aos="fade">
        <div class="container text text-white">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Verify Email</li>
                </ol>
            </nav>
            <h1>Email Verification</h1>
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
                                     <div class="mb-2 text-sm text-gray-600">
                                        {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                    </div>
                                    @if (session('status') == 'verification-link-sent')
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('verification.send') }}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Resend Verification </button>
                                        </div>>
                                    </form>
                                   <div>
                                        <a href="{{ route('profile.show') }}"  class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Edit Profile
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}" class="inline">
                                            @csrf
                                            <button type="submit" class="btn-logout underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                                                {{ __('Log Out') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
