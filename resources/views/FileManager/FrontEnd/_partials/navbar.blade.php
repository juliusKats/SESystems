<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('user.entry.page') }}" class="active">HOME</a></li>
        <li><a href="{{ route('user.establishment.documents') }}">ESTABLISHMENT</a></li>
        <li><a href="{{ route('user.jobs.documents') }}">JOB DESCRIPTION</a></li>
        <li><a href="{{ route('user.scheme.documents') }}">SCHEME OF SERVICE</a></li>
        <li><a href="{{ route('user.rapex.documents') }}">RAPEX</a></li>
        <li><a href="{{ route('user.serviceug.documents') }}">SERVICE UGANDA</a></li>
        {{-- <li class="dropdown"><a href="#"><span>Other Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="{{ route('user.scheme') }}">Scheme of Service</a></li>
                <li><a href="{{ route('user.rapex') }}">RAPEX</a></li>
                <li><a href="#sevviceug">Service Uganda</a></li>
            </ul>
        </li> --}}
        <li><a href="{{ route('user.blog') }}">GALLERY</a></li>
    </ul>

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
                    <img class="direct-chat-img" src="{{ url('storage/profile/' . Auth()->user()->profile_photo_path) }}">
                @else
                    <img class="direct-chat-img" src="{{ asset('system/Default/defaultuser.jpg') }}">
                @endauth
        </a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <span class="ml-4">{{ Auth::user()->sname }} {{ Auth::user()->fname }} {{ Auth::user()->oname }}</span>
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
{{--  --}}
