@extends('FileManager.FrontEnd._layout')
@section('title')
    Scheme of Service
@endsection
@section('content')
<div class="justify-content-center" style="height: 50px;background-color: #37517e">
        <marquee class="blink" behavior="scroll" direction="left" scrollamount="5"
            style=" font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bolder; font-size: xx-large;">
            <img src="{{ asset('system/frontEnd/img/bg/word.webp') }}" style="width: 1000px; color: blue;" alt="">
        </marquee>
    </div>
    <div class="page-title" data-aos="fade">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h1>Schemes Of Service</h1>
                </div>
                <div class="col-md-3">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                            <li class="current">Schemes Of Service</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section id="starter-section" class="starter-section section text-white" style="background-color: #4668a2">
        <div class="container" data-aos="fade-up">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="front">
                            <thead class="bg-highlight">
                                <tr>
                                    <th>Ministry</th>
                                    <th>Carder Name(s)</th>
                                    <th>PDF File</th>
                                    <th>Approved On</th>
                                    <th style="width:40px">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($allactives as $key => $item)
                                    <?php
                                    $psdate = \Carbon\Carbon::parse($item->PSDate)->format('M d, Y');
                                    $upload = \Carbon\Carbon::parse($item->UploadDate)->format('M d, Y');
                                    $adminapproval = Carbon\Carbon::parse($item->ADMINApproval)->format('M d, Y');
                                    ?>
                                    <tr>
                                        <td>{{ $item->ministry }}</td>
                                        <td>
                                            <?php $carders = explode(',', $item->CarderName);
                                            ?>
                                            @foreach ($carders as $carder)
                                                <i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;<span
                                                    class="text-capitalize">{{ $carder }}<br></span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($item->PDF)
                                                <?php
                                                $Yr = explode('_', $item)[3];
                                                $Month = explode('_', $item)[2];
                                                $finalPDF = explode('_', $item->PDF)[5];
                                                $PDFsize = Number::fileSize(File::size('storage/Schemes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                ?>
                                                <i style="color: red; font-size: 30px;"
                                                    class="far fa-file-pdf"></i>{{ $finalPDF }}
                                                &nbsp;&nbsp;<span>{{ $item->versionname }}</span>
                                                -({{ $PDFsize }})
                                            @endif
                                        </td>
                                        <td>{{ $psdate }}</td>
                                        <td>
                                            <div class="dropdown mt-1 btn-sm">
                                                <button class="btn btn-danger btn-sm dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown" arial-haspopup="true"
                                                    arial-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a target="_blank"
                                                        href="{{ route('job.description.preview', $item->id, $finalPDF) }}"
                                                        class="ml-4 btn btn-sm btn-primary mt-1"><i class="fa fa-edit"></i>
                                                        Preview PDF
                                                    </a>
                                                    <a href="{{ route('job.description.download', $item->id) }}"
                                                        class="ml-4 mt-1 btn btn-warning btn-sm">Downloadd PDF
                                                    </a>
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
    </section>
@endsection
