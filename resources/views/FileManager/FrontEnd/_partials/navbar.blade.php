<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('user.entry.page') }}" class="active">HOME</a></li>
        <li><a href="{{ route('user.establishment') }}">ESTABLISHMENT</a></li>
        <li><a href="{{ route('user.job.description') }}">JOB DESCRIPTION</a></li>
         <li><a href="{{ route('user.scheme') }}">SCHEME OF SERVICE</a></li>
                <li><a href="{{ route('user.rapex') }}">RAPEX</a></li>
                <li><a href="#sevviceug">SERVICE UGANDA</a></li>
        {{-- <li class="dropdown"><a href="#"><span>Other Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="{{ route('user.scheme') }}">Scheme of Service</a></li>
                <li><a href="{{ route('user.rapex') }}">RAPEX</a></li>
                <li><a href="#sevviceug">Service Uganda</a></li>
            </ul>
        </li> --}}
          <li><a href="{{ route('user.blog') }}">GALLERY</a></li>
        {{-- <li><a href="{{ route('user.frequent.question') }}">FAQ</a></li>
        <li><a href="{{ route('user.entry.contact') }}">Contact US</a></li> --}}
    </ul>

    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

</nav>

 <a class="btn btn-primary ml-4" href="{{ route('front.user.register') }}">Register</a>
      <a class="btn btn-primary ml-1" href="{{ route('front.user.login') }}">Login</a>
