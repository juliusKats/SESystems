<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navmenu">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{asset('system/Default/syslog.webp')}}" alt="" width="300" height="120" class="d-inline-block align-text-top">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('user.entry.page') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="@if (Auth::user() && Auth::user()->status == 1) {{ route('file.list') }}@else {{ route('user.establishment.documents') }} @endif"
                    >ESTABLISHMENT
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="@if (Auth::user() && Auth::user()->status == 1) {{ route('job.file.list') }}@else{{ route('user.jobs.documents') }} @endif"
                    >JOB DESCRIPTION
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="@if (Auth::user() && Auth::user()->status == 1) {{ route('scheme.service.list') }} @else{{ route('user.scheme.documents') }} @endif">
                        SCHEME OF SERVICE
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="@if (Auth::user() && Auth::user()->status == 1) {{ route('rapex.file.list') }}@else{{ route('user.rapex.documents') }} @endif">
                        RAPEX
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="@if (Auth::user() && Auth::user()->status == 1) {{ route('su.file.list') }}@else{{ route('user.serviceug.documents') }} @endif">SERVICE
                        UGANDA
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="@if (Auth::user() && Auth::user()->status == 1) {{ route('productivity.file.list') }}@else {{route('user.productivity.documents')}} @endif"
                    >PRODUCTIVITY
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="@if (Auth::user() && Auth::user()->status == 1) {{ route('research.file.list') }}@else{{ route('user.research.documents') }} @endif"
                    >
                        RESEARCH
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="@if (Auth::user() && Auth::user()->status == 1) {{ route('reform.file.list') }}@else{{ route('user.reform.documents') }} @endif">
                        REFORMS
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        OTHERS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>

            </ul>
            <div class="d-flex">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <ul class="navbar-nav aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"">

                        <li>
                            <a class="btn btn-sm btn-outline-success" href="#" data-toggle="modal" data-target="#modal-default">
                                Ask US
                            </a>
                        </li>
                            <!-- Avatar -->
                            @auth
                            <li class="nav-item"> Hi {{ Auth::user()->sname }} {{ Auth::user()->fname }}</li>

                            <li class="nav-item dropdown dropdown-menu">
                                <a data-mdb-dropdown-init class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                                   role="button" data-mdb-toggle="dropdown" aria-expanded="false">

                                    @if (Auth::user()->profile_photo_path)
                                    <img class="direct-chat-img"
                                         src="{{ url('storage/profile/' . Auth()->user()->profile_photo_path) }}" loading="lazy">
                                    @else
                                    <img class="direct-chat-img" src="{{ asset('system/Default/defaultuser.jpg') }}" loading="lazy">
                                    @endif
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li>
                                        <a class="dropdown-item" href="{ route('user-profile', Auth::user()->id) }}">My profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">Settings</a>
                                    </li>
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
                            <li>
                                <a class="btn btn-sm btn-primary mt-1 ml-1" href="{{ route('front.user.login') }}">Login</a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
            </div>
         </div>
    </div>
</nav>
