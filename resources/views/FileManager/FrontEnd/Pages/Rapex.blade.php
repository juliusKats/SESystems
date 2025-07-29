@extends('FileManager.FrontEnd._layout')
@section('title')
    Rapex
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
                    <h1>Rapex Documents</h1>
                </div>
                <div class="col-md-2">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                            <li class="current">RAPEX</li>
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
                                    <th>Institution Details</th>
                                    <th>Files</th>
                                    <th style="width: 20px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
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
                                                    $entities = explode(',', $item->entity);
                                                    ?>
                                                    @foreach ($entities as $entity)
                                                        <i class="fa fa-check-circle text-success"></i>
                                                        {{ $entity }}<br>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="card card-success">
                                                <div class="card-header">
                                                    <h3 class="card-title">Institutions</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    $institutions = explode(',', $item->institution);
                                                    ?>
                                                    @foreach ($institutions as $institute)
                                                        <i class="fa fa-arrow-circle-right text-success"></i>
                                                        {{ $institute }}<br>
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
                                                            $size = Number::fileSize(File::size('storage/Rapex/' . $Yr . '/' . $Month . '/' . $file));
                                                            $ext = File::extension('storage/Rapex/' . $Yr . '/' . $Month . '/' . $file);
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
                                            <a href="{{ route('create.rapex.zip', $item->id) }}"
                                                class="ml-4 btn  btn-warning mt-1">
                                                <i class="fa fa-download"></i>
                                            </a>
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
