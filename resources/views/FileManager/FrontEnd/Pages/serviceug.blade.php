@extends('FileManager.FrontEnd._layout')
@section('title')
    Service Uganda
@endsection
@section('content')
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                    <li class="current">Service Uganda</li>
                </ol>
            </nav>
            <h1>Service Uganda</h1>
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
                                    <th style="width: 80px">code</th>
                                    <th>Vote Details</th>
                                    <th>PDF File</th>
                                    <th>PS Approved Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                                @foreach ($files as $key => $item)
                                    <?php

                                    $upload = \Carbon\Carbon::parse($item->ApprovedOn)->format('M d, Y');
                                    if ($item->PDF) {
                                        $Yr = explode('_', $item)[3];
                                        $Month = explode('_', $item)[2];
                                        $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                        $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                        $finalPDF = explode('_', $item->PDF)[5];
                                    }
                                    ?>
                                    <tr>
                                        <td>{{ $item->votecode }}</td>
                                        <td><a href="#">{{ $item->votecode }} - {{ $item->VoteName }}</a></td>
                                        <td>
                                            <a style="display: inline" href="{{ route('preview.ps.file', $item->id) }}"
                                                title="Preview {{ $item->pdfOriginal }}" target="_blank">
                                                <i style="color: red; font-size: 30px;" class="far fa-file-pdf"></i>
                                                {{ $finalPDF }} &nbsp;&nbsp;
                                                -{{ $PDFsize }}
                                            </a>

                                        </td>

                                        <td>
                                            {{ $upload }}</td>
                                        <td>

                                            <div class="dropdown mt-1 btn-sm">
                                                <button class="btn btn-danger btn-sm dropdown-toggle" href="#"
                                                    role="button" data-toggle="dropdown" arial-haspopup="true"
                                                    arial-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('preview.ps.file', $item->id) }}"
                                                        class="btn btn-sm btn-primary ml-2" target="_blank">Preview
                                                        PDF</a>
                                                    <a target="_blank" href="{{ route('download.ps.file', $item->id) }}"
                                                        class="btn btn-sm btn-success mt-2 ml-2">Dowload PDF</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width: 80px">code</th>
                                    <th>Vote Details</th>
                                    <th>PDF File</th>
                                    <th>PS Approved Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
