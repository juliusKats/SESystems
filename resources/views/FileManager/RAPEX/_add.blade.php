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
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('rapex.file.store') }}">
                        @csrf
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Line Ministry</label><br>
                                    <select id="entity"
                                        class="form-control select2 @error('entity') is-invalid @enderror" required
                                        name="entity">
                                        <option>Line Ministry</option>
                                        @foreach ($entities as $key => $item)
                                            <option value="{{ $item->id }}"
                                                @if (old('entity') == $item->id) selected @endif>
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
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Institution Name</label><br>
                                    <select id="institute"
                                        class="form-control select2 @error('instittute') is-invalid @enderror"
                                        name="institute">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <input required name="docs[]" type="file" multiple
                                class="form-control @error('images') is-invalid @enderror"
                                accept=".xlsx,.xls,.doc,.docx," value="{{ old('docs') }}">
                        </div>
                        <div class="row mb-1">
                            <input required name="images[]" type="file" multiple
                                class="form-control @error('images') is-invalid @enderror"
                                accept=".png,.jpeg,.jpg" value="{{ old('images') }}">
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Upload File </label><span class="text text-danger">Excel, Word,PDF or Images
                                        (Max: 4mbs)</span>
                                    <input required name="uploads[]" type="file" multiple
                                        class="form-control @error('uploads') is-invalid @enderror"
                                        accept=".xlsx,.xls,.doc,.docx,.png,.jpeg,.jpg" value="{{ old('uploads') }}">
                                    @error('uploads')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Virtual link </label>
                                    <input name="link" type="url"
                                        class="form-control @error('link')is-invalid @enderror" accept=".pdf"
                                        value="{{ old('pdf') }}">
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-group mb-2">
                            <label>Comment </label>
                            <textarea id="summernote" name="comment" class="summernote @error('comment')is-invalid @enderror">{{ old('comment') }}</textarea>
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
        <!-- /.container-fluid -->
    </section>

@endsection

@section('scripts')
    <script>
        var entity = document.getElementById('entity')
        $('#entity').on('change', function() {
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
                        $('#institute').html('<option = ""> Select Class</option>')
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
        });
    </script>
@endsection
