@extends('NEW.AUTH.layout')
@section('page_title')Scheme Documents @endsection
@section('content')

 <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Scheme Of Service Documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Jobs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">
                    <a href="{{ route('scheme.service.upload') }}" class="btn btn-primary float float-right mt-3 mr-3">UPLOAD
                        DOCUMENTS</a>
                    <ul class="nav nav-pills">
                         <li class="nav-item"><a class="nav-link active" href="#approved" data-toggle="tab">Approved</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pending" data-toggle="tab">Pending</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rejected" data-toggle="tab">Rejected</a></li>
                        <li class="nav-item"><a class="nav-link" href="#trashed" data-toggle="tab">Deleted</a></li>
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {$EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

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
                                                                </td>
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
                                                                                action="{{ route('scheme.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-deactive btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Deactivate?">
                                                                            </form>
                                                                             <a href="{{ route('scheme.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>

                                                                            <form method="post"
                                                                                action="{{ route('scheme.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('scheme.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.schemes', $item->id) }}"
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
                                                            <th style="width:200px">Carder Name(s)</th>
                                                            <th style="width:200px">File Attached</th>
                                                            <th style="width:200px">PS PDF File</th>
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {$EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));

                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

                                                                        </a>
                                                                    @endif<br>
                                                                    Approved On: {{ $psdate }}
                                                                </td>

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
                                                                                action="{{ route('scheme.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('delete.schemes', $item->id) }}"
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {$EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

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
                                                                                action="{{ route('scheme.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-approve btn btn-sm ml-4 mt-2 btn-success"
                                                                                    value="Approve?">
                                                                            </form>
                                                                             <a href="{{ route('scheme.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>

                                                                            <form method="post"
                                                                                action="{{ route('scheme.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('scheme.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.schemes', $item->id) }}"
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
                                                            <th>Carder Name(s)</th>
                                                            <th>File Attached</th>
                                                            <th>PS PDF File</th>
                                                            <th>PS Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mypending as $key => $item)
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {$EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

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
                                                                                action="{{ route('scheme.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('delete.schemes', $item->id) }}"
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {$EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;

                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

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
                                                                                action="{{ route('scheme.approve', $item->id) }}">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <input type="submit"
                                                                                    class="btn-deactive btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Deactivate?">
                                                                            </form>
                                                                             <a href="{{ route('scheme.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>

                                                                            <form method="post"
                                                                                action="{{ route('scheme.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
                                                                            </form>
                                                                            @if ($item->status == 'Active' || $item->status == 'Pending')
                                                                                <a href="{{ route('scheme.reject', $item->id) }}"
                                                                                    class="ml-4 mt-1 btn btn-warning btn-sm">Reject</a>
                                                                            @endif
                                                                            <form
                                                                                action="{{ route('delete.jobs', $item->id) }}"
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
                                                <table id="rejectuser"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Carder Name(s)</th>
                                                            <th>File Attached</th>
                                                            <th>PS PDF File</th>
                                                            <th>PS Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($myrejected as $key => $item)
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {$EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;

                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

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
                                                                                action="{{ route('scheme.soft.delete', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-softdelete btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('delete.jobs', $item->id) }}"
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {$EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>&nbsp;&nbsp;{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

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
                                                                                action="{{ route('scheme.restore', $item->id) }}">
                                                                                @csrf
                                                                                <input type="submit"
                                                                                    class="btn-restore btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Restore">
                                                                            </form>

                                                                            <form method="post"
                                                                                action="{{ route('delete.jobs', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn-delete btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="trasheduser"
                                                    class="table table-bordered table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Carder Name(s)</th>
                                                            <th>File Attached</th>
                                                            <th>PS PDF File</th>
                                                            <th>PS Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mydeleted as $key => $item)
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>&nbsp;&nbsp;{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

                                                                        </a>

                                                                    @endif<br>
                                                                    Approved On: {{ $psdate }}
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
                                                                            <form method="post"
                                                                                action="{{ route('scheme.restore', $item->id) }}">
                                                                                @csrf
                                                                                <input type="submit"
                                                                                    class="btn-restore btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Restore">
                                                                            </form>

                                                                            <form method="post"
                                                                                action="{{ route('delete.jobs', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
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
                                                            <th>Carder Name(s)</th>
                                                            <th>File Attached</th>
                                                            <th>PS PDF File</th>
                                                            <th>PS Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mydrafts as $key => $item)
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
                                                                        $finalEXCEL = last(explode('_', $item->EXCEL));
                                                                        if ($extname == 'pdf') {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEPDF' . $item->EXCEL);
                                                                        } else {
                                                                            $EXCELext = File::extension('storage/Schemes/' . $Yr . '/' . $Month . '/' . '/SCHEMEDOC' . $item->EXCEL);
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
                                                                            &nbsp;&nbsp;
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($item->PDF)
                                                                        <?php
                                                                        $Yr = explode('_', $item)[3];
                                                                        $Month = explode('_', $item)[2];
                                                                        $finalPDF = last(explode('_', $item->PDF));
                                                                        ?>
                                                                        <a href="#"
                                                                            title="Preview {{ $finalPDF }}"
                                                                            target="_blank">
                                                                            <i style="color: red; font-size: 30px;"
                                                                                class="far fa-file-pdf"></i>&nbsp;&nbsp;{{ $finalPDF }}
                                                                            &nbsp;&nbsp;

                                                                        </a>

                                                                    @endif<br>
                                                                    Approved On: {{ $psdate }}
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
                                                                            <form method="post"
                                                                                action="{{ route('scheme.restore', $item->id) }}">
                                                                                @csrf
                                                                                <input type="submit"
                                                                                    class="btn-restore btn btn-sm ml-4 mt-2 btn-default"
                                                                                    value="Restore">
                                                                            </form>

                                                                            <form method="post"
                                                                                action="{{ route('delete.jobs', $item->id) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="submit"
                                                                                    class="btn btn-danger btn-sm ml-4 mt-1"
                                                                                    value="Trash">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
@section('scripts')
