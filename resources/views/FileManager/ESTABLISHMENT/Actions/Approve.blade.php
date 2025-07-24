@extends('NEW.AUTH.layout')
@section('page_title')
    Establishment
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Approving Documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Deleting</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-lg-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h4 class="text-center">Approving {{ $file->VoteCode }} {{ $file->VoteName }}</h4>
                        </div>
                        <div class="card-body">
                            Are you Sure you Want to approve <a href="#"> {{ $file->VoteCode }} {{ $file->VoteName }}</a>?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <form method="post" action="{{ route('file.approve', $file->id) }}" style="display: inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-outline-success" data-dismiss="modal">Approve</button>
                            </form>
                            <a href="{{ route('file.list') }}" class="btn btn-outline-primary">Cancel</a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
