@extends('NEW.NON.layout')
@section('page_title')
    Gallery
@endsection
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">FilterizR Gallery with Ekko Lightbox</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="btn-group w-100 mb-2">
                                    <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items
                                    </a>
                                    @foreach ($categories as $item)

                                    <a class="btn btn-info" href="javascript:void(0)" data-filter="{{ $item->Category }}"> {{ $item->Category }}</a>

                                    @endforeach

                                </div>
                                <div class="mb-2">
                                    <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>
                                    <div class="float-right">
                                        <select class="custom-select" style="width: auto;" data-sortOrder>
                                            <option value="index"> Sort by Position </option>
                                            <option value="sortData"> Sort by Custom Data </option>
                                        </select>
                                        <div class="btn-group">
                                            <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending
                                            </a>
                                            <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="filter-container p-0 row">
                                    @foreach ($images as $image)
<?php
 $ext=pathinfo('storage/gallery/Establishment/'.$image->getFilename())['extension']
 ?>
 {{-- {{ $ext }} --}}

                                    <div class="filtr-item col-sm-2" data-category="
                                    @if($ext=="jpg")
                                    1
                                    @elseif($ext=="jpeg")
                                    2
                                    @elseif($ext=="png")
                                    3
                                    @endif
                                    " data-sort="white sample">
                                        <a href="{{ url('storage/gallery/Establishment/'.$image->getFilename()) }}?text={{ $image->getFilename()}}" data-toggle="lightbox"
                                            data-title="{{ $image->getFilename() }}">
                                            <img src="{{ url('storage/gallery/Establishment/'.$image->getFilename()) }}" class="img-fluid mb-2"
                                                alt="white sample" />
                                        </a>
                                    </div>
                                     @endforeach
                                    {{-- <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox"
                                            data-title="sample 2 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2"
                                                alt="black sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3"
                                            data-toggle="lightbox" data-title="sample 3 - red">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3"
                                                class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4"
                                            data-toggle="lightbox" data-title="sample 4 - red">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4"
                                                class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox"
                                            data-title="sample 5 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2"
                                                alt="black sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox"
                                            data-title="sample 6 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2"
                                                alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7"
                                            data-toggle="lightbox" data-title="sample 7 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=7"
                                                class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=8"
                                            data-toggle="lightbox" data-title="sample 8 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=8"
                                                class="img-fluid mb-2" alt="black sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9"
                                            data-toggle="lightbox" data-title="sample 9 - red">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9"
                                                class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10"
                                            data-toggle="lightbox" data-title="sample 10 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=10"
                                                class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                        <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11"
                                            data-toggle="lightbox" data-title="sample 11 - white">
                                            <img src="https://via.placeholder.com/300/FFFFFF?text=11"
                                                class="img-fluid mb-2" alt="white sample" />
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                        <a href="https://via.placeholder.com/1200/000000.png?text=12"
                                            data-toggle="lightbox" data-title="sample 12 - black">
                                            <img src="https://via.placeholder.com/300/000000?text=12"
                                                class="img-fluid mb-2" alt="black sample" />
                                        </a>
                                    </div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Ekko Lightbox</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox"
                                        data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2"
                                            alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox"
                                        data-title="sample 2 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2"
                                            alt="black sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3"
                                        data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3"
                                            class="img-fluid mb-2" alt="red sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4"
                                        data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4"
                                            class="img-fluid mb-2" alt="red sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox"
                                        data-title="sample 5 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2"
                                            alt="black sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox"
                                        data-title="sample 6 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2"
                                            alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox"
                                        data-title="sample 7 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2"
                                            alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox"
                                        data-title="sample 8 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2"
                                            alt="black sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9"
                                        data-toggle="lightbox" data-title="sample 9 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9"
                                            class="img-fluid mb-2" alt="red sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox"
                                        data-title="sample 10 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2"
                                            alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox"
                                        data-title="sample 11 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2"
                                            alt="white sample" />
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox"
                                        data-title="sample 12 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2"
                                            alt="black sample" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Ekko Lightbox</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if (count($images) > 0)
                                    @foreach ($images as $image)
                                        <div class="col-sm-2">
                                            <a href="{{ url('storage/gallery/Establishment/'.$image->getFilename()) }}?text={{ $image->getFilename()}}"
                                                data-toggle="lightbox" data-title="{{ $image->getFilename() }}" data-gallery="gallery">
                                                <img src="{{ url('storage/gallery/Establishment/'.$image->getFilename()) }}"
                                                    class="img-fluid mb-2" alt="{{ $image->getFilename() }}" />
                                            </a>



                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
