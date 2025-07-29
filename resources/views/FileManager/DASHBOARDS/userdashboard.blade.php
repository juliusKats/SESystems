@extends('NEW.AUTH.layout')
@section('page_title')
    DashBoard
@endsection
@section('content')
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
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#esta" data-toggle="tab">Establishment</a></li>
                        <li class="nav-item"><a class="nav-link" href="#jobz" data-toggle="tab">Jobs</a></li>
                        <li class="nav-item"><a class="nav-link" href="#schemez" data-toggle="tab">Scheme</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rapexz" data-toggle="tab">RAPEX</a></li>
                        <li class="nav-item"><a class="nav-link" href="#serviceuganda" data-toggle="tab">Service Uganda</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="esta">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Votestoday }}
                                                                @else
                                                                    {{ $myVotestoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActivetoday }}
                                                                @else
                                                                    {{ $myVotesActivetoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendingtoday }}
                                                                @else
                                                                    {{ $myVotesPendingtoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejecttoday }}
                                                                @else
                                                                    {{ $myVotesRejecttoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Votesyesterday }}
                                                                @else
                                                                    {{ $myVotesyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActiveyesterday }}
                                                                @else
                                                                    {{ $myVotesActiveyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejectyesterday }}
                                                                @else
                                                                    {{ $myVotesRejectyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendingyesterday }}
                                                                @else
                                                                    {{ $myVotesPendingyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Voteslastweek }}
                                                                @else
                                                                    {{ $myVoteslastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActivelastweek }}
                                                                @else
                                                                    {{ $myVotesActivelastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejectlastweek }}
                                                                @else
                                                                    {{ $myVotesRejectlastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendinglastweek }}
                                                                @else
                                                                    {{ $myVotesPendinglastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesThisweek }}
                                                                @else
                                                                    {{ $myVotesThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActiveThisweek }}
                                                                @else
                                                                    {{ $myVotesActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejectThisweek }}
                                                                @else
                                                                    {{ $myVotesRejectThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendingThisweek }}
                                                                @else
                                                                    {{ $myVotesPendingThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesThisMonth }} @else{{ $myVotesThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActiveThisweek }}
                                                                @else
                                                                    {{ $myVotesActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejectThisMonth }}
                                                                @else
                                                                    {{ $myVotesRejectThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendingThisMonth }}
                                                                @else
                                                                    {{ $myVotesPendingThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesLastMonth }}
                                                                @else
                                                                    {{ $myVotesLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActiveLastMonth }}
                                                                @else
                                                                    {{ $myVotesActiveLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejectLastMonth }}
                                                                @else
                                                                    {{ $myVotesRejectLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendingLastMonth }}
                                                                @else
                                                                    {{ $myVotesPendingLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesThisYear }}
                                                                @else
                                                                    {{ $myVotesThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActiveThisYear }}
                                                                @else
                                                                    {{ $myVotesActiveThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejectThisYear }}
                                                                @else
                                                                    {{ $myVotesRejectThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendingThisYear }}
                                                                @else
                                                                    {{ $myVotesPendingThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesLastYear }}
                                                                @else
                                                                    {{ $myVotesLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesActiveLastYear }}
                                                                @else
                                                                    {{ $myVotesActiveLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesRejectLastYear }}
                                                                @else
                                                                    {{ $myVotesRejectLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $VotesPendingLastYear }}
                                                                @else
                                                                    {{ $myVotesPendingLastYear }}
                                                                @endif
                                                            </h3>
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
                        </div>
                        <div class="tab-pane" id="jobz">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Today</h3>

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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Jobtoday }}
                                                                @else
                                                                    {{ $myJobtoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActivetoday }}
                                                                @else
                                                                    {{ $myJobActivetoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendingtoday }}
                                                                @else
                                                                    {{ $myJobPendingtoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejecttoday }}
                                                                @else
                                                                    {{ $myJobRejecttoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Jobyesterday }}
                                                                @else
                                                                    {{ $myJobyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActiveyesterday }}
                                                                @else
                                                                    {{ $myJobActiveyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejectyesterday }}
                                                                @else
                                                                    {{ $myJobRejectyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendingyesterday }}
                                                                @else
                                                                    {{ $myJobPendingyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Joblastweek }}
                                                                @else
                                                                    {{ $myJoblastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActivelastweek }}
                                                                @else
                                                                    {{ $myJobActivelastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejectlastweek }}
                                                                @else
                                                                    {{ $myJobRejectlastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendinglastweek }}
                                                                @else
                                                                    {{ $myJobPendinglastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobThisweek }}
                                                                @else
                                                                    {{ $myJobThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActiveThisweek }}
                                                                @else
                                                                    {{ $myJobActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejectThisweek }}
                                                                @else
                                                                    {{ $myJobRejectThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendingThisweek }}
                                                                @else
                                                                    {{ $myJobPendingThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobThisMonth }} @else{{ $myJobThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActiveThisweek }}
                                                                @else
                                                                    {{ $myJobActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejectThisMonth }}
                                                                @else
                                                                    {{ $myJobRejectThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendingThisMonth }}
                                                                @else
                                                                    {{ $myJobPendingThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobLastMonth }}
                                                                @else
                                                                    {{ $myJobLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActiveLastMonth }}
                                                                @else
                                                                    {{ $myJobActiveLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejectLastMonth }}
                                                                @else
                                                                    {{ $myJobRejectLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendingLastMonth }}
                                                                @else
                                                                    {{ $myJobPendingLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobThisYear }}
                                                                @else
                                                                    {{ $myJobThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActiveThisYear }}
                                                                @else
                                                                    {{ $myJobActiveThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejectThisYear }}
                                                                @else
                                                                    {{ $myJobRejectThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendingThisYear }}
                                                                @else
                                                                    {{ $myJobPendingThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobLastYear }}
                                                                @else
                                                                    {{ $myJobLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobActiveLastYear }}
                                                                @else
                                                                    {{ $myJobActiveLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobRejectLastYear }}
                                                                @else
                                                                    {{ $myJobRejectLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $JobPendingLastYear }}
                                                                @else
                                                                    {{ $myJobPendingLastYear }}
                                                                @endif
                                                            </h3>
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
                        </div>
                        <div class="tab-pane" id="schemez">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Today</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Schemetoday }}
                                                                @else
                                                                    {{ $mySchemetoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActivetoday }}
                                                                @else
                                                                    {{ $mySchemeActivetoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendingtoday }}
                                                                @else
                                                                    {{ $mySchemePendingtoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejecttoday }}
                                                                @else
                                                                    {{ $mySchemeRejecttoday }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Schemeyesterday }}
                                                                @else
                                                                    {{ $mySchemeyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActiveyesterday }}
                                                                @else
                                                                    {{ $mySchemeActiveyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejectyesterday }}
                                                                @else
                                                                    {{ $mySchemeRejectyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendingyesterday }}
                                                                @else
                                                                    {{ $mySchemePendingyesterday }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Schemelastweek }}
                                                                @else
                                                                    {{ $mySchemelastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActivelastweek }}
                                                                @else
                                                                    {{ $mySchemeActivelastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejectlastweek }}
                                                                @else
                                                                    {{ $mySchemeRejectlastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendinglastweek }}
                                                                @else
                                                                    {{ $mySchemePendinglastweek }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeThisweek }}
                                                                @else
                                                                    {{ $mySchemeThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActiveThisweek }}
                                                                @else
                                                                    {{ $mySchemeActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejectThisweek }}
                                                                @else
                                                                    {{ $mySchemeRejectThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendingThisweek }}
                                                                @else
                                                                    {{ $mySchemePendingThisweek }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeThisMonth }} @else{{ $mySchemeThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActiveThisweek }}
                                                                @else
                                                                    {{ $mySchemeActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejectThisMonth }}
                                                                @else
                                                                    {{ $mySchemeRejectThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendingThisMonth }}
                                                                @else
                                                                    {{ $mySchemePendingThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeLastMonth }}
                                                                @else
                                                                    {{ $mySchemeLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActiveLastMonth }}
                                                                @else
                                                                    {{ $mySchemeActiveLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejectLastMonth }}
                                                                @else
                                                                    {{ $mySchemeRejectLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendingLastMonth }}
                                                                @else
                                                                    {{ $mySchemePendingLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeThisYear }}
                                                                @else
                                                                    {{ $mySchemeThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActiveThisYear }}
                                                                @else
                                                                    {{ $mySchemeActiveThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejectThisYear }}
                                                                @else
                                                                    {{ $mySchemeRejectThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendingThisYear }}
                                                                @else
                                                                    {{ $mySchemePendingThisYear }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeLastYear }}
                                                                @else
                                                                    {{ $mySchemeLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeActiveLastYear }}
                                                                @else
                                                                    {{ $mySchemeActiveLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemeRejectLastYear }}
                                                                @else
                                                                    {{ $mySchemeRejectLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SchemePendingLastYear }}
                                                                @else
                                                                    {{ $mySchemePendingLastYear }}
                                                                @endif
                                                            </h3>
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
                        </div>
                        <div class="tab-pane" id="rapexz">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Today</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Rapextoday }}
                                                                @else
                                                                    {{ $myRapextoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActivetoday }}
                                                                @else
                                                                    {{ $myRapexActivetoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendingtoday }}
                                                                @else
                                                                    {{ $myRapexPendingtoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejecttoday }}
                                                                @else
                                                                    {{ $myRapexRejecttoday }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Rapexyesterday }}
                                                                @else
                                                                    {{ $myRapexyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActiveyesterday }}
                                                                @else
                                                                    {{ $myRapexActiveyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejectyesterday }}
                                                                @else
                                                                    {{ $myRapexRejectyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendingyesterday }}
                                                                @else
                                                                    {{ $myRapexPendingyesterday }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $Rapexlastweek }}
                                                                @else
                                                                    {{ $myRapexlastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActivelastweek }}
                                                                @else
                                                                    {{ $myRapexActivelastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejectlastweek }}
                                                                @else
                                                                    {{ $myRapexRejectlastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendinglastweek }}
                                                                @else
                                                                    {{ $myRapexPendinglastweek }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexThisweek }}
                                                                @else
                                                                    {{ $myRapexThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActiveThisweek }}
                                                                @else
                                                                    {{ $myRapexActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejectThisweek }}
                                                                @else
                                                                    {{ $myRapexRejectThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendingThisweek }}
                                                                @else
                                                                    {{ $myRapexPendingThisweek }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexThisMonth }} @else{{ $myRapexThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActiveThisweek }}
                                                                @else
                                                                    {{ $myRapexActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejectThisMonth }}
                                                                @else
                                                                    {{ $myRapexRejectThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendingThisMonth }}
                                                                @else
                                                                    {{ $myRapexPendingThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexLastMonth }}
                                                                @else
                                                                    {{ $myRapexLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActiveLastMonth }}
                                                                @else
                                                                    {{ $myRapexActiveLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejectLastMonth }}
                                                                @else
                                                                    {{ $myRapexRejectLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendingLastMonth }}
                                                                @else
                                                                    {{ $myRapexPendingLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexThisYear }}
                                                                @else
                                                                    {{ $myRapexThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActiveThisYear }}
                                                                @else
                                                                    {{ $myRapexActiveThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejectThisYear }}
                                                                @else
                                                                    {{ $myRapexRejectThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendingThisYear }}
                                                                @else
                                                                    {{ $myRapexPendingThisYear }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexLastYear }}
                                                                @else
                                                                    {{ $myRapexLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexActiveLastYear }}
                                                                @else
                                                                    {{ $myRapexActiveLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexRejectLastYear }}
                                                                @else
                                                                    {{ $myRapexRejectLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $RapexPendingLastYear }}
                                                                @else
                                                                    {{ $myRapexPendingLastYear }}
                                                                @endif
                                                            </h3>
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
                        </div>

                        <div class="tab-pane" id="serviceuganda">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Today</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="card-refresh"
                                                    data-source="{{ route('user.dashboard') }}"
                                                    data-source-selector="#card-refresh-content"
                                                    data-load-on-init="false">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUtoday }}
                                                                @else
                                                                    {{ $mySUtoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActivetoday }}
                                                                @else
                                                                    {{ $mySUActivetoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendingtoday }}
                                                                @else
                                                                    {{ $mySUPendingtoday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejecttoday }}
                                                                @else
                                                                    {{ $mySURejecttoday }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUyesterday }}
                                                                @else
                                                                    {{ $mySUyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActiveyesterday }}
                                                                @else
                                                                    {{ $mySUActiveyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejectyesterday }}
                                                                @else
                                                                    {{ $mySURejectyesterday }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendingyesterday }}
                                                                @else
                                                                    {{ $mySUPendingyesterday }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUlastweek }}
                                                                @else
                                                                    {{ $mySUlastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActivelastweek }}
                                                                @else
                                                                    {{ $mySUActivelastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejectlastweek }}
                                                                @else
                                                                    {{ $mySURejectlastweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendinglastweek }}
                                                                @else
                                                                    {{ $mySUPendinglastweek }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUThisweek }}
                                                                @else
                                                                    {{ $mySUThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActiveThisweek }}
                                                                @else
                                                                    {{ $mySUActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejectThisweek }}
                                                                @else
                                                                    {{ $mySURejectThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendingThisweek }}
                                                                @else
                                                                    {{ $mySUPendingThisweek }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUThisMonth }} @else{{ $mySUThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActiveThisweek }}
                                                                @else
                                                                    {{ $mySUActiveThisweek }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejectThisMonth }}
                                                                @else
                                                                    {{ $mySURejectThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendingThisMonth }}
                                                                @else
                                                                    {{ $mySUPendingThisMonth }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SULastMonth }}
                                                                @else
                                                                    {{ $mySULastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActiveLastMonth }}
                                                                @else
                                                                    {{ $mySUActiveLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejectLastMonth }}
                                                                @else
                                                                    {{ $mySURejectLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendingLastMonth }}
                                                                @else
                                                                    {{ $mySUPendingLastMonth }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUThisYear }}
                                                                @else
                                                                    {{ $mySUThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActiveThisYear }}
                                                                @else
                                                                    {{ $mySUActiveThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejectThisYear }}
                                                                @else
                                                                    {{ $mySURejectThisYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendingThisYear }}
                                                                @else
                                                                    {{ $mySUPendingThisYear }}
                                                                @endif
                                                            </h3>
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
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="maximize">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse">
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SULastYear }}
                                                                @else
                                                                    {{ $mySULastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUActiveLastYear }}
                                                                @else
                                                                    {{ $mySUActiveLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SURejectLastYear }}
                                                                @else
                                                                    {{ $mySURejectLastYear }}
                                                                @endif
                                                            </h3>
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
                                                            <h3>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    {{ $SUPendingLastYear }}
                                                                @else
                                                                    {{ $mySUPendingLastYear }}
                                                                @endif
                                                            </h3>
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
