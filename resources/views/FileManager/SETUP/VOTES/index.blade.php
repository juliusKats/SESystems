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
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Votes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
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
                    <div class="row">
                        <div class="col-md-9">
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
                                                                    <td>{{ $item->created_at->format('M, d Y') }}</td>
                                                                    <td>
                                                                        <div class="dropdown mt-1 btn-sm">
                                                                            <button
                                                                                class="btn btn-danger btn-sm dropdown-toggle"
                                                                                href="#" role="button"
                                                                                data-toggle="dropdown" arial-haspopup="true"
                                                                                arial-expanded="false">
                                                                                Action
                                                                            </button>
                                                                            <div class="dropdown-menu">
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                    Edit
                                                                                </a>

                                                                                @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                                                                    <form method="post"
                                                                                        action="{{ route('vote.active', $item->id) }}">
                                                                                        @method('PUT')
                                                                                        @csrf
                                                                                        <input type="submit"
                                                                                            class="btn ml-4 mt-1 btn-sm @if ($item->Active == 1) btn-success @else btn-danger @endif"
                                                                                            value=" @if ($item->Active == 1) Active @else In-Active @endif">
                                                                                    </form>
                                                                                @else
                                                                                    <button
                                                                                        class="btn ml-4 mt-1 btn-sm @if ($item->Active == 1) btn-success @else btn-danger @endif">
                                                                                        @if ($item->Active == 1)
                                                                                            Active
                                                                                        @else
                                                                                            In-Active
                                                                                        @endif
                                                                                    </button>
                                                                                @endif

                                                                                <form method="post"
                                                                                    action="{{ route('vote.delete', $item->id) }}">
                                                                                    @method('DELETE')
                                                                                    @csrf
                                                                                    <input style="display: inline"
                                                                                        type="submit"
                                                                                        class="btn btn-danger ml-4 btn-sm mt-1"
                                                                                        value="Trash">
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
                                                                    <td>{{ $item->created_at->format('M, d Y') }}</td>
                                                                    <td>
                                                                        <div class="dropdown mt-1 btn-sm">
                                                                            <button
                                                                                class="btn btn-danger btn-sm dropdown-toggle"
                                                                                href="#" role="button"
                                                                                data-toggle="dropdown" arial-haspopup="true"
                                                                                arial-expanded="false">
                                                                                Action
                                                                            </button>
                                                                            <div class="dropdown-menu">
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                    Edit
                                                                                </a>

                                                                                @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                                                                    <form method="post"
                                                                                        action="{{ route('vote.active', $item->id) }}">
                                                                                        @method('PUT')
                                                                                        @csrf
                                                                                        <input type="submit"
                                                                                            class="btn ml-4 mt-1 btn-sm @if ($item->Active == 1) btn-success @else btn-danger @endif"
                                                                                            value=" @if ($item->Active == 1) Active @else In-Active @endif">
                                                                                    </form>
                                                                                @else
                                                                                    <button
                                                                                        class="btn ml-4 mt-1 btn-sm @if ($item->Active == 1) btn-success @else btn-danger @endif">
                                                                                        @if ($item->Active == 1)
                                                                                            Active
                                                                                        @else
                                                                                            In-Active
                                                                                        @endif
                                                                                    </button>
                                                                                @endif

                                                                                <form method="post"
                                                                                    action="{{ route('vote.delete', $item->id) }}">
                                                                                    @method('DELETE')
                                                                                    @csrf
                                                                                    <input style="display: inline"
                                                                                        type="submit"
                                                                                        class="btn btn-danger ml-4 btn-sm mt-1"
                                                                                        value="Trash">
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('vote.store') }}">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <label>Vote Code</label>
                                            <input type="text"
                                                class="form-control @error('votecode') is-invalid @enderror" required
                                                name="votecode" minlength="3" maxlength="3"
                                                value="{{ old('votecode') }}">
                                            @error('votecode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Vote Name</label>
                                            <input type="text"
                                                class="form-control @error('votename') is-invalid @enderror" required
                                                name="votename" maxlength="50" value="{{ old('votename') }}">
                                            @error('votename')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group row mt-2">
                                            <div class="col-sm-6 col-md-6">
                                                <input checked required name="status" type="radio"
                                                    style="width:18px; height:18px;" value="1"> &nbsp; &nbsp;<label
                                                    style="font-size: 14px; font-weight: bolder;">Active</label>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <input required name="status" type="radio"
                                                    style="width:18px; height:18px;" value="0"> &nbsp; &nbsp; <label
                                                    style="font-size: 14px; font-weight: bolder;">Disabled</label>
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="submit" class="btn btn-primary" value="Upload">
                                        </div>
                                    </form>
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
