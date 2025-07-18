@extends('NEW.AUTH.layout')
@section('page_title')
    DashBoard
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Statistics</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('file.list') }}">Home</a></li>
                        <li class="breadcrumb-item active">Statistics</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#test" data-toggle="tab">Test</a></li>
                        <li class="nav-item"><a class="nav-link" href="#esta" data-toggle="tab">Establishment</a></li>
                        <li class="nav-item"><a class="nav-link" href="#jobz" data-toggle="tab">Jobs</a></li>
                        <li class="nav-item"><a class="nav-link" href="#schemez" data-toggle="tab">Scheme</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rapexz" data-toggle="tab">RAPEX</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="test">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Today</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content" data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $Votestoday }}   @else {{ $myVotestoday }} @endif </h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesActivetoday }}   @else {{ $myVotesActivetoday }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesPendingtoday }}    @else {{ $myVotesPendingtoday }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesRejecttoday }}    @else {{ $myVotesRejecttoday }}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Yesterday</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $Votesyesterday }}    @else {{ $myVotesyesterday }}@endif </h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesActiveyesterday }}     @else {{ $myVotesActiveyesterday }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesRejectyesterday }}    @else {{ $myVotesRejectyesterday }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesPendingyesterday }}    @else {{ $myVotesPendingyesterday }}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Last Week</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $Voteslastweek }}    @else {{ $myVoteslastweek }}@endif </h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesActivelastweek }}   @else {{ $myVotesActivelastweek }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesRejectlastweek }}    @else {{ $myVotesRejectlastweek }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesPendinglastweek }}    @else {{ $myVotesPendinglastweek }}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">This Week</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesThisweek }}    @else {{ $myVotesThisweek }}@endif </h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")   {{ $VotesActiveThisweek }}   @else {{ $myVotesActiveThisweek }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesRejectThisweek }}    @else {{ $myVotesRejectThisweek }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesPendingThisweek }}   @else {{ $myVotesPendingThisweek }}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">This Month</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesThisMonth }}     @else{{ $myVotesThisMonth }}@endif</h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesActiveThisweek }}    @else {{ $myVotesActiveThisweek }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesRejectThisMonth }}   @else {{ $myVotesRejectThisMonth }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesPendingThisMonth}}    @else {{ $myVotesPendingThisMonth}}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Last Month</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesLastMonth }}    @else {{ $myVotesLastMonth }}@endif </h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesActiveLastMonth }}   @else {{ $myVotesActiveLastMonth }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesRejectLastMonth }}    @else {{ $myVotesRejectLastMonth }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesPendingLastMonth }}    @else {{ $myVotesPendingLastMonth }}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">This Year</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesThisYear }}    @else {{ $myVotesThisYear }}@endif </h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesActiveThisYear }}    @else {{ $myVotesActiveThisYear }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesRejectThisYear }}   @else {{ $myVotesRejectThisYear }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesPendingThisYear }}    @else {{ $myVotesPendingThisYear }}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Last Year</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesLastYear }}    @else {{ $myVotesLastYear }}@endif </h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin") {{ $VotesActiveLastYear }}    @else {{ $myVotesActiveLastYear }}@endif </h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin"){{ $VotesRejectLastYear }}     @else {{ $myVotesRejectLastYear }}@endif </h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")  {{ $VotesPendingLastYear }}   @else {{ $myVotesPendingLastYear }}@endif </h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              {{--  <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Custom</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-info">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")     @else 150</h3>
                                                            <p>Uploaded</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")     @else 53</h3>
                                                            <p>Approved</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="far fa-thumbs-up"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")     @else 44</h3>
                                                            <p>Rejected</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-user-plus"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-6">
                                                    <!-- small card -->
                                                    <div class="small-box bg-danger">
                                                        <div class="inner">
                                                            <h3> @if(Auth::user()->role == "admin" || Auth::user()->role =="superadmin")     @else 65</h3>
                                                            <p>Pending</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-chart-pie"></i>
                                                        </div>
                                                        <a href="{{ route('file.list') }}" class="small-box-footer">
                                                            More info <i class="fas fa-arrow-circle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="tab-pane" id="esta">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-1">Yesterday</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">{{ $myVotesyesterday }}</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">{{ $myVotesActiveyesterday }}</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">{{ $myVotesRejectyesterday }}</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-1">Today</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">{{ $myVotestoday }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">{{ $myVotesActivetoday }}</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">{{ $myVotesRejecttoday }}</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-1">This Week</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">1,410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">13,648</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-1">Last WeeK</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">1,410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">13,648</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-1">This Month</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">1,410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">13,648</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-1">Last Month</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">1,410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">13,648</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-1">This Year</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">1,410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">13,648</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-1">Last Year</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Uploads</span>
                                                    <span class="info-box-number">1,410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Checked</span>
                                                    <span class="info-box-number">410</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-4">
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                                <div class="info-box-content">
                                                    <span class="info-box-text">Denied</span>
                                                    <span class="info-box-number">13,648</span>
                                                </div>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="jobz"> JOBS</div>
                        <div class="tab-pane" id="schemez"> SCHEME</div>
                        <div class="tab-pane" id="rapexz"> RAPEX</div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
