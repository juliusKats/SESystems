@extends('NEW.AUTH.layout')
@section('page_title') Establishment @endsection
@section('content')

 <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">UPLOAD DOCUMENTS</h1>
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
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('file.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Vote Code</label>
                                    <select id="votecode"
                                        class="form-control select2 @error('votecode') is-invalid @enderror" required
                                        name="votecode">
                                        <option>Select Vote</option>
                                        @foreach ($votes as $key => $item)
                                            <option value="{{ $item->id }}"
                                                @if (old('votecode') == $item->id) selected @endif>{{ $item->votecode }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('votecode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Vote Name</label>
                                    <input id="votename" type="text"
                                        class="form-control @error('votename') is-invalid @enderror" required
                                        name="votename" value="{{ old('votename') }}" readonly>
                                    @error('votename')
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
                                    <label>Excel File </label>
                                    <input required name="excel" type="file"
                                        class="form-control @error('excel') is-invalid @enderror" accept=".xlsx,.xls"
                                        value="{{ old('excel') }}">
                                    @error('excel')
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
                            {{-- <div class="col-md-6"></div> --}}

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

@endsection
