@extends('NEW.AUTH.layout')
@section('page_title')Add Votes @endsection
@section('content')

 <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ADD VOTE</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('vote.list') }}">Votes</a></li>
                        <li class="breadcrumb-item active">Add Vote</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
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

    </section>



@endsection

@section('scripts')

@endsection
