@extends('FileManager.FrontEnd._layout')
@section('title')
    FAQ
@endsection
@section('content')

    <div class="page-title" data-aos="fade">
        <div class="container text text-white">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">FAQ</li>
                </ol>
            </nav>
            <h1> Frequently Asked Question</h1>
        </div>
    </div>

    <!-- Starter Section Section -->
    <section id="faq-2" class="faq-2 section light-background"
        style="background-image: url('{{ asset('system/frontEnd/img/bg/bg-8.webp') }}')">
        <div class="container text text-white">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2 class="text text-white">Frequently Asked Questions</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div><!-- End Section Title -->
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-9">
                        <div class="row justify-content-center">

                            <div class="col-lg-12">
                                <div class="faq-container">
                                    @if (count($questions) > 0)
                                        <?php
                                        $i = 1;
                                        ?>

                                        <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                                            <i class="faq-icon bi bi-question-circle"></i>
                                            <h3>{{ $i }}. {{ $firstquestion->question }}</h3>
                                            <div class="faq-content">
                                                <p class=" text text-black">{{ $firstquestion->reply }}.</p>
                                            </div>
                                            <i class="faq-toggle bi bi-chevron-right"></i>
                                        </div><!-- End Faq item-->
                                        @foreach ($questions as $key => $item)
                                            <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                                                <i class="faq-icon bi bi-question-circle"></i>
                                                <h3>{{ ++$key + $i }}. {{ $item->question }}?</h3>
                                                <div class="faq-content">
                                                    <p class=" text text-black">{{ $item->reply }}.</p>
                                                </div>
                                            </div><!-- End Faq item-->
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
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
                                            <input type="text" class="form-control" name="question" required
                                                minlength="8">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Details</label>
                                        <textarea name="qndetails" class="form-control" aria-multiline="true" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="ASK" class="btn-getstarted">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </section><!-- /Contact Section -->

@endsection
