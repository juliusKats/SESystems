@extends('NEW.AUTH.layout')
@section('page_title')Inquiries @endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Inquiries</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Inquiries</li>
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
                        <li class="nav-item"><a class="nav-link active" href="#active" data-toggle="tab">Unread</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#inactive" data-toggle="tab">Replied</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#trashed" data-toggle="tab">Deleted</a>
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
                                            <table id="rejectadmin" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sender</th>
                                                        <th>Telephone</th>
                                                        <th>Email</th>
                                                        <th>Message</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($unread as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>
                                                                <a href="#">{{ $item->fullname }}</a>
                                                            </td>
                                                            <td>{{ $item->telephone }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ Str::words($item->inquiry, 15) }}</td>
                                                            <td>
                                                                <div class="dropdown mt-1 btn-sm">
                                                                    <button class="btn btn-danger btn-sm dropdown-toggle"
                                                                        href="#" role="button" data-toggle="dropdown"
                                                                        arial-haspopup="true" arial-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                       <a href="{{ route('inquiry.reply',$item->id) }}"
                                                                            class="ml-4 btn btn-sm btn-primary mt-1">
                                                                            Reply
                                                                        </a>
                                                                        <form method="post" action="{{ route('inquiry.soft.delete',$item->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="submit" class="ml-4 mt-1 btn btn-softdelete btn-sm btn-warning" value="Archive">
                                                                        </form>
                                                                        <form method="post" action="{{ route('inquiry.delete',$item->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="submit" class="ml-4 mt-1 btn btn-delete btn-sm btn-danger" value="Delete">
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
                                    <!-- /.card -->
                                </div>

                            </div>

                        </div>
                        <div class="tab-pane" id="inactive">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="activeadmin"
                                                class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sender</th>
                                                        <th>Telephone</th>
                                                        <th>Email</th>
                                                        <th>Response</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($read as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>
                                                                <a href="#">{{ $item->fullname }}</a>
                                                            </td>
                                                            <td>{{ $item->telephone }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ Str::words($item->reply, 15) }}</td>
                                                            <td>
                                                                <div class="dropdown mt-1 btn-sm">
                                                                    <button class="btn btn-danger btn-sm dropdown-toggle"
                                                                        href="#" role="button" data-toggle="dropdown"
                                                                        arial-haspopup="true" arial-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <form method="post" action="{{ route('inquiry.soft.delete',$item->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="submit" class="ml-4 mt-1 btn btn-softdelete btn-sm btn-warning" value="Archive">
                                                                        </form>
                                                                        <form method="post" action="{{ route('inquiry.delete',$item->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="submit" class="ml-4 mt-1 btn btn-delete btn-sm btn-danger" value="Delete">
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
                                    <!-- /.card -->
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="trashed">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="trashedadmin"
                                                class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Sender</th>
                                                        <th>Telephone</th>
                                                        <th>Email</th>
                                                        <th>Inquiry</th>
                                                        <th>Reply</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($deleted as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>
                                                                <a href="#">{{ $item->fullname }}</a>
                                                            </td>
                                                            <td>{{ $item->telephone }}</td>
                                                            <td>{{ $item->email }}</td>
                                                            <td>{{ Str::words($item->inquiry, 15) }}</td>
                                                             <td>{{ Str::words($item->reply, 15) }}</td>
                                                            <td>
                                                                <div class="dropdown mt-1 btn-sm">
                                                                    <button class="btn btn-danger btn-sm dropdown-toggle"
                                                                        href="#" role="button" data-toggle="dropdown"
                                                                        arial-haspopup="true" arial-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <form method="post" action="{{ route('inquiry.delete',$item->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="submit" class="ml-4 mt-1 btn btn-delete btn-sm btn-danger" value="Delete">
                                                                        </form>
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
            </div>
        </div>
    </section>
@endsection
@section('scripts')
