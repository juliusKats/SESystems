
@extends('FileManager.FrontEnd._layout')
@section('title') Blank @endsection
    @section('content')
    <div class="justify-content-center" style="height: 50px;background-color: #37517e">
        <marquee class="blink" behavior="scroll" direction="left" scrollamount="5"
            style=" font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bolder; font-size: xx-large;">
            <img src="{{ asset('system/frontEnd/img/bg/word.webp') }}" style="width: 1000px; color: blue;" alt="">
        </marquee>
    </div>
    <div class="page-title" data-aos="fade">
      <div class="container">
        <div class="row">
                <div class="col-md-10">
                    <h1>Starter Page</h1>
                </div>
                <div class="col-md-2">
                    <nav class="breadcrumbs">
                        <ol>
                            <li><a href="{{ route('user.entry.page') }}">Home</a></li>
                            <li class="current">Starter Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
      </div>
    </div>

    
    <section id="starter-section" class="starter-section section">

      <div class="container" data-aos="fade-up">
        <p>Use this page as a starter for your own custom pages.</p>
      </div>

    </section>

    @endsection


