@extends('NEW.AUTH.layout')
@section('page_title') Establishment @endsection
@section('content')

 <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Line Ministries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Lines</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                  {{-- @if (session('success'))
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">{{ session('success') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">{{ session('error') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif --}}
                <div class="col-md-9">
                    <div class="card">

                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#active" data-toggle="tab">Active</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#inactive" data-toggle="tab">Inactive</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="active">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">


                                                <div class="card-body">
                                                    <table id="rapex"
                                                        class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Line Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($linesActive as $key => $item)
                                                                <tr>
                                                                    <td>{{ ++$key }}</td>
                                                                    <td>
                                                                        <a href="#">{{ $item->entityName }}</a>
                                                                    </td>
                                                                    <td>
                                                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                            <form method="post"
                                                                                action="{{ route('line.activate', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn @if ($item->status == true) btn-success @else btn-danger @endif"
                                                                                    value="@if ($item->status == true) Approved @else Pending @endif">
                                                                            </form>
                                                                        @else
                                                                        @endif
                                                                    </td>
                                                                    <td>Edit Delete</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane" id="inactive">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">


                                                <div class="card-body">
                                                    <table id="establishment"
                                                        class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Line Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($linesInactive as $key => $item)
                                                                <tr>
                                                                    <td>{{ ++$key }}</td>
                                                                    <td>
                                                                        <a href="#">{{ $item->entityName }}</a>
                                                                    </td>
                                                                    <td>
                                                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                            <form method="post"
                                                                                action="{{ route('line.activate', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn @if ($item->status == true) btn-success @else btn-danger @endif"
                                                                                    value="@if ($item->status == true) Approved @else Pending @endif">
                                                                            </form>
                                                                        @else
                                                                        @endif
                                                                    </td>
                                                                    <td>Edit Delete</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Add New Line Ministry</div>
                        <div class="card-body">
                            <form method="post" action="{{ route('line.ministry.save') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="linename" type="text" class="form-control @error('linename') is-invalid @enderror" required multiple>
                                     @error('linename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>



        </div>

    </section>



@endsection
@section('scripts')
