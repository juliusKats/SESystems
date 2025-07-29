@extends('NEW.AUTH.layout')
@section('page_title')Service Uganda @endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Service Uganda Documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Service Uganda</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">
                    <a href="{{ route('su.file.create') }}" class="btn btn-primary float float-right mt-3 mr-3">UPLOAD
                        DOCUMENTS</a>
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#approved" data-toggle="tab">Approved</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pending" data-toggle="tab">Pending</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rejected" data-toggle="tab">Rejected</a></li>
                        <li class="nav-item"><a class="nav-link" href="#deleted" data-toggle="tab">Deleted</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="approved">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="activeadmin"
                                                class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Service Centers</th>
                                                        <th>Files</th>
                                                        <th>Upload Info</th>
                                                        <th>Action On</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   @foreach ($allactive as $key => $item)
                                                        <tr>
                                                            <td>
                                                                <div class="card card-primary">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title">Line Ministries</h3>

                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool"
                                                                                data-card-widget="collapse">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <?php
                                                                        $entities = explode(',', $item->SUCenter);
                                                                        ?>
                                                                        @foreach ($entities as $SUCenter)
                                                                            <i class="fa fa-check-circle text-success"></i>
                                                                            {{ $SUCenter }}<br>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="card card-primary">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title">Uploaded Files</h3>

                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool"
                                                                                data-card-widget="collapse">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        @if ($item->file != '' or ($item->file = null))
                                                                            @foreach (explode(',', $item->file) as $file)
                                                                                <?php
                                                                                $Yr = explode('_', $file)[2];
                                                                                $Month = explode('_', $file)[1];
                                                                                $size = Number::fileSize(File::size('storage/SU/' . $Yr . '/' . $Month . '/' . $file));
                                                                                $ext = File::extension('storage/SU/' . $Yr . '/' . $Month . '/' . $file);
                                                                                $finalfile = explode('_', $file)[4];

                                                                                ?>
                                                                                @if ($ext == 'xls' or $ext == 'xlsx')
                                                                                    <i style="color: green; font-size: 20px;"
                                                                                        class="fas fa-file-word"></i>
                                                                                @elseif ($ext == 'doc' or $ext == 'docx')
                                                                                    <i style="color: blue; font-size: 20px;"
                                                                                        class="fas fa-file-word"></i>
                                                                                @elseif ($ext == 'pps' or $ext == 'ppt' or $ext == 'pptx')
                                                                                    <i style="color: rgb(231, 99, 99); font-size: 20px;"
                                                                                        class="fas fa-file-word"></i>
                                                                                @else
                                                                                    <i style="color: red; font-size: 20px;"
                                                                                        class="far fa-file-pdf"></i>
                                                                                @endif
                                                                                <a href="#">{{ $finalfile }}
                                                                                </a><span class="float float-right">
                                                                                    {{ $size }}</span> <br>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $uploaded = Carbon\Carbon::parse($item->created_at)->format('M, d Y');
                                                                ?>
                                                                Data: {{ $uploaded }}<br>
                                                                By:<a
                                                                    href="#">{{ $item->fname }}&nbsp;{{ $item->sname }}</a>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown mt-1 btn-sm">
                                                                    <button class="btn btn-danger btn-sm dropdown-toggle"
                                                                        href="#" role="button"
                                                                        data-toggle="dropdown" arial-haspopup="true"
                                                                        arial-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <div>
                                                                            <a href="#"
                                                                                class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                        </div>
                                                                        @if (Auth::user()->id == $item->UploadedBy && $item->statusName != 'Active')
                                                                            <div>
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                    <i class="fa fa-edit"></i>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                        @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                                                            <a
                                                                                href="#"class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            <form method="post" action="#">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Trash">
                                                                            </form>
                                                                            <form method="post" action="#">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-delete btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Delete">
                                                                            </form>
                                                                        @endif

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
                       <div class="tab-pane" id="pending">
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="pendingadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Service Centers</th>
                                                            <th>Files</th>
                                                            <th>Upload Info</th>
                                                            <th>Action On</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allpending as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Line Ministries</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <?php
                                                                            $entities = explode(',', $item->SUCenter);
                                                                            ?>
                                                                            @foreach ($entities as $SUCenter)
                                                                                <i
                                                                                    class="fa fa-check-circle text-success"></i>
                                                                                {{ $SUCenter }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Uploaded Files</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if ($item->file != '' or ($item->file = null))
                                                                                @foreach (explode(',', $item->file) as $file)
                                                                                    <?php
                                                                                    $Yr = explode('_', $file)[2];
                                                                                    $Month = explode('_', $file)[1];
                                                                                    $size = Number::fileSize(File::size('storage/SU/' . $Yr . '/' . $Month . '/' . $file));
                                                                                    $ext = File::extension('storage/SU/' . $Yr . '/' . $Month . '/' . $file);
                                                                                    $finalfile = explode('_', $file)[4];

                                                                                    ?>
                                                                                    @if ($ext == 'xls' or $ext == 'xlsx')
                                                                                        <i style="color: green; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'doc' or $ext == 'docx')
                                                                                        <i style="color: blue; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'pps' or $ext == 'ppt' or $ext == 'pptx')
                                                                                        <i style="color: rgb(231, 99, 99); font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @else
                                                                                        <i style="color: red; font-size: 20px;"
                                                                                            class="far fa-file-pdf"></i>
                                                                                    @endif
                                                                                    <a href="#">{{ $finalfile }}
                                                                                    </a><span class="float float-right">
                                                                                        {{ $size }}</span> <br>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $uploaded = Carbon\Carbon::parse($item->created_at)->format('M, d Y');
                                                                    ?>
                                                                    Data: {{ $uploaded }}<br>
                                                                    By:<a
                                                                        href="#">{{ $item->fname }}&nbsp;{{ $item->sname }}</a>
                                                                </td>
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
                                                                            <div>
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                            </div>
                                                                            @if (Auth::user()->id == $item->UploadedBy && $item->statusName != 'Active')
                                                                                <div>
                                                                                    <a href="#"
                                                                                        class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                                                                <a
                                                                                    href="#"class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                                <form method="post" action="#">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input type="submit"
                                                                                        class="btn-softdelete btn btn-sm ml-4 mt-2 btn-default"
                                                                                        value="Trash">
                                                                                </form>
                                                                                <form method="post" action="#">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <input type="submit"
                                                                                        class="btn-delete btn btn-sm ml-4 mt-2 btn-default"
                                                                                        value="Delete">
                                                                                </form>
                                                                            @endif
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
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="pendinguser"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Service Centers</th>
                                                            <th>Files</th>
                                                            <th>Upload Info</th>
                                                            <th>Action On</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mypending as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Line Ministries</h3>
                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <?php
                                                                            $entities = explode(',', $item->SUCenter);
                                                                            ?>
                                                                            @foreach ($entities as $SUCenter)
                                                                                <i
                                                                                    class="fa fa-check-circle text-success"></i>
                                                                                {{ $SUCenter }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Uploaded Files</h3>
                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if ($item->file != '' or ($item->file = null))
                                                                                @foreach (explode(',', $item->file) as $file)
                                                                                    <?php
                                                                                    $Yr = explode('_', $file)[2];
                                                                                    $Month = explode('_', $file)[1];
                                                                                    $size = Number::fileSize(File::size('storage/SU/' . $Yr . '/' . $Month . '/' . $file));
                                                                                    $ext = File::extension('storage/SU/' . $Yr . '/' . $Month . '/' . $file);
                                                                                    $finalfile = explode('_', $file)[4];

                                                                                    ?>
                                                                                    @if ($ext == 'xls' or $ext == 'xlsx')
                                                                                        <i style="color: green; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'doc' or $ext == 'docx')
                                                                                        <i style="color: blue; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'pps' or $ext == 'ppt' or $ext == 'pptx')
                                                                                        <i style="color: rgb(231, 99, 99); font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @else
                                                                                        <i style="color: red; font-size: 20px;"
                                                                                            class="far fa-file-pdf"></i>
                                                                                    @endif
                                                                                    <a href="#">{{ $finalfile }}
                                                                                    </a><span class="float float-right">
                                                                                        {{ $size }}</span> <br>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $uploaded = Carbon\Carbon::parse($item->created_at)->format('M, d Y');
                                                                    ?>
                                                                    Data: {{ $uploaded }}<br>
                                                                    By:<a
                                                                        href="#">{{ $item->fname }}&nbsp;{{ $item->sname }}</a>
                                                                </td>
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
                                                                            <div>
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                            </div>
                                                                            @if (Auth::user()->id == $item->UploadedBy && $item->statusName != 'Active')
                                                                                <div>
                                                                                    <a href="#"
                                                                                        class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </a>
                                                                                    <form method="post" action="#">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <input type="submit"
                                                                                            class="btn-softdelete btn btn-sm ml-4 mt-2 btn-default"
                                                                                            value="Trash">
                                                                                    </form>
                                                                                    <form method="post" action="#">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <input type="submit"
                                                                                            class="btn-delete btn btn-sm ml-4 mt-2 btn-default"
                                                                                            value="Delete">
                                                                                    </form>
                                                                                </div>
                                                                            @endif
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
                            @endif
                        </div>
                          <div class="tab-pane" id="rejected">
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="rejectadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Service Centers</th>
                                                            <th>Files</th>
                                                            <th>Upload Info</th>
                                                            <th>Action On</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allrejected as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Line Ministries</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <?php
                                                                            $entities = explode(',', $item->SUCenter);
                                                                            ?>
                                                                            @foreach ($entities as $SUCenter)
                                                                                <i
                                                                                    class="fa fa-check-circle text-success"></i>
                                                                                {{ $SUCenter }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Uploaded Files</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if ($item->file != '' or ($item->file = null))
                                                                                @foreach (explode(',', $item->file) as $file)
                                                                                    <?php
                                                                                    $Yr = explode('_', $file)[2];
                                                                                    $Month = explode('_', $file)[1];
                                                                                    $size = Number::fileSize(File::size('storage/SU/' . $Yr . '/' . $Month . '/' . $file));
                                                                                    $ext = File::extension('storage/SU/' . $Yr . '/' . $Month . '/' . $file);
                                                                                    $finalfile = explode('_', $file)[4];

                                                                                    ?>
                                                                                    @if ($ext == 'xls' or $ext == 'xlsx')
                                                                                        <i style="color: green; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'doc' or $ext == 'docx')
                                                                                        <i style="color: blue; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'pps' or $ext == 'ppt' or $ext == 'pptx')
                                                                                        <i style="color: rgb(231, 99, 99); font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @else
                                                                                        <i style="color: red; font-size: 20px;"
                                                                                            class="far fa-file-pdf"></i>
                                                                                    @endif
                                                                                    <a href="#">{{ $finalfile }}
                                                                                    </a><span class="float float-right">
                                                                                        {{ $size }}</span> <br>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $uploaded = Carbon\Carbon::parse($item->created_at)->format('M, d Y');
                                                                    ?>
                                                                    Data: {{ $uploaded }}<br>
                                                                    By:<a
                                                                        href="#">{{ $item->fname }}&nbsp;{{ $item->sname }}</a>
                                                                </td>
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
                                                                            <div>
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                            </div>
                                                                            @if (Auth::user()->id == $item->UploadedBy && $item->statusName != 'Active')
                                                                                <div>
                                                                                    <a href="#"
                                                                                        class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                                                                <a
                                                                                    href="#"class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                                <form method="post" action="#">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input type="submit"
                                                                                        class="btn-softdelete btn btn-sm ml-4 mt-2 btn-default"
                                                                                        value="Trash">
                                                                                </form>
                                                                                <form method="post" action="#">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <input type="submit"
                                                                                        class="btn-delete btn btn-sm ml-4 mt-2 btn-default"
                                                                                        value="Delete">
                                                                                </form>
                                                                            @endif
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
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="rejectuser"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Service Centers</th>
                                                            <th>Files</th>
                                                            <th>Upload Info</th>
                                                            <th>Action On</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($myrejected as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Line Ministries</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <?php
                                                                            $entities = explode(',', $item->SUCenter);
                                                                            ?>
                                                                            @foreach ($entities as $SUCenter)
                                                                                <i
                                                                                    class="fa fa-check-circle text-success"></i>
                                                                                {{ $SUCenter }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Uploaded Files</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if ($item->file != '' or ($item->file = null))
                                                                                @foreach (explode(',', $item->file) as $file)
                                                                                    <?php
                                                                                    $Yr = explode('_', $file)[2];
                                                                                    $Month = explode('_', $file)[1];
                                                                                    $size = Number::fileSize(File::size('storage/SU/' . $Yr . '/' . $Month . '/' . $file));
                                                                                    $ext = File::extension('storage/SU/' . $Yr . '/' . $Month . '/' . $file);
                                                                                    $finalfile = explode('_', $file)[4];

                                                                                    ?>
                                                                                    @if ($ext == 'xls' or $ext == 'xlsx')
                                                                                        <i style="color: green; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'doc' or $ext == 'docx')
                                                                                        <i style="color: blue; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @elseif($ext == 'pps' or $ext == 'ppt' or $ext == 'pptx')
                                                                                        <i style="color: rgb(231, 99, 99); font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @else
                                                                                        <i style="color: red; font-size: 20px;"
                                                                                            class="far fa-file-pdf"></i>
                                                                                    @endif
                                                                                    <a href="#">{{ $finalfile }}
                                                                                    </a><span class="float float-right">
                                                                                        {{ $size }}</span> <br>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $uploaded = Carbon\Carbon::parse($item->created_at)->format('M, d Y');
                                                                    ?>
                                                                    Data: {{ $uploaded }}<br>
                                                                    By:<a
                                                                        href="#">{{ $item->fname }}&nbsp;{{ $item->sname }}</a>
                                                                </td>
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
                                                                            <div>
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                            </div>
                                                                            @if (Auth::user()->id == $item->UploadedBy && $item->statusName != 'Active')
                                                                                <div>
                                                                                    <a href="#"
                                                                                        class="ml-4 btn btn-sm btn-primary mt-1">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </a>
                                                                                    <form method="post" action="#">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <input type="submit"
                                                                                            class="btn-softdelete btn btn-sm ml-4 mt-2 btn-default"
                                                                                            value="Trash">
                                                                                    </form>
                                                                                    <form method="post" action="#">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <input type="submit"
                                                                                            class="btn-delete btn btn-sm ml-4 mt-2 btn-default"
                                                                                            value="Delete">
                                                                                    </form>
                                                                                </div>
                                                                            @endif
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
                            @endif
                        </div>
                        <div class="tab-pane" id="deleted">
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="trashedadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Service Centers</th>
                                                            <th>Files</th>
                                                            <th>Upload Info</th>
                                                            <th>Action On</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($alldeleted as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Line Ministries</h3>
                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <?php
                                                                            $entities = explode(',', $item->SUCenter);
                                                                            ?>
                                                                            @foreach ($entities as $SUCenter)
                                                                                <i
                                                                                    class="fa fa-check-circle text-success"></i>
                                                                                {{ $SUCenter }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Uploaded Files</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if ($item->file != '' or ($item->file = null))
                                                                                @foreach (explode(',', $item->file) as $file)
                                                                                    <?php
                                                                                    $Yr = explode('_', $file)[2];
                                                                                    $Month = explode('_', $file)[1];
                                                                                    $size = Number::fileSize(File::size('storage/SU/' . $Yr . '/' . $Month . '/' . $file));
                                                                                    $ext = File::extension('storage/SU/' . $Yr . '/' . $Month . '/' . $file);
                                                                                    $finalfile = explode('_', $file)[4];

                                                                                    ?>
                                                                                    @if ($ext == 'xls' or $ext == 'xlsx')
                                                                                        <i style="color: green; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                        @elseif($ext == 'doc' or $ext == 'docx')
                                                                                        <i style="color: blue; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                        @elseif($ext == 'pps' or $ext == 'ppt' or $ext == 'pptx')
                                                                                        <i style="color: rgb(231, 99, 99); font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @else
                                                                                        <i style="color: red; font-size: 20px;"
                                                                                            class="far fa-file-pdf"></i>
                                                                                    @endif
                                                                                    <a href="#">{{ $finalfile }}
                                                                                    </a><span class="float float-right">
                                                                                        {{ $size }}</span> <br>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $uploaded = Carbon\Carbon::parse($item->created_at)->format('M, d Y');
                                                                    ?>
                                                                    Data: {{ $uploaded }}<br>
                                                                    By:<a
                                                                        href="#">{{ $item->fname }}&nbsp;{{ $item->sname }}</a>
                                                                </td>
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
                                                                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                                                                <a
                                                                                    href="#"class="ml-4 mt-1 btn btn-success btn-sm">ReAprove</a>
                                                                            @endif
                                                                            <form method="post" action="#">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-restore btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Restore">
                                                                            </form>
                                                                            <form method="post" action="#">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-delete btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Delete">
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
                            @else
                            <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="trasheduser"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Service Centers</th>
                                                            <th>Files</th>
                                                            <th>Upload Info</th>
                                                            <th>Action On</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mydeleted as $key => $item)
                                                            <tr>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Line Ministries</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <?php
                                                                            $entities = explode(',', $item->SUCenter);
                                                                            ?>
                                                                            @foreach ($entities as $SUCenter)
                                                                                <i
                                                                                    class="fa fa-check-circle text-success"></i>
                                                                                {{ $SUCenter }}<br>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h3 class="card-title">Uploaded Files</h3>

                                                                            <div class="card-tools">
                                                                                <button type="button"
                                                                                    class="btn btn-tool"
                                                                                    data-card-widget="collapse">
                                                                                    <i class="fas fa-minus"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            @if ($item->file != '' or ($item->file = null))
                                                                                @foreach (explode(',', $item->file) as $file)
                                                                                    <?php
                                                                                    $Yr = explode('_', $file)[2];
                                                                                    $Month = explode('_', $file)[1];
                                                                                    $size = Number::fileSize(File::size('storage/SU/' . $Yr . '/' . $Month . '/' . $file));
                                                                                    $ext = File::extension('storage/SU/' . $Yr . '/' . $Month . '/' . $file);
                                                                                    $finalfile = explode('_', $file)[4];

                                                                                    ?>
                                                                                    @if ($ext == 'xls' or $ext == 'xlsx')
                                                                                        <i style="color: green; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                        @elseif($ext == 'doc' or $ext == 'docx')
                                                                                        <i style="color: blue; font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                        @elseif($ext == 'pps' or $ext == 'ppt' or $ext == 'pptx')
                                                                                        <i style="color: rgb(231, 99, 99); font-size: 20px;"
                                                                                            class="fas fa-file-word"></i>
                                                                                    @else
                                                                                        <i style="color: red; font-size: 20px;"
                                                                                            class="far fa-file-pdf"></i>
                                                                                    @endif
                                                                                    <a href="#">{{ $finalfile }}
                                                                                    </a><span class="float float-right">
                                                                                        {{ $size }}</span> <br>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $uploaded = Carbon\Carbon::parse($item->created_at)->format('M, d Y');
                                                                    ?>
                                                                    Data: {{ $uploaded }}<br>
                                                                    By:<a
                                                                        href="#">{{ $item->fname }}&nbsp;{{ $item->sname }}</a>
                                                                </td>
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
                                                                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                                                                <a
                                                                                    href="#"class="ml-4 mt-1 btn btn-success btn-sm">ReAprove</a>
                                                                            @endif
                                                                            <form method="post" action="#">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Restore">
                                                                            </form>
                                                                            <form method="post" action="#">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Delete">
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
