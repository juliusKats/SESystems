@extends('NEW.AUTH.layout')
@section('page_title')Job Description @endsection
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Jobs Documents</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
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
                    <a href="{{ route('job.file.create') }}" class="btn btn-primary float float-right mt-3 mr-3">UPLOAD
                        DOCUMENTS</a>
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#approved" data-toggle="tab">Approved</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pending" data-toggle="tab">Pending</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rejected" data-toggle="tab">Rejected</a></li>
                        <li class="nav-item"><a class="nav-link" href="#trashed" data-toggle="tab">Deleted</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="approved">
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">


                                            <div class="card-body">
                                                <table id="activeadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:200px">Carder Name(s)</th>
                                                            <th style="width:200px">File Attached</th>
                                                            <th style="width:200px">PS PDF File</th>
                                                            <th style="width:200px">Added By</th>
                                                            <th style="width:70px">Approved On </th>
                                                            <th style="width:40px">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allactives as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');
                                                            $adminapproval = Carbon\Carbon::parse($item->ADMINApproval)->format('M d, Y');
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" title="View job description"
                                                                        class="text-capitalize">
                                                                        <?php $carders = explode(',', $item->CarderName);
                                                                        ?>
                                                                        @foreach ($carders as $carder)
                                                                            <span>{{ $carder }}<br></span>
                                                                        @endforeach

                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $extname = $item->ext;
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDPDF/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDPDF' . $item->EXCEL);
                                                                        } else {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDDOC/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDDOC' . $item->EXCEL);
                                                                        }
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $item->finalEXCEL }}"
                                                                            target="_blank">
                                                                            @if ($item->ext == 'pdf')
                                                                                <i style="color: red; font-size: 25px;"
                                                                                    class="fas fa-file-pdf"></i>
                                                                            @else
                                                                                <i style="color: blue; font-size: 25px;"
                                                                                    class="fas fa-file-word"></i>
                                                                            @endif
                                                                            {{ $finalEXCEL }}
                                                                            &nbsp;&nbsp; -{{ $EXCELsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        $PDFsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));

                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif<br>
                                                                    Approved On: {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->sname)
                                                                        <a style=" font-weight: bold;"
                                                                            href="#">{{ $item->fname }}
                                                                            {{ $item->sname }}</a>
                                                                        <br> {{ $upload }}
                                                                    @endif
                                                                <td>{{ $adminapproval }}</td>
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
                                                                            @if (Auth::user()->id == $item->UploadedBy)
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                            @endif
                                                                            <form method="post"
                                                                                action="{{ route('job.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Deactivate?">
                                                                            </form>
                                                                             <a href="{{ route('job.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>

                                                                            <form method="post"
                                                                                action="{{ route('job.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Delete">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('job.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1">
                                                                                    Permanent Delete
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                            @else
                                <div class="row"> User Approve</div>
                            @endif
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
                                                            <th>Carder Name(s)</th>
                                                            <th>File Attached</th>
                                                            <th>PS PDF File</th>
                                                            <th>PS Date</th>
                                                            <th>Added By</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allpending as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');
                                                            $adminapproval = Carbon\Carbon::parse($item->ADMINApproval)->format('M d, Y');
                                                            ?>
                                                            <tr style=" align-items: self-start;">
                                                                <td>
                                                                    <a href="#" title="View job description"
                                                                        class="text-capitalize">
                                                                        <?php $carders = explode(',', $item->CarderName);
                                                                        ?>
                                                                        @foreach ($carders as $carder)
                                                                            <span>{{ $carder }}<br></span>
                                                                        @endforeach

                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $extname = $item->ext;
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDPDF/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDPDF' . $item->EXCEL);
                                                                        } else {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDDOC/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDDOC' . $item->EXCEL);
                                                                        }
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $item->finalEXCEL }}"
                                                                            target="_blank">
                                                                            @if ($item->ext == 'pdf')
                                                                                <i style="color: red; font-size: 25px;"
                                                                                    class="fas fa-file-pdf"></i>
                                                                            @else
                                                                                <i style="color: blue; font-size: 25px;"
                                                                                    class="fas fa-file-word"></i>
                                                                            @endif
                                                                            {{ $finalEXCEL }}
                                                                            &nbsp;&nbsp; -{{ $EXCELsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        $PDFsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));

                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->sname)
                                                                        <a style=" font-weight: bold;"
                                                                            href="#">{{ $item->fname }}
                                                                            {{ $item->sname }}</a>
                                                                        <br> {{ $upload }}
                                                                    @endif
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
                                                                            @if (Auth::user()->id == $item->UploadedBy)
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                            @endif
                                                                            <form method="post"
                                                                                action="{{ route('job.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn btn-sm ml-4 mt-2 btn-success"
                                                                                    value="Approve?">
                                                                            </form>
                                                                             <a href="{{ route('job.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>

                                                                            <form method="post"
                                                                                action="{{ route('job.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Delete">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('job.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.jobs', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1">
                                                                                    Permanent Delete
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            @else
                                <div class="row"> Pending User</div>
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
                                                            <th>Carder Name(s)</th>
                                                            <th>File Attached</th>
                                                            <th>PS PDF File</th>
                                                            <th>PS Date</th>
                                                            <th>Added By</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allrejected as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');
                                                            $adminapproval = Carbon\Carbon::parse($item->ADMINApproval)->format('M d, Y');
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" title="View job description"
                                                                        class="text-capitalize">
                                                                        <?php $carders = explode(',', $item->CarderName);
                                                                        ?>
                                                                        @foreach ($carders as $carder)
                                                                            <span>{{ $carder }}<br></span>
                                                                        @endforeach
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $extname = $item->ext;
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDPDF/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDPDF' . $item->EXCEL);
                                                                        } else {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDDOC/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDDOC' . $item->EXCEL);
                                                                        }
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $item->finalEXCEL }}"
                                                                            target="_blank">
                                                                            @if ($item->ext == 'pdf')
                                                                                <i style="color: red; font-size: 25px;"
                                                                                    class="fas fa-file-pdf"></i>
                                                                            @else
                                                                                <i style="color: blue; font-size: 25px;"
                                                                                    class="fas fa-file-word"></i>
                                                                            @endif
                                                                            {{ $finalEXCEL }}
                                                                            &nbsp;&nbsp; -{{ $EXCELsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        $PDFsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));

                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->sname)
                                                                        <a style=" font-weight: bold;"
                                                                            href="#">{{ $item->fname }}
                                                                            {{ $item->sname }}</a>
                                                                        <br> {{ $upload }}
                                                                    @endif
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
                                                                            @if (Auth::user()->id == $item->UploadedBy)
                                                                                <a href="#"
                                                                                    class="ml-4 btn btn-sm btn-primary mt-1"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                            @endif
                                                                            <form method="post"
                                                                                action="{{ route('job.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Deactivate?">
                                                                            </form>
                                                                             <a href="{{ route('job.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>

                                                                            <form method="post"
                                                                                action="{{ route('job.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Delete">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('job.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.jobs', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1">
                                                                                    Permanent Delete
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            @else
                                <div class="row"> Pending User</div>
                            @endif
                        </div>
                        <div class="tab-pane" id="trashed">
                            @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin' || Auth::user()->role == 'ps')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="trashedadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Carder Name(s)</th>
                                                            <th>File Attached</th>
                                                            <th>PS PDF File</th>
                                                            <th>PS Date</th>
                                                            <th>Added By</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($alldeleted as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');
                                                            $adminapproval = Carbon\Carbon::parse($item->ADMINApproval)->format('M d, Y');
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" title="View job description"
                                                                        class="text-capitalize">
                                                                        <?php $carders = explode(',', $item->CarderName);
                                                                        ?>
                                                                        @foreach ($carders as $carder)
                                                                            <span>{{ $carder }}<br></span>
                                                                        @endforeach
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $extname = $item->ext;
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDPDF/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDPDF' . $item->EXCEL);
                                                                        } else {
                                                                            $EXCELsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/JDDOC/' . $item->EXCEL));
                                                                            $EXCELext = File::extension('storage/Jobs/' . $Yr . '/' . $Month . '/' . '/JDDOC' . $item->EXCEL);
                                                                        }
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $item->finalEXCEL }}"
                                                                            target="_blank">
                                                                            @if ($item->ext == 'pdf')
                                                                                <i style="color: red; font-size: 25px;"
                                                                                    class="fas fa-file-pdf"></i>&nbsp;&nbsp;
                                                                            @else
                                                                                <i style="color: blue; font-size: 25px;"
                                                                                    class="fas fa-file-word"></i>&nbsp;&nbsp;
                                                                            @endif
                                                                            {{ $finalEXCEL }}
                                                                            &nbsp;&nbsp; -{{ $EXCELsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        $PDFsize = Number::fileSize(File::size('storage/Jobs/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));

                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>&nbsp;&nbsp;{{ $finalPDF }}
                                                                            &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>

                                                                    @endif<br>
                                                                    Approved On: {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->sname)
                                                                        <a style=" font-weight: bold;"
                                                                            href="#">{{ $item->fname }}
                                                                            {{ $item->sname }}</a>
                                                                        <br> {{ $upload }}
                                                                    @endif
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
                                                                            <form method="post"
                                                                                action="{{ route('job.restore', $item->id) }}">
                                                                                @csrf
                                                                                <input type="submit"
                                                                                    class="btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Restore">
                                                                            </form>

                                                                            <form method="post"
                                                                                action="{{ route('delete.jobs', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Permanent Delete">
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            @else
                                <div class="row"> Pending User</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>



@endsection
@section('scripts')
