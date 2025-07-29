@extends('FileManager.FrontEnd._layout')
@section('title')
    Register
@endsection
@section('content')
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.entry.page') }}">HOME</a></li>
                    <li class="current"><a href="#">REGISTER</a></li>
                </ol>
            </nav>

            <div class="row ">
                <div class="col-md-12" style="color: #37517e">
                    <marquee><span class="text text-red">jjjjjjjkkk</span></marquee>
                </div>
                <h1 class="mt-1"> User Registeration</h1>
            </div>

        </div>

    </div>

    
    <section id="faq-2" class="faq-2 section light-background"
     style="background-image: url('{{ asset('system/Default/sys4.jpeg') }}'); background-size: cover; background-repeat: no-repeat">
            <div class="row justify-content-center" ><div class="col-lg-6">
                    <span class="text text-red">jjjjjjjkkk</span>
                    <div class="faq-container" >
                        <div class="faq-item" data-aos="fade-up" data-aos-delay="300" style="opacity:0.9">
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
                                                <input type="text"
                                                    class="form-control @error('sname') is-invalid @enderror"
                                                    placeholder="Surname" name="sname" value="{{ old('sname') }}"
                                                    required>
                                                @error('sname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>First Name</label>
                                                <input type="text"
                                                    class="form-control @error('fname') is-invalid @enderror"
                                                    placeholder="Last Name" name="fname" value="{{ old('fname') }}"
                                                    required>
                                                @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>Other Name</label>
                                                <input type="text"
                                                    class="form-control @error('oname') is-invalid @enderror"
                                                    placeholder="Other Name" name="oname" value="{{ old('oname') }}">
                                                @error('oname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <label class="col-md-4">Email</label>
                                    <div class="col-md-8">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group  mb-2 row">
                                    <label class="col-md-4">Password</label>
                                    <div class="col-md-8">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                placeholder="Password" value="{{ old('password') }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <label class="col-md-4">Confirm Password</label>
                                    <div class="col-md-8">
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
                                <div class="form-group mb-1">
                                    <div class="input-group mb-3">
                                        <input id="file-input" type="file" name="userphoto" accept=".png,.jpg,.jpeg"
                                            style="display: none" class="form-control">
                                    </div>
                                </div>
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            <input type="checkbox" style="width:25px;height:25px;"id="terms" name="terms"
                                                required>
                                            <label for="agreeTerms" style="font-size: 25px;">
                                                I agree to the <a target="_blank"
                                                    href="{{ route('terms.show') }}">terms</a>
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
                                        <a href="{{ route('front.user.login') }}" class=" btn btn-success text-center">Back to
                                            Login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
