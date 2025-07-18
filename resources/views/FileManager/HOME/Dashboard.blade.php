@extends('NEW.NON.layout')
@section('page_title')
    HOME
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <h1>Widge</h1>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Document Type</label>
                        <select class="form-control select2" id="entity">
                        <option value="">Document Type</option>
                        @foreach ($entities as $item)
                            <option value="{{$item->eName}}">{{$item->eName}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    {{-- <input type="date" id="disp"> --}}
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" class="form-control" id="start" name="startdate">

                    </div>

                </div>
                <div class="col-sm-2">
                    {{-- <input type="date" id="disp"> --}}
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control" id="end" name="enddate">

                    </div>

                </div>

                <div class="col-sm-2">
                    <div class="form-group justify-content-center align-item-center"><br>
                    <button class="btn btn-primary" onclick="getData()">Fetch</button>
                    </div>
                </div>
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container">
            <h5 class="mb-1">Statistics</h5>
            {{-- @auth --}}
            @if(Auth::user() and (Auth::user()->role =='admin' or Auth::user()->role =="superadmin"))
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>UPLOADED</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-upload" style="color:green;border-radius:100%"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53</h3>
                            <p>Approved</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle" style="color:blue"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>Pending Approval</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Rejected</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-ban" style="color:red;border-radius:100%"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            @endif
             {{-- @endauth --}}

            <div class="row">

                <div class="col-md-12">
                    <!-- BAR CHART -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Bar Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </section>


    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
@endsection
@section('scripts')
    <script>
        $('#pickdate').on('click', function() {
            $('#daterange-btn').trigger('click');
        })
        let chart;

        function getData() {
            var entity = document.getElementById('entity').value
            var startdate = document.getElementById('start').value
            var enddate = document.getElementById('end').value
            if(enddate<startdate){
                alert(" Inallid strart date or end date selected")
            }

            if (entity == "") {
                alert("Select Entity")
            } else if (entity == "Establishment") {
                $entity = "Establishment"
                $.ajax({
                    url: "{{ route('fetch-test') }}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'entity': entity,
                        'from': startdate,
                        'to': enddate,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(results) {
                        console.log(results)
                    },
                    error: function(error) {
                        console.log(error)
                    }

                })
            } else if (entity == "Scheme Of Service") {
                alert(" I am Scheme Of Service")
            } else if (entity == "RAPEX Documents") {
                alert(" I am Rapex")
            } else {
                alert(" Iam Jobs Description")
            }




            // if (votes) {

            //     $.ajax({
            //         url: "{{ route('fetch-chart') }}",
            //         method: 'GET',
            //         dataType: 'json',
            //         data: {
            //             'vote_id': votes,
            //             'from': FinalFrom,
            //             'to': FinalTo,
            //             _token: '{{ csrf_token() }}',
            //         },
            //         success: function(data) {
            //             const vote = data.votes
            //             const votedata = data.final
            //             const ctx = document.getElementById('barChart').getContext('2d')
            //             console.log(votedata)
            //             if (chart) {
            //                 chart.destroy();
            //             }
            //             chart = new Chart(ctx, {
            //                 type: 'bar',
            //                 data: {
            //                     labels: ['Active', 'Inactive'],
            //                     datasets: [{
            //                         label: `Statistics of ${vote}`,
            //                         data: [
            //                             2, 5
            //                             // votedata.Active, votedata.Inactive
            //                         ],
            //                         backgroundColor: ['rgb(255,99,132)', 'rgb(54,162,235)'],
            //                         borderWidth: 1,

            //                         borderColor: 'rgba(60,141,188,0.8)',
            //                         pointRadius: false,
            //                         pointColor: '#3b8bba',
            //                         pointStrokeColor: 'rgba(60,141,188,1)',
            //                         pointHighlightFill: '#fff',
            //                         pointHighlightStroke: 'rgba(60,141,188,1)',
            //                     }]
            //                 },
            //                 options: {
            //                     responsive: true,
            //                     maintainAspectRatio: false,
            //                     datasetFill: false,
            //                     legend: {
            //                         display: true
            //                     },

            //                     scales: {
            //                         xAxes: [{
            //                             gridLines: {
            //                                 display: true,
            //                             }
            //                         }],
            //                         yAxes: [{
            //                             gridLines: {
            //                                 display: true,
            //                             },
            //                             beginAtZero: true
            //                         }]
            //                     }



            //                 }
            //             })
            //             console.log(data.final)
            //         },
            //         error: function(error) {
            //             console.log(error)
            //         }
            //     })
            // } else {
            //     alert(" Select a vote")
            // }

        }
    </script>
    {{-- <script src="{{ asset('system/pagespecific/charts.js') }}"></script> --}}
@endsection
