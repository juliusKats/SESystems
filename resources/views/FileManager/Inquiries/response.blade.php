@extends('NEW.AUTH.layout')
@section('page_title')
    Add Votes
@endsection
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reply to {{ Str::upper($inquiry->fullname) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('inquiry.list') }}">Inquiries</a></li>
                        <li class="breadcrumb-item active">Respond Inquiry</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('inquiry.store', $inquiry->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-2">
                                    <label class="col-sm-4 col-md-4">Sender</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input type="text" class="form-control @error('sender') is-invalid @enderror"
                                            readonly name="sender" minlength="3" maxlength="3"
                                            value="{{ $inquiry->fullname }}">
                                        @error('sender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Telephone</label>
                                            <input type="text"
                                                class="form-control @error('telephone') is-invalid @enderror" readonly
                                                name="telephone" minlength="3" maxlength="3"
                                                value="{{ $inquiry->telephone }}">
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            readonly name="email" minlength="3" maxlength="3"
                                            value="{{ $inquiry->email }}">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Inquiry Message</label>
                                    <textarea name="inquiry" class="form-control @error('inquiry') is-invalid @enderror" rows="5" readonly>{{ $inquiry->inquiry }}</textarea>
                                    @error('inquiry')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row mb-2">
                                    <label id="lblsend" class="btn-sm float-right btn-success mb-3">Reply Sender?</label>
                                </div>
                                <div id="divresponse" hidden="hidden" class="mb-2">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-md-3"> Reply Via</label>
                                        <div class="col-sm-9 col-md-9">
                                            <div class="form-group row">
                                                @if ($inquiry->telephone)
                                                    <label class="col-md-6"><input name="replyvia" required
                                                            style="width: 25px;height:25px" type="radio"
                                                            value="tel">&nbsp;
                                                        &nbsp;Mobile</label>
                                                @endif
                                                @if ($inquiry->email)
                                                    <label class="col-md-6"><input name="replyvia" required
                                                            style="width: 25px;height:25px" type="radio"
                                                            value="mail">&nbsp;
                                                        &nbsp;Email</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Response</label>
                                        <textarea name="response" class="form-control @error('response') is-invalid @enderror" required minlength="5"
                                            maxlength="200" rows="5" placeholder="Type Reply Message"></textarea>
                                        @error('response')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Reply">
                                    <a href={{ route('inquiry.list') }} class="btn btn-danger float-right">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>

        </div>

    </section>
@endsection
@section('scripts')
    <script>
        var replybox = document.getElementById('divresponse')
        $('#lblsend').on('click', function() {
            replybox.removeAttribute('hidden', 'hidden');
        })
    </script>
@endsection
