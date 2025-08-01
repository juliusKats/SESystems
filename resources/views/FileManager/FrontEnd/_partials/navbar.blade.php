  <nav id="navmenu" class="navmenu">
      <ul>
          <li>
              <a href="{{ route('user.entry.page') }}" class="active">
                  HOME
              </a>
          </li>
          <li>
              <a
                  href="@if (Auth::user() && Auth::user()->status == 1) {{ route('file.list') }}@else {{ route('user.establishment.documents') }} @endif">
                  ESTABLISHMENT
              </a>
          </li>
          <li>
              <a
                  href="@if (Auth::user() && Auth::user()->status == 1) {{ route('job.file.list') }}@else{{ route('user.jobs.documents') }} @endif">JOB
                  DESCRIPTION
              </a>
          </li>
          <li>
              <a
                  href="@if (Auth::user() && Auth::user()->status == 1) {{ route('scheme.service.list') }} @else{{ route('user.scheme.documents') }} @endif">
                  SCHEME OF SERVICE
              </a>
          </li>
          <li>
              <a
                  href="@if (Auth::user() && Auth::user()->status == 1) {{ route('rapex.file.list') }}@else{{ route('user.rapex.documents') }} @endif">
                  RAPEX
              </a>
          </li>
          <li>
              <a
                  href="@if (Auth::user() && Auth::user()->status == 1) {{ route('su.file.list') }}@else{{ route('user.serviceug.documents') }} @endif">SERVICE
                  UGANDA
              </a>
          </li>
          <li class="dropdown"><a href="#"><span>Others</span> <i
                      class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                  <li><a href="{{ route('user.blog') }}">GALLERY</a></li>
                  {{-- <li><a href="{{ route('user.scheme') }}">Scheme of Service</a></li>
                <li><a href="{{ route('user.rapex') }}">RAPEX</a></li>
                <li><a href="#sevviceug">Service Uganda</a></li> --}}
              </ul>
          </li>

          <li>
              <a class="btn btn-sm btn-outline-success" href="#" data-toggle="modal"
                  data-target="#modal-default">
                  Ask US
              </a>
          </li>
      </ul>

      <nav class="navmenu navbar navbar-expand-lg ">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Features</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">Pricing</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link disabled" href="#">Disabled</a>
                  </li>
              </ul>
          </div>
      </nav>

      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

  </nav>
  @auth
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-4">
          @auth
              <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                      class="nav-link dropdown-toggle">
                      @if (Auth::user()->profile_photo_path)
                          <img class="direct-chat-img"
                              src="{{ url('storage/profile/' . Auth()->user()->profile_photo_path) }}">
                      @else
                          <img class="direct-chat-img" src="{{ asset('system/Default/defaultuser.jpg') }}">
                      @endif
                  </a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                      <span class="ml-4">{{ Auth::user()->sname }} {{ Auth::user()->fname }}
                          {{ Auth::user()->oname }}</span>
                      <li class="dropdown-divider"></li>
                      <li><a href="{{ route('user-profile', Auth::user()->id) }}" class="dropdown-item">Profile</a></li>
                      <li class="dropdown-divider"></li>
                      <li>
                          <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                              @csrf
                              <button type="submit" class="btn-logout btn-sm btn btn-danger">
                                  {{ __('Log Out') }}
                              </button>
                          </form>
                      </li>
                  </ul>
              </li>
          @else
              <a href="{{ route('login') }}" class="btn btn-primary mr-0">Login</a>
              <a href="{{ route('register') }}" class="btn btn-primary mr-5">Register</a>
          @endauth
      </ul>
  @else
      <div class="dropdown ml-3 mt-1 btn-sm">
          <button class="btn btn-danger btn-sm dropdown-toggle" href="#" role="button" data-toggle="dropdown"
              arial-haspopup="true" arial-expanded="false">
              Action
          </button>
          <div class="dropdown-menu">
              <a class="btn btn-sm btn-primary ml-2" href="{{ route('front.user.register') }}">Register</a>
              <a class="btn btn-sm btn-primary mt-1 ml-1" href="{{ route('front.user.login') }}">Login</a>
          </div>
      </div>
  @endauth
