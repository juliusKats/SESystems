@extends('NEW.AUTH.layout')
{{-- refresh page 60s --}}
@section('meta_tag')
    <meta http-equiv="refresh" content="60">
@endsection
@section('page_title')User Location @endsection
@section('content')

 <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">USER ACTIVITY AND LOCATION</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Location</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="card">

                <div class="card-header p-2"> Location</div>
                <div class="card-body">
                    <table id="establishment" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">

                            <tr>


                                <th scope="col">#</th>
                                <th scope="col">USER PHOTO</th>
                                <th scope="col">USERNAME</th>
                                <th>MODEL</th>
                                <th>ACTION</th>
                                <th scope="col">URL</th>
                                <th scope="col">IP ADDRESS</th>
                                <th scope="col">BROWSER</th>
                                <th scope="col">DATE</th>
                                <th scope="col">TIME</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($audits as $key => $item)
                                <tr>
                                    <?php

                                    $ad = new Karmendra\LaravelAgentDetector\AgentDetector($item->user_agent);
                                    ?>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                        <img alt="image" src="{{ asset('mops_asset/img/Default/avatar.png') }}"
                                            style="width: 70px; height:70px" class="rounded-circle profile-widget-picture">
                                    </td>
                                    <td>
                                        @if ($item->user)
                                            {{ $item->user->name }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ explode('\\', $item->auditable_type)[2] }}
                                        (id: {{ $item->auditable_id }})
                                    </td>
                                    <td>{{ $item->event }}</td>
                                    <td>{{ $item->url }}</td>
                                    <td>{{ $item->ip_address }}</td>
                                    <td>
                                        Devicetype: {{ $ad->device() }}
                                        DeviceBrand: {{ $ad->deviceBrand() }}
                                        DevicetModel: {{ $ad->deviceModel() }}
                                        OS: {{ $ad->platform() }}
                                        OSVersion: {{ $ad->platformVersion() }}
                                         Browsername: {{ $ad->browser() }}
                                        Browserversion: {{ $ad->browserVersion() }}
                                        isBot:{{ $ad->isBot() }}
                                        {{ 'icons/browsers/CH.png' }}
                                        {{-- {{ $item->user_agent }} --}}
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td>{{ $item->created_at->format('H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>

    </section>



@endsection
@section('scripts')
