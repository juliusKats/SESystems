<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link justify-content-center align-item-center ">
        <img style="align-content: center; position: relative;" src="{{ asset('system/Default/logo.png') }}"
            alt="SESystem">
    </a>
    <!-- Sidebar -->
    @if (Auth::user()->status == 1)
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                @auth
                    <div class="image">

                        @if (Auth::user()->profile_photo_path)
                            <img style="width:70px;height:70px" class="direct-chat-img"
                                src="{{ url('storage/profile/' . Auth()->user()->profile_photo_path) }}">
                        @else
                            <img style="width:70px;height:70px" class="direct-chat-img"
                                src="{{ asset('system/Default/defaultuser.jpg') }}">
                        @endif

                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->sname }} {{ Auth::user()->fname }}
                            {{ Auth::user()->oname }}</a>
                    </div>
                @endauth
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
             @include('NEW._partials._sidemenu')
                <!-- /.sidebar-menu -->
        </div>
    @endif
    <!-- /.sidebar -->
</aside>
