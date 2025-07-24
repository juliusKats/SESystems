@extends('FileManager.FrontEnd._layout')
@section('title')
    Establishment
@endsection
@section('content')
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Starter Page</li>
                </ol>
            </nav>
            <h1>Starter Page</h1>
        </div>
    </div><!-- End Page Title -->

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section text-white" style="background-color: #4668a2">

        <div class="container" data-aos="fade-up">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="front">
                            <thead class="bg-highlight">
                                <tr>
                                    <th>Ministry</th>
                                    <th style="width:200px">Carder Name(s)</th>
                                    <th style="width:200px">PDF File</th>
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
                                                &nbsp;&nbsp;
                                                -{{ $PDFsize }}
                                            @endif
                                            <br>
                                            PS' Approval Date: {{ $psdate }}
                                        </td>

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
                                                        Preview PDF</a>


                                                    <a href="{{ route('job.description.download', $item->id) }}"
                                                        class="ml-4 mt-1 btn btn-warning btn-sm">Downloadd PDF</a>




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
