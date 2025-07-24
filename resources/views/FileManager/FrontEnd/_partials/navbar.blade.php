<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('user.entry.page') }}" class="active">Home</a></li>
        <li><a href="{{ route('user.establishment') }}">Establishment</a></li>
        <li><a href="{{ route('user.job.description') }}">Job Description</a></li>
        <li class="dropdown"><a href="#"><span>Other Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="{{ route('user.scheme') }}">Scheme of Service</a></li>
                <li><a href="{{ route('user.rapex') }}">RAPEX</a></li>
                <li><a href="#sevviceug">Service Uganda</a></li>
            </ul>
        </li>
          <li><a href="{{ route('user.blog') }}">Gallery</a></li>
        <li><a href="{{ route('user.frequent.question') }}">FAQ</a></li>
        <li><a href="{{ route('user.entry.contact') }}">Contact US</a></li>
    </ul>

    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    <ul>

    </ul>
</nav>

 <a class="btn-getstarted" href="{{ route('front.user.register') }}">Register</a>
      <a class="btn-getstarted" href="{{ route('front.user.login') }}">Login</a>
