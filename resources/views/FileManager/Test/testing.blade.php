@extends('_FMSLayout.Main.layout')
@section('page_title')
    Vote List
@endsection
@section('main_content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Hero</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Components</a></div>
                    <div class="breadcrumb-item">Hero</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="hero text-white hero-bg-image hero-bg-parallax"
                            style="background-image: url('{{ asset('mops_asset/img/unsplash/andre-benz-1214056-unsplash.jpg') }}');">
                            <div class="hero-inner">
                                <h2>Welcome, {{ Auth::user()->sname}} {{ Auth::user()->fname }} {{ Auth::user()->oname }}</h2>
                                <p class="lead">You almost arrived, complete the information about your account to
                                    complete registration.</p>
                                <div class="mt-1">
                                    <a href="#" id="account" class="btn btn-outline-white btn-lg btn-icon icon-left"><i
                                            class="far fa-user"></i> Setup Account</a>
                                    <div id="account setup  mt-3">
                                        <div class="row">
                                            <div class="col-md-4">Setup</div>
                                            <div class="col-md-8">Form</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Setup</div>
                                            <div class="col-md-8">Form</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Setup</div>
                                            <div class="col-md-8">Form</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Setup</div>
                                            <div class="col-md-8">Form</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Setup</div>
                                            <div class="col-md-8">Form</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
