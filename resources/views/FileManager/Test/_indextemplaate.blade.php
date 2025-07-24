@extends('NEW.AUTH.layout')
@section('page_title') Establishment @endsection
@section('content')

 <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Establishment Documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Establishment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <h3 class="card-title float float-right">
                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3">UPLOAD
                        DOCUMENTS</a>
                </h3>
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#approved" data-toggle="tab">Approved</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pending" data-toggle="tab">Pending</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rejected" data-toggle="tab">Rejected</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="approved">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">


                                        <div class="card-body">
                                            <table id="establishment"
                                                class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Vote Details</th>
                                                        <th>Excel Name</th>
                                                        <th>PDF Name</th>
                                                        <th>PS Approved Date</th>
                                                        <th>Uploaded</th>
                                                        <th>Approved ?</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane" id="pending">Pending</div>
                        <div class="tab-pane" id="rejected">Rejected</div>
                    </div>
                </div>
            </div>



        </div>

    </section>



@endsection
@section('scripts')
