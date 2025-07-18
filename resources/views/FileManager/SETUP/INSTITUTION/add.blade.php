@extends('_FMSLayout.Main.layout')
@section('page_title')
    Add Vote
@endsection
@section('main_content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Adding Vote</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Files</a></div>
                    <div class="breadcrumb-item">Upload</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-2 col-md-1 col-lg-1"></div>
                    <div class="col-10 col-md-10 col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data" action="{{ route('vote.store') }}">
                                    @csrf
                                    <div class="form-group mb-2">
                                        <label>Vote Code</label>
                                        <input type="text" class="form-control @error('votecode') is-invalid @enderror"
                                            required name="votecode" minlength="3" maxlength="3" value="{{ old('votecode') }}">
                                        @error('votecode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-2">
                                        <label>Vote Name</label>
                                        <input type="text" class="form-control @error('votename') is-invalid @enderror"
                                            required name="votename" maxlength="50" value="{{ old('votename') }}">
                                        @error('votename')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row mt-2">
                                        <div class="col-sm-3 col-md-3">
                                            <input checked required name="status" type="radio" style="width:25px; height:25px;" value="1"> &nbsp; &nbsp;<label style="font-size: 18px; font-weight: bolder;">Active</label>
                                        </div>
                                        <div class="col-sm-3 col-md-3">
                                            <input required name="status" type="radio" style="width:25px; height:25px;" value="0"> &nbsp; &nbsp; <label style="font-size: 18px; font-weight: bolder;">In Active</label>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2">
                                        <input type="submit" class="btn btn-primary" value="Upload">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-md-1 col-lg-1"></div>
                </div>
            </div>
        </section>
    </div>
@endsection
