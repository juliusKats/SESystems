@extends('FileManager.FrontEnd._layout')
@section('title')
    Home
@endsection
@section('content')
    <div class="justify-content-center" style="height: 50px;background-color: #37517e">
        <marquee class="blink" behavior="scroll" direction="left" scrollamount="5"
            style=" font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bolder; font-size: xx-large;">
            <img src="{{ asset('system/frontEnd/img/bg/word.webp') }}" style="width: 1000px; color: blue;" alt="">
        </marquee>
    </div>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background"
        style="background-image: url('{{ asset('system/frontEnd/img/bg/mops.webp') }}'); background-size: contain; background-repeat: no-repeat;">
        <h3>Welcome to the Electronic Backup and Recovery system of Management Service Department
        </h3>
        <img class="animated float float-right" src="{{ asset('system/Default/sys2.jpg') }}"
            style="margin-top: 140px; opacity:0.8" />
    </section>

    <!-- About Section -->
    <section id="about" class="about section">

        
        <div class="container section-title" data-aos="fade-up">
            <h2>About Us</h2>
        </div>

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.</span></li>
                        <li><i class="bi bi-check2-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate
                                velit.</span></li>
                        <li><i class="bi bi-check2-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo</span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>

            </div>

        </div>

    </section><!-- /About Section -->


    <!-- Services Section -->
    @if(count($services)>0)
    <section id="services" class="services section light-background">
        
        <div class="container section-title" data-aos="fade-up">
            <h2>Services</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>

        <div class="container">
            <div class="row gy-4">
                @foreach ($services as $service )
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                           <img  @if($service->label)
                           src="{{ url('storage/servicelogo/' . $service->label) }}"
                            @else
                            src="{{ asset('system/Default/service/logo.png') }}"
                            @endif
                            alt="{{ $service->serviceName }}">
                        </div>

                        <h4><a href="" class="stretched-link">{{ $service->serviceName }}</a></h4>
                        <p> @if($service->about){{ Str::words($service->about,20) }}@endif</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </section><!-- /Services Section -->
    @endif
    @if (count($teammembers) > 0)
        <!-- Team Section -->
        <section id="team" class="team section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>

            <div class="container">

                <div class="row gy-4">
                    @foreach ($teammembers as $member)
                        {{-- {{ $member }} --}}
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="team-member d-flex align-items-start">
                                <div class="pic">
                                    <img @if ($member->profile_photo_path) src="{{ url('storage/profile/' . $member->profile_photo_path) }}"
                                    @else
                                     src="{{ asset('system/Default/defaultuser.jpg') }}" @endif
                                        class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>
                                        {{ $member->sname }}&nbsp;{{ $member->fname }}&nbsp;{{ $member->oname }}
                                    </h4>
                                    <span>
                                        @if ($member->title)
                                            {{ $member->title }}
                                        @endif
                                    </span>
                                    <p>
                                        {{Str::words($member->about,10) }}
                                        {{-- Explicabo voluptatem mollitia et repellat qui dolorum quasi --}}
                                    </p>
                                    <div class="social">
                                        @if($member->twitter)<a href=""><i class="bi bi-twitter-x"></i></a>@endif
                                        @if($member->facebook)<a href=""><i class="bi bi-facebook"></i></a>@endif
                                        @if($member->instagram)<a href=""><i class="bi bi-instagram"></i></a>@endif
                                        @if($member->linkedin)<a href=""> <i class="bi bi-linkedin"></i> </a>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Recent Blog Postst Section -->
    <section id="recent-blog-postst" class="recent-blog-postst section light-background">

        
        <div class="container section-title" data-aos="fade-up">
            <h2>Recent Blog Posts</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-4 col-md-6">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

                        <div class="post-img position-relative overflow-hidden">
                            <img src="{{ asset('system/frontEnd/img/blog/blog-post-1.web') }}p" class="img-fluid"
                                alt="">
                            <span class="post-date">December 12</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">Julia Parker</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                                </div>
                            </div>

                            <hr>

                            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->

                <div class="col-xl-4 col-md-6">
                    <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="200">

                        <div class="post-img position-relative overflow-hidden">
                            <img src="{{ asset('system/frontEnd/img/blog/blog-post-2.web') }}p" class="img-fluid"
                                alt="">
                            <span class="post-date">July 17</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">Et repellendus molestiae qui est sed omnis</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">Mario Douglas</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">Sports</span>
                                </div>
                            </div>

                            <hr>

                            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="post-item position-relative h-100">

                        <div class="post-img position-relative overflow-hidden">
                            <img src="{{ asset('system/frontEnd/img/blog/blog-post-3.web') }}p" class="img-fluid"
                                alt="">
                            <span class="post-date">September 05</span>
                        </div>

                        <div class="post-content d-flex flex-column">

                            <h3 class="post-title">Quia assumenda est et veritati tirana ploder</h3>

                            <div class="meta d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person"></i> <span class="ps-2">Lisa Hunter</span>
                                </div>
                                <span class="px-3 text-black-50">/</span>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder2"></i> <span class="ps-2">Economics</span>
                                </div>
                            </div>

                            <hr>

                            <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i
                                    class="bi bi-arrow-right"></i></a>

                        </div>

                    </div>
                </div><!-- End post item -->

            </div>

        </div>

    </section><!-- /Recent Blog Postst Section -->
@endsection
