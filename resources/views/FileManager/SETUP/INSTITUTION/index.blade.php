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
            <div class="card">
                  @if (session('success'))
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
                @endif
                <div class="card-header p-2">
                    <a href="#" class="btn btn-success float float-right">Add Institution</a>
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
                                            <table id="rapex" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Line Ministry</th>
                                                        <th>Institution</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($instituteActive as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>
                                                                <a href="#">{{ $item->entityName }}</a>
                                                            </td>
                                                            <td>{{ $item->institution }}</td>
                                                            <td>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    <form method="post"
                                                                        action="{{ route('institute.activate', $item->id) }}">
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
                                                        <th>Line Ministry</th>
                                                        <th>Institution Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($instituteInactive as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>
                                                                <a href="#">{{ $item->entityName }}</a>
                                                            </td>
                                                            <td>{{ $item->institution }}</td>
                                                            <td>
                                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                                                                    <form method="post"
                                                                        action="{{ route('institute.activate', $item->id) }}">
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

    </section>



@endsection
@section('scripts')
