@extends('NEW.AUTH.layout')
@section('page_title')
    RAPEX add
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">UPLOAD RAPEX DOCUMENTS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('file.list') }}">Establishment</a></li>
                        <li class="breadcrumb-item active">Upload</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
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


                <div hidden id="errorBox" class="card card-danger">
                    <div class="card-header">
                        <h3 id="errorText" class="card-title"></h3>
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
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('rapex.file.store') }}">
                        @csrf
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Line Ministry</label><br>
                                    <select id="entity" multiple
                                        class="select2 form-control @error('entity') is-invalid @enderror" required name="entity[]">

                                        @foreach ($entities as $item)
                                            <option value="{{$item->entityName}}">{{ $item->entityName}}</option>
                                        @endforeach
                                    </select>
                                    @error('entity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Institution Name</label><br>
                                    <select id="institute" data-placeholder="Select Institution"
                                        class="form-control select2 @error('instittute') is-invalid @enderror" multiple
                                        name="institute[]">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="btn btn-sm btn-success" onclick="openCustomFileInput()">Upload File
                                    </label>&nbsp;&nbsp;<span class="text text-danger">Excel, Word,PDF PowerPoint
                                        (Max: 4mbs)</span>
                                    <input id="customFileInput" required name="docs[]" type="file" multiple
                                        style="display: none" class="form-control @error('images') is-invalid @enderror"
                                        accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.pps," value="{{ old('docs') }}">
                                </div>
                                <ul id="selectedFilesList"></ul>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="btn btn-sm btn-success" onclick="openCustomImageInput()">Upload Images
                                    </label><span class="text text-danger"> &nbsp;&nbsp;Images(Max: 4mbs)</span>
                                    <input name="images[]" type="file" multiple id="customImageInput"
                                        style="display: none" class="form-control @error('images') is-invalid @enderror"
                                        accept=".png,.jpeg,.jpg" value="{{ old('images') }}">
                                </div>
                                <ul id="selectedImagesList"></ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group mb-2">
                                    <label>Comment </label>
                                    <textarea id="summernote" name="comment" class="summernote @error('comment')is-invalid @enderror">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group mb-2">
                                    <label>Virtual link </label>
                                    <input name="link" type="url"
                                        class="form-control @error('link')is-invalid @enderror" accept=".pdf"
                                        value="{{ old('link') }}">
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- <div class="form-group mb-2">
                                    <label>Video </label>
                                    <input id="videoinput" name="video" type="file" accept="video/*"
                                        class="form-control mb-2 @error('video')is-invalid @enderror"
                                        value="{{ old('video') }}">
                                    @error('vido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <video controls id="videotag" >
                                        <source src="splashVideo" id="videosource">
                                        browser not supporinh h
                                    </video>
                                </div> --}}
                                <div class="form-group mb-2">
                                    <label>Video </label><br>
                                    <input type="file" accept="video/*" id="videoInput"  class="form-control mb-2">
                                    <video id="videoPreview" controls  class="form-controls aspect-video" style="width:420px; height: 350px;;">

                                </div>
                            </div>
                        </div>




                        <div class="form-group mt-2">
                            <input type="submit" class="btn btn-primary" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection

@section('scripts')
    <script>
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
        var errBox = document.getElementById('errorBox');
        var errText = document.getElementById('errorText');
        var inst = document.getElementById('institute')


        $('#entity').on('change', function() {
            var entity = document.getElementById('entity');
            var entity_id = Array.from(entity.selectedOptions).map(option => option.value);


            if (entity_id == "") {
                errBox.removeAtrribute('hidden', 'hidden')
                errText.innerText = "Select a line Ministry"
            } else {

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
                                console.log(key)
                            })
                        }
                    }
                })
            }
        })
    </script>

    <script>

        var  videopreview= document.getElementById('videoPreview')
         var videoinput = document.getElementById('videoInput')


        videoinput.addEventListener('change',(event)=>{

         if (event.target.files && event.target.files[0]) {
         videopreview.src=URL.createObjectURL(event.target.files[0]);
         videopreview.load()
         }

        })



    </script>
@endsection
