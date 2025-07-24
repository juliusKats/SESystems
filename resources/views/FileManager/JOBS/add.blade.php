@extends('NEW.AUTH.layout')
@section('page_title')
    Add Job
@endsection
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ADD JOB DESCRIPTION FILES</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('job.file.list') }}">Establishment</a></li>
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
                    <div>
                        <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('job.file.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Carder</label>
                                    <select id="carder" name="ministry" required
                                        class="form-control select2 @error('ministry') is-invalid @enderror">
                                        <option value="">Select Ministry</option>
                                        @foreach ($carders as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == old('minisrty')) selected @endif>{{ $item->carderName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ministry')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Carder Name(s)</label>
                                    <select id="cardername" name="cardername[]"
                                        class="form-control select2 @error('cardername') is-invalid @enderror" multiple
                                        required></select>
                                    @error('cardername')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Upload File</label><span>(pdf and word)</span>
                                    <input required name="fileupload" type="file"
                                        class="form-control @error('fileupload') is-invalid @enderror"
                                        accept=".doc,.docx,.pdf" value="{{ old('fileupload') }}">
                                    @error('fileupload')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>PDF File </label>
                                    <input required name="pdf" type="file"
                                        class="form-control @error('pdf')is-invalid @enderror" accept=".pdf"
                                        value="{{ old('pdf') }}">
                                    @error('pdf')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>PS Approved On </label>
                                    <input required name="approvaldate" type="date"
                                        class="form-control @error('approvaldate')is-invalid @enderror"
                                        value="{{ old('approvaldate') }}">
                                    @error('approvaldate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group mb-2">
                            <label>Comment </label>
                            <textarea name="comment" id="summernote" class="summernote @error('comment')is-invalid @enderror">{{ old('comment') }}</textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <input type="submit" class="btn btn-primary" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('scripts')
    <script>
        var txtinput = document.getElementById('cardername')
        $('#carder').on('change', function() {
            var cardername = $(this).val()
            console.log(cardername)
            if (cardername == 0) {
                alert('Select a valid ministry')
                txtinput.setAttribute('required', 'required');
            } else {
                $.ajax({
                    url: "{{ route('fetch-carder') }}",
                    type: 'GET',
                    data: {
                        'carder_id': cardername,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        if (result.carder.length > 0) {
                            $('#cardername').html('<option = ""> Select Carder Name</option>')
                            $.each(result.carder, function(key, value) {
                                $('#cardername').append('<option = "' + value.id + '">' + value
                                    .cardname + '</option>')
                            })
                        }
                    },
                    error: function(error) {
                        alert(error)
                    }
                })
            }
        })
    </script>
@endsection
