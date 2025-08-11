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
                        <div class="form-group">
                            <input class="form-control"  type="hidden" name="docs[]" id="pdf_files_input">
                        </div>
                        <div id="myAwesomeDropzone" class="dropzone"></div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('scripts')
    <script>
        Dropzone.options.myAwesomeDropzone = {
            url: "{{ route('rapex.file.store') }}", // Same endpoint as the main form
            autoProcessQueue: false, // Don't process automatically
            uploadMultiple: true,
            // acceptedFiles: "application/pdf",
            addRemoveLinks: true,
            // ... other configurations
            maxFilesize: 10, // MB
            acceptedFiles: '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pps,.pptx', // Accept only PDF files
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                // Handle success, e.g., add hidden input for file name
                $('form').append('<input type="hidden" name="docs[]" value="' + response.name + '">')
            },
            removedfile: function(file) {
                // Handle file removal, e.g., remove hidden input
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="docs[]"][value="' + name + '"]').remove()
            },
            init: function() {
                var myDropzone = this;
                document.querySelector("form").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue(); // Manually process the queue on form submission
                });
                this.on("sendingmultiple", function(file, xhr, formData) {
                    // Append other form fields to the formData object
                    formData.append("entity[]", document.querySelector("input[name='entity[]']").value);
                    formData.append("institute[]", document.querySelector("input[name='institute[]']")
                        .value);
                    // ... append other form fields
                });
            }
        };
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
@endsection
