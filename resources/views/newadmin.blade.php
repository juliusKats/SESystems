@extends('NEW.AUTH.layout')
@section('page_title')
    Contact Us
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact us</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact us</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card container">
            <div class="card-body">
                <h4>System Modules</h4>
                <div class="row mt-1">
                    <div class="col-3 col-sm-2">
                        <div class="nav flex-column nav-tabs h-100 card-primary" id="vert-tabs-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-item nav-link active" id="user" data-toggle="pill" href="#vert-user"
                                role="tab" aria-controls="vert-audit" aria-selected="false">Users</a>
                            <a class="nav-item nav-link" id="vote" data-toggle="pill" href="#vert-vote" role="tab"
                                aria-controls="vert-vote" aria-selected="false">Votes</a>

                            <a class="nav-item nav-link" id="audit" data-toggle="pill" href="#vert-audit" role="tab"
                                aria-controls="vert-audit" aria-selected="false">Audit Log</a>
                            <a class="nav-item nav-link" id="version" data-toggle="pill" href="#vert-version"
                                role="tab" aria-controls="vert-version" aria-selected="false">Version</a>
                            <a class="nav-item nav-link" id="center" data-toggle="pill" href="#vert-center"
                                role="tab" aria-controls="vert-center" aria-selected="false">Service Center</a>
                            <a class="nav-item nav-link" id="min" data-toggle="pill" href="#vert-min" role="tab"
                                aria-controls="vert-min" aria-selected="false">Ministry</a>
                            <a class="nav-item nav-link" id="carder" data-toggle="pill" href="#vert-carder"
                                role="tab" aria-controls="vert-carder" aria-selected="false">Carders</a>
                            <a class="nav-item nav-link" id="linemin" data-toggle="pill" href="#vert-linemin"
                                role="tab" aria-controls="vert-linemin" aria-selected="false">Line Ministry</a>

                            <a class="nav-item nav-link" id="inst" data-toggle="pill" href="#vert-inst" role="tab"
                                aria-controls="vert-inst" aria-selected="false">Institution</a>
                        </div>
                    </div>
                    <div class="col-9 col-sm-10">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane fade text-left fade show active" id="vert-user" role="tabpanel"
                                aria-labelledby="vert-user">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actuser"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactuser"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actuser">Active user</div>
                                        <div class="tab-pane" id="inactuser">inact user</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-vote" role="tabpanel" aria-labelledby="vert-vote">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actvote"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactvote"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actvote">Active vote</div>
                                        <div class="tab-pane" id="inactvote">inact vote</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-audit" role="tabpanel" aria-labelledby="vert-audit">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actaudit"
                                                data-toggle="tab">Audits</a></li>

                                        <li class="nav-item"><a class="nav-link" href="#inactauditTime"
                                                data-toggle="tab">Action Date</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactaudit"
                                                data-toggle="tab">Location</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactauditBrowser"
                                                data-toggle="tab">Browser Info</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actaudit">
                                            <div class="container-fluid">
                                                <div class="card">
                                                    <div class="card-header p-2">Audits</div>
                                                    <div class="card-body">
                                                        <table id="establishment"
                                                            class="table table-bordered table-striped table-hover">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <td>Userimage</td>
                                                                    <th>Model</th>
                                                                    <th>Action</th>
                                                                    <th>Old Values</th>
                                                                    <th>New Values</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                @foreach ($audits as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ++$key }}</td>
                                                                        <td>

                                                                            <img alt="image"
                                                                                src="{{ asset('system/Default/avatar.png') }}"
                                                                                style="width: 70px; height:70px"
                                                                                class="rounded-circle profile-widget-picture">
                                                                        </td>

                                                                        <td>
                                                                            {{ explode('\\', $item->auditable_type)[2] }}
                                                                            (id: {{ $item->auditable_id }})
                                                                        </td>
                                                                        <td>{{ $item->event }}</td>
                                                                        <td>
                                                                            @if ($item->old_values)
                                                                                <table class="table">
                                                                                    @foreach ($item->old_values as $attribute => $value)
                                                                                        <tr>
                                                                                            <td><b>{{ $attribute }}</b>
                                                                                            </td>
                                                                                            <td>{{ $value }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </table>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($item->new_values)
                                                                                <table class="table">
                                                                                    @foreach ($item->new_values as $attribute => $value)
                                                                                        <tr>
                                                                                            <td><b>{{ $attribute }}</b>
                                                                                            </td>
                                                                                            <td>{{ $value }}</td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </table>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="inactauditTime">
                                            <div class="card">
                                                <div class="card-header p-2">Audits</div>
                                                <div class="card-body">
                                                    <table id="establishment"
                                                        class="table table-bordered table-striped table-hover">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Username</th>
                                                                <th>Action</th>
                                                                <th>Date</th>
                                                                <th>Time</th>
                                                                <th>Old Values</th>
                                                                <th>New Values</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($audits as $key => $item)
                                                                <tr>

                                                                    <td>{{ ++$key }}</td>
                                                                    <td>
                                                                        @if ($item->user)
                                                                            {{ $item->user->sname }}
                                                                            {{ $item->user->fname }}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $item->event }}</td>
                                                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                                                    <td>{{ $item->created_at->format('H:i:s') }}</td>
                                                                    <td>
                                                                        @if ($item->old_values)
                                                                            <table class="table">
                                                                                @foreach ($item->old_values as $attribute => $value)
                                                                                    <tr>
                                                                                        <td><b>{{ $attribute }}</b>
                                                                                        </td>
                                                                                        <td>{{ $value }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </table>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($item->new_values)
                                                                            <table class="table">
                                                                                @foreach ($item->new_values as $attribute => $value)
                                                                                    <tr>
                                                                                        <td><b>{{ $attribute }}</b>
                                                                                        </td>
                                                                                        <td>{{ $value }}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </table>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="inactaudit">
                                            <div class="container-fluid">
                                                <div class="card">

                                                    <div class="card-header p-2"> Location</div>
                                                    <div class="card-body">
                                                        <table id="establishment"
                                                            class="table table-bordered table-striped table-hover">
                                                            <thead class="thead-dark">

                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">USERNAME</th>
                                                                    <th scope="col">URL</th>
                                                                    <th scope="col">IP ADDRESS</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($location as $key => $item)
                                                                    <tr>
                                                                        <?php

                                                                        $ad = new Karmendra\LaravelAgentDetector\AgentDetector($item->user_agent);
                                                                        ?>
                                                                        <td>{{ ++$key }}</td>

                                                                        <td>
                                                                            @if ($item->user)
                                                                                {{ $item->user->sname }}
                                                                                {{ $item->user->fname }}
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $item->url }}</td>
                                                                        <td>{{ $item->ip_address }}</td>
                                                                        
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                                <!-- /.row -->
                                            </div>

                                        </div>
                                        <div class="tab-pane" id="inactauditBrowser">
                                            <div class="container-fluid">
                                                <div class="card">
                                                    <div class="card-header p-2">Browser Info</div>
                                                    <div class="card-body">
                                                        <table id="establishment"
                                                            class="table table-bordered table-striped table-hover">
                                                            <thead class="thead-dark">

                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">IP ADDRESS</th>
                                                                    <th>Device Details</th>
                                                                    <th>Operating System</th>
                                                                    <th scope="col">BROWSER</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($location as $key => $item)
                                                                    <tr>
                                                                        <?php

                                                                        $ad = new Karmendra\LaravelAgentDetector\AgentDetector($item->user_agent);
                                                                        ?>
                                                                        <td>{{ ++$key }}</td>
                                                                        <td>{{ $item->ip_address }}</td>
                                                                        <td>
                                                                            Type: @if($ad->device()){{ $ad->device() }} @else Unknown @endif <br>
                                                                            Brand: @if($ad->deviceBrand()){{ $ad->deviceBrand() }} @else Unknown @endif <br>
                                                                            Model: @if($ad->deviceModel()){{ $ad->deviceModel() }} @else Unknown @endif <br>
                                                                        </td>
                                                                        <td>
                                                                            Name: @if($ad->platform()){{ $ad->platform() }} @else Unknown @endif <br>
                                                                            Version: @if($ad->platformVersion()){{ $ad->platformVersion() }} @else Unknown @endif <br>
                                                                        </td>
                                                                        <td>
                                                                            Name: @if($ad->browser()) {{ $ad->browser() }}@else Unknown @endif <br>
                                                                            version:  @if($ad->browserVersion()) {{ $ad->browserVersion() }}@else Unknown @endif <br>
                                                                            isBot:{{ $ad->isBot() }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                                <!-- /.row -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-version" role="tabpanel" aria-labelledby="vert-version">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actverse"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactverse"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actverse">Active verse</div>
                                        <div class="tab-pane" id="inactverse">inact verse</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-center" role="tabpanel" aria-labelledby="vert-center">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actcenter"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactcenter"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actcenter">Active center</div>
                                        <div class="tab-pane" id="inactcenter">inact center</div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="vert-min" role="tabpanel" aria-labelledby="vert-min">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actmin"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactmin"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actmin">Active min</div>
                                        <div class="tab-pane" id="inactmin">inact min</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-carder" role="tabpanel" aria-labelledby="vert-carder">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actcarder"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactcarder"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actcarder">Active carder</div>
                                        <div class="tab-pane" id="inactcarder">inact carder</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-linemin" role="tabpanel" aria-labelledby="vert-linemin">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actlinemin"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactlinemin"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actlinemin">Active linemin</div>
                                        <div class="tab-pane" id="inactlinemin">inact linemin</div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vert-inst" role="tabpanel" aria-labelledby="vert-inst">
                                <div class="card-header p-2">
                                    <a href="#" class="btn btn-primary float float-right mt-3 mr-3"> ADD</a>
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#actinst"
                                                data-toggle="tab">Active</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#inactinst"
                                                data-toggle="tab">Inactive</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="actinst">Active inst</div>
                                        <div class="tab-pane" id="inactinst">inact inst</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>

@endsection
