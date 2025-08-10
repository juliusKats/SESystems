@extends('NEW.AUTH.layout')
@section('page_title')
    RAPEX add
@endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">UPLOAD RAPEX DOCUMENTS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('file.list') }}">Establishment</a></li>
                        <li class="breadcrumb-item active">Upload</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="card">
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
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('rapex.file.store') }}">
                        @csrf
                        <div class="form-group row mb-1">
                            <label class="col-sm-2">Line Ministry</label>
                            <div class="col-md-10">
                                <select id="entity" multiple="multiple"
                                    class="select2 form-control @error('entity') is-invalid @enderror " required
                                    name="entity[]">
                                    @foreach ($entities as $item)
                                        <option value="{{ $item->entityName }}">{{ $item->entityName }}</option>
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
                                    class="form-control select2 @error('instittute') is-invalid @enderror" multiple
                                    name="institute[]">
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-sm-2">Upload Files</label>
                            <div class="col-md-10">
                                <label class="btn btn-sm btn-success" onclick="openCustomFileInput()">Upload File
                                </label>&nbsp;&nbsp;<span class="text text-danger">Excel, Word,PDF PowerPoint
                                    (Max: 4mbs)</span>
                                @error('docs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="customFileInput" required name="docs[]" type="file" multiple
                                    style="display: none" class="form-control @error('images') is-invalid @enderror"
                                    accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.pps,.pdf" value="{{ old('docs') }}">
                                <ul id="selectedFilesList"></ul>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-sm-2">Virtual link</label>
                            <div class="col-md-10">
                                <input name="link" type="url" class="form-control @error('link')is-invalid @enderror"
                                    accept=".pdf" value="{{ old('link') }}">
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label>Comment </label>
                            <textarea id="summernote" name="comment" class="summernote @error('comment')is-invalid @enderror">{{ old('comment') }}</textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row mb-1">
                            <label id="lblimage" class="float float-right btn btn-success btn-sm"><i class="fa fa-light fa-image" style="color: blue; font-size: 18px;"></i>&nbsp; &nbsp; Attach Photos</label>
                        </div>
                        <div id="imagewrapper" class="mb-2" hidden>
                            <div class="form-group row mb-1">
                                <label class="col-sm-3">Upload images</label>
                                <div class="col-md-9">
                                    <label class="btn btn-sm btn-success" onclick="openCustomImageInput()">Upload Images
                                    </label><span class="text text-danger"> &nbsp;&nbsp;Images(Max: 4mbs)</span>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input name="images[]" type="file" multiple id="customImageInput"
                                        style="display: none" class="form-control @error('images') is-invalid @enderror"
                                        accept=".png,.jpeg,.jpg" value="{{ old('images') }}">
                                    <ul id="selectedImagesList"></ul>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-sm-3">Category</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control @error('category') is-invalid @enderror "
                                        name="category">
                                        <option value="">Select Image Category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->Category }}</option>
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
                            <label id="lblvideo" class="float float-right btn btn-success btn-sm"><i class="fa fa-light fa-video" style=" color: red; font-size: 18px;;"></i>&nbsp; &nbsp; Attach Video</label>
                        </div>
                        <div id="videowrapper" hidden>
                            <div class="form-group mb-1">
                                <label class="btn btn-success btn-sm" onclick="AttachVideo()">Attach Video </label><br>
                                <input name="video" type="file" accept="video/*,.mkv" id="videoInput"
                                    class="form-control mb-2 @error('video')is-invalid @enderror" style="display: none">
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
                            <input type="submit" class="btn btn-primary" value="Upload" name="save">
                            <input type="submit" class="btn btn-success float-right" value="Save Draft" name="draft">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('scripts')
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
