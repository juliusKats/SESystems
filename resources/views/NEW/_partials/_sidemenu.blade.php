 <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- DashBoard-->
                    <li class="nav-item">
                        <a href="#" class="nav-link  mynav">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p> DASHBOARD <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('user.dashboard') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Statistics</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.graphs') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>DashBoard</p>
                                </a>
                            </li>
                            @if(Auth::user()->role =='superadmin' or Auth::user()->role =='hod')
                            <li class="nav-item">
                                <a href="{{ route('inquiry.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inquiries</p>
                                </a>
                            </li>
                            @endif
                    </li>
                </ul>
                @auth
                    @if (Auth::user()->role == 'superadmin' or Auth::user()->role == 'admin')
                        <!-- System Management -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link  mynav">
                                <i class="nav-icon fa fa-cog"></i>
                                <p>SYSTEM SETTING <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.list') }}" class="nav-link">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p>USERS</p>
                                    </a>
                                <li class="nav-item">
                                    <a href="{{ route('line.ministy.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Line Ministry</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vote.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Vote</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('institution.list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Institutions</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Audit Log -->
                        <li class="nav-item ">
                            <a href="#" class="nav-link  mynav">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p> SYSTEM AUDITS <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('audit-log') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User Log</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('audit.log.location') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User Location</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endauth
                <li class="nav-item ">
                    <a href="#" class="nav-link  mynav">
                        <i class="nav-icon fa fa-solid fa-folder-plus"></i>
                        <p>ESTABLISHMENT <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('file.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Establishment Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('file.create') }}" class="nav-link">
                                <i class="fa fa-file  nav-icon"></i>
                                <p>UpLoad Documments</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link  mynav">
                        <i class="nav-icon fa fa-solid fa-folder-plus"></i>
                        <p>JOB DESCRIPTION<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('job.file.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Job Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('job.file.create') }}" class="nav-link">
                                <i class="fa fa-solid fa-file-arrow-up nav-icon"></i>
                                <p>UpLoad Documments</p>
                            </a>
                        </li>
                    </ul>
                </li>
                 <li class="nav-item ">
                    <a href="#" class="nav-link  mynav">
                        <i class="nav-icon fa fa-solid fa-folder-plus"></i>
                        <p>SCHEMES OF SERVICE<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('scheme.service.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Scheme Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('scheme.service.upload') }}" class="nav-link">
                                <i class="fa fa-solid fa-file-arrow-up nav-icon"></i>
                                <p>UpLoad Documments</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link  mynav">
                        <i class="nav-icon fa fa-solid fa-folder-plus"></i>
                        <p>RAPEX<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('rapex.file.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage RAPEX Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rapex.file.create') }}" class="nav-link">
                                <i class="fa fa-solid fa-file-arrow-up nav-icon"></i>
                                <p>UpLoad Documments</p>
                            </a>
                        </li>
                    </ul>
                </li>

                 <li class="nav-item ">
                    <a href="#" class="nav-link  mynav">
                        <i class="nav-icon fa fa-solid fa-folder-plus"></i>
                        <p>SERVICE UGANDA<i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('su.file.list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage RAPEX Files</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('su.file.create') }}" class="nav-link">
                                <i class="fa fa-solid fa-file-arrow-up nav-icon"></i>
                                <p>UpLoad Documments</p>
                            </a>
                        </li>
                    </ul>
                </li>

                </ul>
            </nav>
