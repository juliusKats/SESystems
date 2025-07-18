@extends('NEW.AUTH.layout')
{{-- refresh page 60s --}}
@section('meta_tag')
    <meta http-equiv="refresh" content="60">
@endsection
@section('page_title')AuditLog @endsection
@section('content')


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">SYSTEM AUDIT</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Audit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header p-2"> Location</div>
                <div class="card-body">
                    <table id="establishment" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <td>Userimage</td>
                                                <th>Model</th>
                                                <th>Action</th>
                                                <th>User</th>
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

                                                        <img alt="image"
                                                            src="{{ asset('system/Default/avatar.png') }}"
                                                            style="width: 70px; height:70px"
                                                            class="rounded-circle profile-widget-picture">
                                                    </td>

                                                    <td>
                                                        {{ explode('\\', $item->auditable_type)[2] }}
                                                        {{-- {{ explode('/', $item->auditable_type) }}[2] --}}
                                                        (id: {{ $item->auditable_id }})
                                                    </td>
                                                    {{-- <td>{{ $item->auditable_type }} (id: {{ $item->auditable_id }})</td> --}}
                                                    <td>{{ $item->event }}</td>

                                                    <td>
                                                        @if ($item->user)
                                                            {{ $item->user->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                                    <td>{{ $item->created_at->format('H:i:s') }}</td>
                                                    <td>
                                                        @if ($item->old_values)
                                                            <table class="table">
                                                                @foreach ($item->old_values as $attribute => $value)
                                                                    <tr>
                                                                        <td><b>{{ $attribute }}</b></td>
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
                                                                        <td><b>{{ $attribute }}</b></td>
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


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>



@endsection
@section('scripts')
