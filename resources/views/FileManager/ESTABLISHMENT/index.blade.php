@extends('NEW.AUTH.layout')
@section('page_title')
    Establishment
@endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Establishment Documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Establishment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">
                    <a href="{{ route('file.create') }}" class="btn btn-success float float-right">UPLOAD DOCUMENTS</a>
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#approved" data-toggle="tab">Approved</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pending" data-toggle="tab">Pending</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rejected" data-toggle="tab">Rejected</a></li>
                        <li class="nav-item"><a class="nav-link" href="#trashed" data-toggle="tab">Recycle Bin</a></li>
                         <li class="nav-item"><a class="nav-link" href="#drafted" data-toggle="tab">Drafts</a></li>
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
                                                            <th>Vote Details</th>
                                                            <th>Excel File</th>
                                                            <th>PDF File</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Uploaded On</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($files as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>
                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->oname)
                                                                        <strong style="color: blue"><a
                                                                                href="#">{{ $item->sname }}
                                                                                {{ $item->fname }}
                                                                                {{ $item->oname }}</a></strong>
                                                                    @else
                                                                        <strong style="color: blue"><a
                                                                                href="#">{{ $item->sname }}
                                                                                {{ $item->fname }}</a></strong>
                                                                    @endif
                                                                    <br>&nbsp; &nbsp; {{ $upload }}
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
                                                                                action="{{ route('file.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn btn-sm ml-4 mt-2 btn-default btn-deactive"
                                                                                    value="Deactivate?">
                                                                            </form>

                                                                            <form method="post"
                                                                                action="{{ route('soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1 btn-softdelete"
                                                                                    value="Delete">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('file.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1 btn-delete">
                                                                                    Permanent Delete
                                                                                </button>
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
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="activeadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Vote Details</th>
                                                            <th>Excel File</th>
                                                            <th>PDF File</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Uploaded On</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($files as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>
                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->oname)
                                                                        <strong style="color: blue"><a
                                                                                href="#">{{ $item->sname }}
                                                                                {{ $item->fname }}
                                                                                {{ $item->oname }}</a></strong>
                                                                    @else
                                                                        <strong style="color: blue"><a
                                                                                href="#">{{ $item->sname }}
                                                                                {{ $item->fname }}</a></strong>
                                                                    @endif
                                                                    <br>&nbsp; &nbsp; {{ $upload }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->status == 'Active')
                                                                        <span class="btn btn-success">Approved</span>
                                                                    @elseif($item->status == 'Reject')
                                                                        <span class="btn btn-warning">Rejected</span>
                                                                    @else
                                                                        <span class="btn btn-danger">Pending</span>
                                                                    @endif
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
                                                            <th>Vote Details</th>
                                                            <th>Excel Name</th>
                                                            <th>PDF Name</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Uploaded</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($pending as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>

                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->sname)
                                                                        <strong style="color: blue"><a
                                                                                href="#">{{ $item->fname }}
                                                                                {{ $item->sname }}
                                                                                {{ $item->oname }}</a></strong>
                                                                        <br>&nbsp; &nbsp; {{ $upload }}
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
                                                                                    class="ml-4 btn btn-sm btn-outline-primary mt-1"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                            @endif

                                                                            <form method="post"
                                                                                action="{{ route('file.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit"
                                                                                    class="btn btn-sm ml-4 btn-outline-success btn-approve mt-1"
                                                                                    data-dismiss="modal">
                                                                                    <i class="fa fa-check-circle"></i></button>
                                                                            </form>
                                                                            <form method="post"
                                                                                action="{{ route('soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-softdelete btn-sm ml-4 mt-1"
                                                                                    value="Delete">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('file.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn btn-danger btn-delete btn-sm ml-4 mt-1">
                                                                                    Permanent Delete
                                                                                </button>
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
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="pendingadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Vote Details</th>
                                                            <th>Excel Name</th>
                                                            <th>PDF Name</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mypending as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->ApprovedOn)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>

                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdffile }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
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
                                                                                action="{{ route('soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Archive">
                                                                            </form>

                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn-delete btn btn-danger btn-sm ml-4 mt-1">
                                                                                    Delete
                                                                                </button>
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
                                                            <th>Vote Details</th>
                                                            <th>Excel Name</th>
                                                            <th>PDF Name</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Uploaded</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($rejected as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>

                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->sname)
                                                                        <strong style="color: blue"><a
                                                                                href="#">{{ $item->fname }}
                                                                                {{ $item->sname }}
                                                                                {{ $item->oname }}</a></strong>
                                                                        <br>&nbsp; &nbsp; {{ $upload }}
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
                                                                                action="{{ route('soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Delete">
                                                                            </form>
                                                                            <form method="post"
                                                                                action="{{ route('file.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-approve btn btn-success btn-sm ml-4 mt-1"
                                                                                    value="ReApprove">
                                                                            </form>


                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('file.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn-delete btn btn-danger btn-sm ml-4 mt-1">
                                                                                    Permanent Delete
                                                                                </button>
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
                            @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="rejectadmin"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Vote Details</th>
                                                            <th>Excel Name</th>
                                                            <th>PDF Name</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($myrejected as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>

                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
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
                                                                                action="{{ route('soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Delete">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('file.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class="btn-delete btn btn-danger btn-sm ml-4 mt-1">
                                                                                    Permanent Delete
                                                                                </button>
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
                                                            <th>Vote Details</th>
                                                            <th>Excel Name</th>
                                                            <th>PDF Name</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Uploaded</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($deleted as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>

                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
                                                                </td>
                                                                <td>
                                                                    @if ($item->sname)
                                                                        <strong style="color: blue"><a
                                                                                href="#">{{ $item->fname }}
                                                                                {{ $item->sname }}
                                                                                {{ $item->oname }}</a></strong>
                                                                        <br>&nbsp; &nbsp; {{ $upload }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (Auth::user()->role == 'admin' or Auth::user()->role == 'superadmin')
                                                                        <div class="dropdown mt-1 btn-sm">
                                                                            <button
                                                                                class="btn btn-danger btn-sm dropdown-toggle"
                                                                                href="#" role="button"
                                                                                data-toggle="dropdown"
                                                                                arial-haspopup="true"
                                                                                arial-expanded="false">
                                                                                Action
                                                                            </button>


                                                                            <div class="dropdown-menu">
                                                                                <form
                                                                                    action="{{ route('vote.restore', $item->id) }}"
                                                                                    method="post"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <button
                                                                                        class="btn-restore ml-4 btn btn-success btn-sm mt-2">
                                                                                        <i
                                                                                            class="fa fa-regular fa-recycle"></i>
                                                                                    </button>
                                                                                </form>
                                                                                <form
                                                                                    action="{{ route('delete.vote', $item->id) }}"
                                                                                    method="post"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button
                                                                                        class=" btn-delete ml-4 btn btn-danger btn-sm mt-2">
                                                                                        <i
                                                                                            class="fa fa-regular fa-trash"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    @endif
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
                                                <table id="trasheduser"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Vote Details</th>
                                                            <th>Excel Name</th>
                                                            <th>PDF Name</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mydeleted as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>

                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
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
                                                                            <form
                                                                                action="{{ route('vote.restore', $item->id) }}"
                                                                                method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <button
                                                                                    class=" ml-4 btn btn-success btn-sm mt-2">
                                                                                    <i
                                                                                        class="fa fa-regular fa-recycle"></i>
                                                                                </button>
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class=" ml-4 btn btn-danger btn-sm mt-2">
                                                                                    <i class="fa fa-regular fa-trash"></i>
                                                                                </button>
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
                            @endif
                        </div>
                         <div class="tab-pane" id="drafted">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="drafts"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Vote Details</th>
                                                            <th>Excel Name</th>
                                                            <th>PDF Name</th>
                                                            <th>PS Approved Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mydrafts as $key => $item)
                                                            <?php
                                                            $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                                            $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');

                                                            ?>
                                                            <tr>
                                                                <td><a href="{{ route('vote.view', $item->id) }}"
                                                                        title="View vote">{{ $item->VCode }}
                                                                        -{{ $item->VName }}</a>
                                                                </td>
                                                                <td>
                                                                    @if ($item->EXCEL)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $EXCELsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/Excel/' . $item->EXCEL));
                                                                        $EXCELext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->EXCEL);
                                                                        $finalEXCEL = explode('_', $item->EXCEL)[5];
                                                                        ?>

                                                                        <a href="{{ route('preview.excel.file', $item->id) }}"
                                                                            title="Preview {{ $item->EXCEL }}"
                                                                            target="_blank">
                                                                            <i style="color: green; font-size: 30px;"
                                                                                class="fas fa-file-excel"></i>
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
                                                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                                        $finalPDF = explode('_', $item->PDF)[5];
                                                                        ?>

                                                                        <a style="display: inline"
                                                                            href="{{ route('preview.ps.file', $item->id) }}"
                                                                            title="Preview {{ $item->pdfOriginal }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>
                                                                            {{ $finalPDF }} &nbsp;&nbsp;
                                                                            -{{ $PDFsize }}
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $psdate }}
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
                                                                            <form
                                                                                action="{{ route('vote.restore', $item->id) }}"
                                                                                method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <button
                                                                                    class=" ml-4 btn btn-success btn-sm mt-2">
                                                                                    <i
                                                                                        class="fa fa-regular fa-recycle"></i>
                                                                                </button>
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('delete.vote', $item->id) }}"
                                                                                method="post"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button
                                                                                    class=" ml-4 btn btn-danger btn-sm mt-2">
                                                                                    <i class="fa fa-regular fa-trash"></i>
                                                                                </button>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection
