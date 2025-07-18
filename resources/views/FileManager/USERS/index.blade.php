@extends('NEW.AUTH.layout')
{{-- refresh page 60s --}}
@section('meta_tag')
    <meta http-equiv="refresh" content="300">
@endsection
@section('page_title')Users @endsection
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">USER LIST</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Audit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
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

                    <a href="{{ route('add.user') }}" class="btn btn-success float float-right">Add User</a>
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
                            <table id="establishment" class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <td>Photo</td>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Create On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($activeusers as $key => $item)
                                        <tr>
                                            <td>
                                                <img class="rounded-circle profile-widget-picture" alt="{{ $item->name }}"

                                                        @if ($item->profile_photo_path)

                                                         src="{{ url('storage/profile/' . $item->profile_photo_path) }}"
                                                         style="width:100px;height:100px; border-color: blue; border-width: 2px; border-radius: 100%;"


                                                        @else
                                                         src="{{ asset('system/Default/defaultuser.jpg') }}" @endif
                                                    style="width: 70px; height:70px">





                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role }}</td>

                                            <td>
                                                @if (Auth::user()->role == 'superadmin' or Auth::user()->role == 'admin')
                                                    <form method="post" action="{{ route('user.activate', $item->id) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="submit"
                                                            class="btn @if ($item->status == true) btn-success @else btn-danger @endif"
                                                            value=" @if ($item->status == true) Active @else In-Active @endif">
                                                    </form>
                                                @else
                                                    <button
                                                        class="btn  @if ($item->status == true) btn-success @else btn-danger @endif">
                                                        @if ($item->status == true)
                                                            Active
                                                        @else
                                                            In Active
                                                        @endif
                                                    </button>
                                                @endif

                                            </td>
                                            <td>{{ $item->created_at->format('M, d Y') }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="" class="btn btn-primary">Edit</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="post"
                                                            action="{{ route('delete.user', $item->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input style="display: inline" type="submit"
                                                                class="btn btn-danger mt-1" value="Delete">
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                        <div class="tab-pane" id="inactive">
                            <table id="rapex" class="table table-bordered table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <td>Photo</td>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Create On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($inactiveusers as $key => $item)
                                        <tr>
                                            <td>
                                                <img class="rounded-circle profile-widget-picture"
                                                    alt="{{ $item->name }}"
                                                    src="
                                                        @if ($item->profile_photo_path) {{ Storage::url($item->profile_path) }}
                                                        @else
                                                        {{ asset('mops_asset/img/Default/defaultuser.jpg') }} @endif "
                                                    style="width: 70px; height:70px">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role }}</td>

                                            <td>
                                                @if (Auth::user()->role == 'superadmin' or Auth::user()->role == 'admin')
                                                    <form method="post" action="{{ route('user.activate', $item->id) }}">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="submit"
                                                            class="btn @if ($item->status == true) btn-success @else btn-danger @endif"
                                                            value=" @if ($item->status == true) Active @else In-Active @endif">
                                                    </form>
                                                @else
                                                    <button
                                                        class="btn  @if ($item->status == true) btn-success @else btn-danger @endif">
                                                        @if ($item->status == true)
                                                            Active
                                                        @else
                                                            In Active
                                                        @endif
                                                    </button>
                                                @endif

                                            </td>
                                            <td>{{ $item->created_at->format('M, d Y') }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="" class="btn btn-primary">Edit</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form method="post"
                                                            action="{{ route('vote.delete', $item->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input style="display: inline" type="submit"
                                                                class="btn btn-danger mt-1" value="Delete">
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
