@extends('NEW.NON.layout')
@section('page_title')
    Contact Us
@endsection
@section('content')

    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact us</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact us</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">

        <!-- Default box -->
        <div class="card container">
            <div class="card-body row">
                <div class="col-5 ">

                    <div class="mt-1">
                        <h2>Ministry Of Public Service</h2>
                        <div class="lead mb-1">
                            <i class="fa fa-home"></i>
                            123 Testing Ave, Testtown, 9876 NA
                        </div>
                        <div class="lead mb-1"><i class="fa fa-phone"></i> Phone: +1 234 56789012
                        </div>
                    </div>
                    <div class="lead mt-1">
                        <img src="{{ asset('system/Default/logo.png') }}">
                    </div>
                </div>
                <div class="col-7">
                    <form method="post" action="{{route('save.contact.us')}}">
                        @csrf
                    <div class="form-group row">
                        <label class="col-md-3">Full Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('fullname')is-invalid @enderror"
                                name="fullname" required />
                        </div>
                        @error('fullname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Telephone</label>
                        <div class="col-md-9">
                            <input type="tel" class="form-control @error('telephone')is-invalid @enderror"
                                name="telephone" required />
                        </div>
                        @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">E-Mail</label>
                        <div class="col-md-9">
                            <input type="email" class="form-control @error('email')is-invalid @enderror" name="email"
                                required />
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Subject</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('subject')is-invalid @enderror" name="subject"
                                required />
                        </div>
                        @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea id="inputMessage" class="form-control @error('message')is-invalid @enderror" rows="4" name="message"
                            required></textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div class="form-group">
                    <input type="file" name="screenshot[]" class="form-control @error('screenshoot')is-invalid @enderror" accept=".jpg,.png,.jpg,.docx,.doc,.xlsx,.xls,.pdf">
                     @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <div>
                    <div class="form-group mt-1">
                        <input type="submit" class="btn btn-primary" value="Send message">
                    </div>
                </form>
                </div>
            </div>
        </div>

    </section>

@endsection
