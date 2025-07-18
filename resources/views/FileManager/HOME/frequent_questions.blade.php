@extends('NEW.NON.layout')
@section('page_title')
    FAQ
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FREQUENTLY ASKED QUESTIONS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">FAQ</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            {{-- <div class="card"> --}}
            {{-- <div class="card-head">QN</div> --}}
            {{-- <div class="card-body"> --}}
            <div class="col-8" id="accordion">
                @if (count($questions) > 0)
                    <?php
                    $i = 1;
                    ?>

                    <div class="card card-primary card-outline">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    {{ $i }}. {{ $firstquestion->question }}
                                </h4>
                            </div>
                        </a>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="card-body">
                                {{ $firstquestion->reply }}
                            </div>
                        </div>
                    </div>
                    @foreach ($questions as $key => $item)
                        <div class="card card-warning card-outline">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                <div class="card-header">
                                    <h4 class="card-title w-100">
                                        {{ ++$key + $i }}. {{ $item->question }}
                                    </h4>
                                </div>
                            </a>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    {{ $item->reply }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-center">
                        ASK
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('ask.question') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4">Full Name</label>
                                <div class="col-8 col-md-8">
                                    <input required type="tel" class="form-control" name="telephone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Telephone</label>
                                <div class="col-8 col-md-8">
                                    <input required type="tel" class="form-control" name="telephone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">Question</label>
                                <div class="col-8 col-md-8">
                                    <input type="text" class="form-control" name="question" required minlength="8">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Details</label>
                                <textarea name="qndetails" class="form-control" aria-multiline="true" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="ASK" class="btn btn-success">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('scripts')

@endsection
