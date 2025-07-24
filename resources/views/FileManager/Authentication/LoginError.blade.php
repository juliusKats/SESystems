@extends('NEW.NON.layout')
@section('page_title')
    UnAthorised User
@endsection
@section('content')

    <section class="content-header" >
      <div class="container-fluid" >
        <div class="row mb-2">
            <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <h1 class="text-danger"><strong>ELECTRONIC DATA BACKUP & RECOVERY SYSTEM (EDBRS)</strong></h1>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Error Login</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content" >
      <div class="card container" >
        <h3 class="headline  text-center"><strong>Hello</strong> <strong style="color: blue">{{ Auth::user()->sname}} {{ Auth::user()->fname }} {{ Auth::user()->oname }}</strong></h3><hr>
        {{-- <h2 class="headline text-danger text-center">Login Error</h2> --}}

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i>Your Account Is inactive or Disabled.</h3>

          <p>
            Contact the System Administrator to Activate or Enable your accouth.
            Meanwhile, you may <a href="{{ route('home.dashboard') }}">return to Home</a>.
          </p>


        </div>
      </div>
      <!-- /.error-page -->

    </section>

@endsection
