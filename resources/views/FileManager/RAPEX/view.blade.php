@extends('NEW.AUTH.layout')
@section('page_title')
    RAPEX
@endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage RAPEX Documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Rapex</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2">
                    <a href="{{ route('rapex.file.list') }}" class="btn btn-primary mt-1">
                        <i class="fa fa-arrow-left"></i> Back to List
                    </a>
                    <span class="float float-right mt-3 mr-3">
                        <button id="headerEdit" class="btn btn-sm mt-1 btn-success">Edit</button>
                        <a href="#"class="ml-1 mt-1 btn btn-warning btn-sm">Reject</a>
                        <form method="post" action="#" style="display: inline">
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn-softdelete btn btn-sm ml-1 mt-1 btn-default" value="Approve">
                        </form>
                        <form method="post" action="#" style="display: inline">
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn-softdelete btn btn-sm ml-1 mt-1 btn-default" value="Trash">
                        </form>
                        <form method="post" action="#" style="display: inline">
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn-restore btn btn-sm ml-1 mt-1 btn-default" value="Restore">
                        </form>
                        <form method="post" action="#" style="display: inline">
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn-delete btn btn-sm ml-1 mt-1 btn-default" value="Delete">
                        </form>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            {{-- user file view --}}
                            <div id="fileinfo">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">File No {{ $file->ticket }} Information </h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row mb-1">
                                            <label class="col-md-3">File Number</label>
                                            <div class="col-md-9">
                                                <input type="text" value="{{ $file->ticket }}" class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>Line Ministry</label>
                                            <div>
                                                <?php
                                                $create = \Carbon\Carbon::parse($file->created_at)->format('d/m/Y');
                                                $entities = explode(',', $file->entity);
                                                ?>
                                                @foreach ($entities as $entity)
                                                    <i class="fa fa-check-circle text-success"></i>
                                                    {{ $entity }}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>Institution</label>
                                            <div>
                                                <?php
                                                $institutions = explode(',', $file->institution);
                                                ?>
                                                @foreach ($institutions as $institute)
                                                    <i class="fa fa-check-circle text-success"></i>
                                                    {{ $institute }}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>Comment</label>
                                            <textarea id="summernote3">{{ $file->comment }}</textarea>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-md-3">Zoom Link</label>
                                            <div class="col-md-9">
                                                <input type="text" value="{{ $file->zoomlink }}" class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <?php
                                            $active = explode(',', $images->imagefiles)[0];
                                            $pics = explode(',', $images->imagefiles);
                                            ?>
                                            <img src="{{ asset('storage/gallery/RAPEX/' . $active) }}" class="product-image"
                                                alt="Product Image" style="width: 250px;height: 200px;">
                                        </div>

                                        <div class="col-12 product-image-thumbs">
                                            <?php
                                            $active = explode(',', $images->imagefiles)[0];
                                            $pics = explode(',', $images->imagefiles);
                                            ?>


                                            <div class="product-image-thumb active">
                                                <img src="{{ asset('storage/gallery/RAPEX/' . $active) }}"
                                                    alt="Product Image">
                                            </div>
                                            @foreach ($pics as $image)
                                                <?php
                                                $text = explode('_RAPEX_', $image)[1];
                                                ?>

                                                <div class="product-image-thumb">
                                                    {{-- <span style="display: flex">X</span><br>÷\ --}}
                                                    <img src="{{ asset('storage/gallery/RAPEX/' . $image) }}"
                                                        alt="{{ $text }}">
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- user file edit --}}
                            <div id="editsection">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title">Editing Establishment File No: {{ $file->ticket }} </h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $item)
                                                <div class="card card-danger">
                                                    <div class="card-header">
                                                        <h3 id="errorText" class="card-title">
                                                            <ul>
                                                                <li>{{ $item }}</li>
                                                            </ul>
                                                        </h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="remove">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <form method="post" enctype="multipart/form-data"
                                            action="{{ route('rapex.file.store') }}">
                                            @csrf
                                            <div class="form-group row mb-1">
                                                <label class="col-sm-2">Line Ministry</label>
                                                <div class="col-md-10">
                                                    <select id="entity" multiple="multiple"
                                                        class="select2 form-control @error('entity') is-invalid @enderror "
                                                        required name="entity[]">
                                                        @foreach ($linemin as $item)
                                                            <option value="{{ $item->entityName }}">
                                                                {{ $item->entityName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('entity')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label class="col-sm-2">Institution Name</label>
                                                <div class="col-md-10">
                                                    <select id="institute" data-placeholder="Select Institution"
                                                        class="form-control select2 @error('instittute') is-invalid @enderror"
                                                        multiple name="institute[]">
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-1">
                                                <label class="col-sm-2">Upload Files</label>
                                                <div class="col-md-10">
                                                    <label class="btn btn-sm btn-success"
                                                        onclick="openCustomFileInput()">Upload File
                                                    </label>&nbsp;&nbsp;<span class="text text-danger">Excel, Word,PDF
                                                        PowerPoint
                                                        (Max: 4mbs)</span>
                                                    @error('docs')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <input id="customFileInput" required name="docs[]" type="file"
                                                        multiple style="display: none"
                                                        class="form-control @error('images') is-invalid @enderror"
                                                        accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.pps,.pdf"
                                                        value="{{ old('docs') }}">
                                                    <ul id="selectedFilesList"></ul>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label class="col-sm-2">Virtual link</label>
                                                <div class="col-md-10">
                                                    <input name="link" type="url"
                                                        class="form-control @error('link')is-invalid @enderror"
                                                        accept=".pdf" value="{{ $file->zoomlink }}">
                                                    @error('link')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-1">
                                                <label>Comment </label>
                                                <textarea id="comment" name="comment" class="form-control @error('comment')is-invalid @enderror">
                                                    hh
                                                {{ $file->comment }}
                                                </textarea>
                                                @error('comment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row mb-1">
                                                <label id="lblimage" class="float float-right btn btn-success btn-sm"><i
                                                        class="fa fa-light fa-image"
                                                        style="color: blue; font-size: 18px;"></i>&nbsp; &nbsp; Attach
                                                    Photos</label>
                                            </div>
                                            <div id="imagewrapper" class="mb-2" hidden>
                                                <div class="form-group row mb-1">
                                                    <label class="col-sm-3">Upload images</label>
                                                    <div class="col-md-9">
                                                        <label class="btn btn-sm btn-success"
                                                            onclick="openCustomImageInput()">Upload Images
                                                        </label><span class="text text-danger"> &nbsp;&nbsp;Images(Max:
                                                            4mbs)</span>
                                                        @error('image')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <input name="images[]" type="file" multiple
                                                            id="customImageInput" style="display: none"
                                                            class="form-control @error('images') is-invalid @enderror"
                                                            accept=".png,.jpeg,.jpg" value="{{ old('images') }}">
                                                        <ul id="selectedImagesList"></ul>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-1">
                                                    <label class="col-sm-3">Category</label>
                                                    <div class="col-md-9">
                                                        <select
                                                            class="select2 form-control @error('category') is-invalid @enderror "
                                                            name="category">
                                                            <option value="">Select Image Category</option>
                                                            @foreach ($categories as $item)
                                                                <option value="{{ $item->id }}">{{ $item->Category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('category')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label>Description</label>
                                                    <textarea name="description" class="form-control" rows="4" placeholder="Description"></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-1">
                                                <label id="lblvideo" class="float float-right btn btn-success btn-sm"><i
                                                        class="fa fa-light fa-video"
                                                        style=" color: red; font-size: 18px;;"></i>&nbsp; &nbsp; Attach
                                                    Video</label>
                                            </div>
                                            <div id="videowrapper" hidden>
                                                <div class="form-group mb-1">
                                                    <label class="btn btn-success btn-sm" onclick="AttachVideo()">Attach
                                                        Video </label><br>
                                                    <input name="video" type="file" accept="video/*,.mkv"
                                                        id="videoInput"
                                                        class="form-control mb-2 @error('video')is-invalid @enderror"
                                                        style="display: none">
                                                    <video id="videoPreview" controls class="form-controls aspect-video"
                                                        style="height: 350px">
                                                        @error('video')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="submit" class="btn btn-primary" value="Upload"
                                                    name="save">
                                                <input type="submit" class="btn btn-success float-right"
                                                    value="Save Draft" name="draft">
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Admin section --}}
                        <div class="col-md-5">
                            Uploaded By: {{ $file->fname }}{{ $file->sname }} {{ $file->oname }}
                            <hr>
                            uploaded on: {{ $file->created_at->format('d/m/Y') }}
                            <hr>
                            status: {{ $file->statusName }}
                        </div>
                    </div>
                    {{-- file wrapper --}}
                    <div class="row">
                        @foreach ($files as $filex)
                            <?php
                            $filed = $filex->files;
                            $Yr = explode('_', $filed)[2];
                            $Month = explode('_', $filed)[1];
                            $size = Number::fileSize(File::size('storage/Rapex/' . $Yr . '/' . $Month . '/' . $filed));
                            $ext = File::extension('storage/Rapex/' . $Yr . '/' . $Month . '/' . $filed);
                            $finalfile = explode('_', $filed)[4];
                            ?>
                            <div class="col-md-3 col-sm-6 col-12">
                                <span href="#" class="rapexfile">
                                    <div class="info-box">
                                        @if ($ext == 'xls' || $ext == 'xlsx')
                                            <span class="info-box-icon bg-success"><i
                                                    class="far fa-file-excel"></i></span>
                                        @elseif($ext == 'doc' || $ext == 'docx')
                                            <span class="info-box-icon bg-primary"><i class="far fa-file-word"></i></span>
                                        @elseif($ext == 'pdf')
                                            <span class="info-box-icon bg-danger"><i class="far fa-file-pdf"></i></span>
                                        @else
                                            <span class="info-box-icon bg-info"><i
                                                    class="far fa-file-powerpoint"></i></span>
                                        @endif
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $finalfile }}</span>
                                            <span class="info-box-number">{{ $size }}
                                                <span id="rapexaction" class="float-right">
                                                    <a href="#" class="btn btn-success btn-sm"><i
                                                            class="fas fa-eye"></i></a>
                                                    <form style="display:inline">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        @endforeach
                    </div>
                    {{-- image wrapper --}}
                    @if ($images)
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4 class="card-title">Images</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        @foreach ($images as $image)
                                            <div class="col-sm-3 card" style="padding: 5px;">
                                                {{-- <span style="display: flex">X</span><br>÷\ --}}
                                                <?php
                                                $text = explode('_RAPEX_', $image)[1];
                                                ?>
                                                <a href="{{ asset('storage/gallery/RAPEX/' . $image) }}?text={{ $text }}"
                                                    data-toggle="lightbox" data-title="{{ $text }}"
                                                    data-gallery="gallery">
                                                    <img src="{{ asset('storage/gallery/RAPEX/' . $image) }}"
                                                        class="img-fluid mb-2" alt="{{ $text }}"
                                                        style="width:250px;height:250px;" />
                                                </a>
                                                <form style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="image" value="{{ $image }}">
                                                    <input type="hidden" name="file_id" value="{{ $images->id }}">
                                                    <buton type="submit"class="btnimage btn btn-danger"
                                                        style="position: absolute;top: 80%;left: 80%;">
                                                        <i class="fa fa-times-circle"></i>
                                                    </button>

                                                </form>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('#comment').summernote();
        // variable declaration
        var fileinfo = document.getElementById('fileinfo');
        var editsection = document.getElementById('editsection');
        var fileinfo = document.getElementById('fileinfo');
        var editsection = document.getElementById('editsection');
        var rapexaction = document.getElementById('rapexaction');


        //initialization
        editsection.style.display = "none";
        rapexaction.style.display = "none";



        $('#headerEdit').on('click', function() {
            editsection.style.display = "block";
            fileinfo.style.display = "none";
        })
        //variable declaraion
        $('.btnimage').on('click', function() {
            var image = $(this).closest('.card').find('img').attr('src');
            var text = $(this).closest('.card').find('img').attr('alt');
            console.log(image);
            console.log(text);


        })

        $('.rapexfile').on('click', function() {
            alert('stop')
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>
    <script>
        //image wrapper
        var imagewrap = document.getElementById('imagewrapper')
        var videowrap = document.getElementById('videowrapper')
        $('#lblimage').on('click', function() {
            imagewrap.removeAttribute('hidden', 'hidden')
        })

        $('#lblvideo').on('click', function() {
            videowrap.removeAttribute('hidden', 'hidden')
        })

        var selectedFiles = []; // Array to store selected files
        var selectedImages = []; // Array to store selected imagess
        function openCustomFileInput() {
            var fileInput = document.getElementById('customFileInput')
            fileInput.click()
        }

        function openCustomImageInput() {
            var fileInput = document.getElementById('customImageInput')
            fileInput.click()
        }

        function handleCustomFileInput(event) {
            var fileList = event.target.files;
            var selectedFilesList = document.getElementById('selectedFilesList');
            for (var i = 0; i < fileList.length; i++) {
                var file = fileList[i];
                selectedFiles.push(file); //Adding newly selected item to Array
                var listItem = document.createElement('li');
                listItem.textContent = file.name;
                var deleteButton = document.createElement('button');

                deleteButton.textContent = 'Delete';
                deleteButton.className = 'ml-2 btn btn-sm btn-danger'
                deleteButton.addEventListener('click', createDeleteHandler(file, listItem));
                listItem.appendChild(deleteButton)
                selectedFilesList.appendChild(listItem)
            }
        }

        function handleCustomImageInput(event) {
            var imageList = event.target.files;
            var selectedImagesList = document.getElementById('selectedImagesList');
            for (var i = 0; i < imageList.length; i++) {
                var image = imageList[i];
                selectedImages.push(image); //Adding newly selected item to Array
                var listImages = document.createElement('li');
                listImages.textContent = image.name;
                listImages.className = "mt-2"
                var deleteButton = document.createElement('button');

                deleteButton.textContent = 'Delete';
                deleteButton.className = 'ml-2 btn btn-sm btn-danger'
                deleteButton.addEventListener('click', createDeleteHandle(image, listImages));
                listImages.appendChild(deleteButton)
                selectedImagesList.appendChild(listImages)
            }
        }

        function createDeleteHandler(file, listItem) {
            return function() {
                var index = selectedFiles.indexOf(file);
                if (index !== -1) {
                    selectedFiles.splice(index, 1); // Remove the file from the array
                }

                listItem.parentNode.removeChild(listItem); // Remove the list item from the list
            };
        }

        function createDeleteHandle(image, listImages) {
            return function() {
                var indexs = selectedFiles.indexOf(image);
                if (indexs !== -1) {
                    selectedImages.splice(indexs, 1); // Remove the file from the array
                }

                listImages.parentNode.removeChild(listImages); // Remove the list item from the list
            };
        }
        document.getElementById('customFileInput').addEventListener('change', handleCustomFileInput);
        document.getElementById('customImageInput').addEventListener('change', handleCustomImageInput);
    </script>

    <script>
        $('#entity').on('change', function() {
            var entity = document.getElementById('entity');
            var entity_id = Array.from(entity.selectedOptions).map(option => option.value);
            var ArrayLength = entity_id.length
            console.log(entity.value);
            if (ArrayLength == 1) {
                var entityId = $(this).val()
                $.ajax({
                    url: "{{ route('fetch-institution') }}",
                    type: 'GET',
                    data: {
                        'entity_id': entityId,
                        _token: '{{ csrf_token() }}',
                    },

                    dataType: 'json',
                    success: function(result) {
                        console.log(result.institute)
                        console.log(result.institute.length)
                        if (result.institute.length > 0) {
                            // $('#institute').html('<option = ""> Select Class</option>')
                            $.each(result.institute, function(key, value) {
                                $('#institute').append('<option = "' + value.id + '">' + value
                                    .institution + '</option>')
                                console.log(key)
                            })
                        }
                    },
                    error: function(error) {
                        alert(error)
                    }
                })
            } else if (ArrayLength > 1) {
                $.ajax({
                    url: "{{ route('fetch-multiple-institution') }}",
                    type: 'GET',
                    dataType: 'json',
                    method: 'GET',
                    data: {
                        'entities': entity_id,
                        // _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        console.log(result)
                        if (result.entity.length > 0) {
                            $.each(result.entity, function(key, value) {
                                $('#institute').append('<option = "' + value.id + '">' + value
                                    .institution + '</option>')
                            })
                        }
                    }
                })
            } else {
                // alert('Select ')
                $('#institute').html('<option = ""> Select Class</option>')
            }
        })
    </script>
    <script>
        var videoinput = document.getElementById('videoInput')

        function AttachVideo() {
            videoInput.click()
        }
        var videopreview = document.getElementById('videoPreview')
        // var videoinput = document.getElementById('videoInput')
        videoinput.addEventListener('change', (event) => {

            if (event.target.files && event.target.files[0]) {
                videopreview.src = URL.createObjectURL(event.target.files[0]);
                videopreview.load()
            }

        })
    </script>
@endsection
