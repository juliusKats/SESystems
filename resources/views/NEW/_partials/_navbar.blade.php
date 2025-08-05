<nav class="main-header navbar navbar-expand  text text-white navbar-light" style=" background-color: #996515;">
    <!-- Left navbar links -->
    <ul class="navbar-nav text-white">
        @if (Auth::user() && Auth::user()->status == 1)
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        @endif
        <li class="nav-item d-none d-sm-inline-block  ">
            <a href="{{ route('user.entry.page') }}" class="nav-link" style="color: white">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('file.list') }}@else {{ route('user.establishment.documents') }} @endif"
                class="nav-link" style="color: white">Establishment</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('job.file.list') }}@else{{ route('user.jobs.documents') }} @endif"
                class="nav-link" style="color: white">Job
                Description</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('scheme.service.list') }} @else{{ route('user.scheme.documents') }} @endif"
                class="nav-link" style="color: white">Scheme of Service</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('rapex.file.list') }}@else{{ route('user.rapex.documents') }} @endif"
                class="nav-link" style="color: white">RAPEX Documents</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('su.file.list') }}@else{{ route('user.serviceug.documents') }} @endif"
                class="nav-link" style="color: white">Service Uganda</a>
        </li>
         <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('productivity.file.list') }}@else{{ route('user.productivity.documents') }} @endif"
                class="nav-link" style="color: white">Productivity</a>
        </li>
         <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('research.file.list') }}@else{{ route('user.research.documents') }} @endif"
                class="nav-link" style="color: white">Research</a>
        </li>
         <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="@if (Auth::user() && Auth::user()->status == 1) {{ route('reform.file.list') }}@else{{ route('user.reform.documents') }} @endif"
                class="nav-link" style="color: white">Reforms</a>
        </li>

         @if (!Auth::user())

        <li class="nav-item d-none d-sm-inline-block " style="color: white">
            <a href="{{ route('user.blog') }}" class="nav-link" style="color: white">Gallery</a>
        </li>

            <li class="nav-item d-none d-sm-inline-block " style="color: white">
                <a href="{{ route('contact-us') }}" class="nav-link" style="color: white">Contact US</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block " style="color: white">
                <a href="{{ route('faq') }}" class="nav-link" style="color: white">FAQ</a>
            </li>
        @endif

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @auth

        <!-- Team Setting -->
            <li class="nav-item">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    class="nav-link dropdown-toggle">Hi @auth {{ Auth::user()->sname }} {{ Auth::user()->fname }}
                        {{ Auth::user()->oname }}
                    @else
                    User @endauth </a>
            </li>
            <!-- User Profile -->

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
                    <li class="dropdown-divider"></li>
                    <li><a href="{{ route('user-profile', Auth::user()->id) }}" class="dropdown-item">User Profile</a></li>
                    <li class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                            @csrf
                            <button type="submit" class="btn-logout btn btn-danger">
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
</nav>
