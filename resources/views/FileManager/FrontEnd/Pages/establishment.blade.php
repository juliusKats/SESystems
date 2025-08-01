@extends('FileManager.FrontEnd._layout')
@section('title')
    Establishment
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
                <div class="col-md-10">
                    <h1>Establishment Documents</h1>
                </div>
                <div class="col-md-2">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                            <li class="current">Establishment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <section id="starter-section" class="starter-section section text-white"
        style="background-image: url('{{ asset('system/frontEnd/img/bg/bg-8.webp') }}')">
        <div class="container" data-aos="fade-up" style="width: 100%">
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
                                        <td>{{ $item->votecode }} - {{ $item->VoteName }}</td>
                                        <td>
                                            <i style="color: red; font-size: 30px;" class="far fa-file-pdf"></i>
                                            {{ $finalPDF }} &nbsp;--<span
                                                class="text text-danger">{{ $item->versionname }}</span>
                                            &nbsp;({{ $PDFsize }})

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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
