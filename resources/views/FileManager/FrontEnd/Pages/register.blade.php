@extends('FileManager.FrontEnd._layout')
@section('title')
    Register
@endsection
@section('content')
    <div class="page-title" data-aos="fade">
        <div class="container text text-white">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Register</li>
                </ol>
            </nav>
            <h1> User Registeration</h1>
        </div>
    </div>

    <!-- Starter Section Section -->
    <section id="faq-2" class="faq-2 section light-background"
        style="background-image: url('{{ asset('system/frontEnd/img/bg/bg-8.webp') }}')">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-6">
                    <div class="faq-container">
                        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label>Photo</label>
                                        <div id="imgpreview mt-4">
                                            <img style="width:100px;height:100px; border-color: blue; border-width: 2px; border-radius: 100%;"
                                                src="{{ asset('system/Default/defaultuser.jpg') }}">
                                        </div>
                                        <label id="btnupload" class="btn btn-primary mt-4 mb-0">Select Photo</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group mb-1">
                                            <label>Surname</label>
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('sname') is-invalid @enderror"
                                                    placeholder="Surname" name="sname" value="{{ old('sname') }}"
                                                    required>
                                                @error('sname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>First Name</label>
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('fname') is-invalid @enderror"
                                                    placeholder="Last Name" name="fname" value="{{ old('fname') }}"
                                                    required>
                                                @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label>Other Name</label>
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control @error('oname') is-invalid @enderror"
                                                    placeholder="Other Name" name="oname" value="{{ old('oname') }}">
                                                @error('oname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 row">
                                    <label class="col-md-4">Email</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  mb-2 row">
                                    <label class="col-md-4">Password</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                placeholder="Password" value="{{ old('password') }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <label class="col-md-4">Confirm Password</label>
                                    <div class="col-md-8">
                                        <div class="input-group mb-3">
                                            <input type="password" name="password_confirmation"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                value="{{ old('password_confirmation') }}" placeholder="Retype password">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group mb-1">
                                    <div class="input-group mb-3">
                                        <input id="file-input" type="file" name="userphoto" accept=".png,.jpg,.jpeg"
                                            style="display: none" class="form-control">
                                    </div>
                                </div>
                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="form-group">
                                        <div class="icheck-primary">
                                            <input type="checkbox" style="width:25px;height:25px;"id="terms" name="terms"
                                                required>
                                            <label for="agreeTerms" style="font-size: 25px;">
                                                I agree to the <a target="_blank"
                                                    href="{{ route('terms.show') }}">terms</a>
                                                and <a a target="_blank" href="{{ route('policy.show') }}">Policy</a>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <a href="{{ route('login') }}" class=" btn btn-success text-center">Back to
                                            Login</a>
                                    </div>
                                </div>
                            </form>
                        </div><!-- End Faq item-->

                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Contact Section -->

    <!-- Recent Blog Postst Section -->
    {{-- <section id="recent-blog-postst" class="recent-blog-postst section light-background" style="background-image: url('{{ asset('system/frontEnd/img/bg/bg-8.webp') }}')">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Recent Blog Posts</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-xl-4 col-md-6">
            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

              <div class="post-img position-relative overflow-hidden">
                <img src="assets/img/blog/blog-post-1.webp" class="img-fluid" alt="">
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

                <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </div>
          </div><!-- End post item -->

          <div class="col-xl-4 col-md-6">
            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="200">

              <div class="post-img position-relative overflow-hidden">
                <img src="assets/img/blog/blog-post-2.webp" class="img-fluid" alt="">
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

                <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </div>
          </div><!-- End post item -->

          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="post-item position-relative h-100">

              <div class="post-img position-relative overflow-hidden">
                <img src="assets/img/blog/blog-post-3.webp" class="img-fluid" alt="">
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

                <a href="blog-details.html" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </div>
          </div><!-- End post item -->

        </div>

      </div>

    </section><!-- /Recent Blog Postst Section --> --}}

    <!-- Contact Section -->
@endsection
