@extends('FileManager.FrontEnd._layout')
@section('title')
    Service Uganda
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
                    <h1>Service Uganda</h1>
                </div>
                <div class="col-md-2">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                            <li class="current">Service Uganda</li>
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
                                    <th style="width:200px;">Service Centres</th>
                                    <th>Uploaded Files</th>
                                    <th style="width: 100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($files as $key => $item)
                                    <?php
                                    $upload = \Carbon\Carbon::parse($item->DateOn)->format('M d, Y');
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $centers = explode(',', $item->SUCenter);
                                            ?>
                                            @foreach ($centers as $center)
                                                <i class="fa fa-check-circle text-success"></i>
                                                <span class="mt-1">{{ $center }}</span> <br>
                                            @endforeach
                                        </td>
                                        <td>
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
                                                        <i style="color: red; font-size: 20px;" class="far fa-file-pdf"></i>
                                                    @endif
                                                    <a @if ($ext == 'pdf') href="{{ route('su.pdf.view',$file) }}"  @else href="{{ route('su.download.file',$file) }}" @endif title="{{ $file }}">
                                                        {{ $finalfile }}
                                                    </a>
                                                    <span class="float float-right">
                                                        {{ $size }}</span> <br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td><a href="{{ route('create.su.zip',$item->id)}}">Download</a></td>
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
