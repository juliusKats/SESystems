@extends('NEW.AUTH.layout')
@section('page_title')Votes @endsection
@section('content')

 <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Votes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Votes</li>
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
                    <a href="{{ route('vote.create') }}" class="btn btn-primary float float-right">Add Vote</a>
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
                                            <table id="establishment"
                                                class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center"> #</th>
                                                        <th>Vote Code</th>
                                                        <th>Vote Name</th>
                                                        <th>Active</th>
                                                        <th>Create On</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($activevotes as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $item->votecode }}</td>
                                                            <td>{{ $item->votename }}</td>
                                                            <td>
                                                                @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                                                    <form method="post"
                                                                        action="{{ route('vote.active', $item->id) }}">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <input type="submit"
                                                                            class="btn @if ($item->Active == 1) btn-success @else btn-danger @endif"
                                                                            value=" @if ($item->Active == 1) Active @else In-Active @endif">
                                                                    </form>
                                                                @else
                                                                    <button
                                                                        class="btn @if ($item->Active == 1) btn-success @else btn-danger @endif">
                                                                        @if ($item->Active == 1)
                                                                            Active
                                                                        @else
                                                                            In-Active
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>{{ $item->created_at->format('M, d Y') }}</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-4">
                                                                        <a href="" class="btn btn-primary">Edit</a>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <form method="post"
                                                                            action="{{ route('vote.delete', $item->id) }}">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <input style="display: inline" type="submit"
                                                                                class="btn btn-danger mt-1" value="Delete">
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-md-2"></div>
                                                                </div>

                                                                {{-- <a href="" class="btn btn-danger">Delete</a> --}}

                                                            </td>
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
                                                <th class="text-center"> #</th>
                                                <th>Vote Code</th>
                                                <th>Vote Name</th>
                                                <th>Active</th>
                                                <th>Create On</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inactivevotes as $key => $item)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $item->votecode }}</td>
                                                    <td>{{ $item->votename }}</td>
                                                    <td>
                                                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                                            <form method="post"
                                                                action="{{ route('vote.active', $item->id) }}">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="submit"
                                                                    class="btn @if ($item->Active == 1) btn-success @else btn-danger @endif"
                                                                    value=" @if ($item->Active == 1) Active @else In-Active @endif">
                                                            </form>
                                                        @else
                                                            <button
                                                                class="btn @if ($item->Active == 1) btn-success @else btn-danger @endif">
                                                                @if ($item->Active == 1)
                                                                    Active
                                                                @else
                                                                    In-Active
                                                                @endif
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->created_at->format('M, d Y') }}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-2"></div>
                                                            <div class="col-md-4">
                                                                <a href="" class="btn btn-primary">Edit</a>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <form method="post"
                                                                    action="{{ route('vote.delete', $item->id) }}">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <input style="display: inline" type="submit"
                                                                        class="btn btn-danger mt-1" value="Delete">
                                                                </form>
                                                            </div>
                                                            <div class="col-md-2"></div>
                                                        </div>
                                                    </td>
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
