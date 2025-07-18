@extends('NEW.NON.layout')
@section('page_title')
    FAQ
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h1>Widge</h1>
                </div>
                <div class="col-sm-7">
                    <div class="row">
                        <div class="col-md-2">
                            <select class="form-control select2" id="fyear">
                                <option value="">Select Year</option>
                                @foreach ($yearfinal as $item)
                                    <option value="{{ $item->year }}">{{ $item->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control select2" id="fmonth">
                                <option value="">Select Year</option>
                                @foreach ($months as $item)
                                    <option value="{{ $item->mName }}">{{ $item->mName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control select2" id="votes">
                                <option value="">Select Vote</option>
                                @foreach ($votes as $item)
                                    <option value="{{ $item->id }}">{{ $item->votename }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="daterange-btn" name="daterange">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary" onclick="getData()">Fetch</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container">
            <h5 class="mb-1">Statistics</h5>
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
        let chart;

        function getData() {
            var votes = document.getElementById('votes').value

            var seldate = document.getElementById('daterange-btn').value
            var from = seldate.split('-')[0]
            var Todate = seldate.split('-')[1]
            var FinalFrom = ""
            var FinalTo = ""
            if (new Date(from).getMonth() < 10 && new Date(from).getDate() < 10) {
                FinalFrom = new Date(from).getFullYear() + "-0" + parseInt((new Date(from).getMonth() + 1)) + "-0" +
                    new Date(from).getDate()
            } else if (new Date(from).getMonth() < 10 && new Date(from).getDate() > 9) {
                FinalFrom = new Date(from).getFullYear() + "-0" + parseInt((new Date(from).getMonth() + 1)) + "-" +
                    new Date(from).getDate()
            } else if (new Date(from).getMonth() > 9 && new Date(from).getDate() < 10) {
                FinalFrom = new Date(from).getFullYear() + "-" + parseInt((new Date(from).getMonth() + 1)) + "-0" +
                    new Date(from).getDate()
            } else {
                FinalFrom = new Date(from).getFullYear() + "-" + parseInt((new Date(from).getMonth() + 1)) + "-" + new Date(
                    from).getDate()
            }

            if (new Date(Todate).getMonth() < 10 && new Date(Todate).getDate() < 10) {
                FinalTo = new Date(Todate).getFullYear() + "-0" + parseInt((new Date(Todate).getMonth() + 1)) + "-0" +
                    new Date(Todate).getDate()
            } else if (new Date(Todate).getMonth() < 10 && new Date(Todate).getDate() > 9) {
                FinalTo = new Date(Todate).getFullYear() + "-0" + parseInt((new Date(Todate).getMonth() + 1)) + "-" +
                    new Date(Todate).getDate()
            } else if (new Date(Todate).getMonth() > 9 && new Date(Todate).getDate() < 10) {
                FinalTo = new Date(Todate).getFullYear() + "-" + parseInt((new Date(Todate).getMonth() + 1)) + "-0" +
                    new Date(Todate).getDate()
            } else {
                FinalTo = new Date(Todate).getFullYear() + "-" + parseInt((new Date(Todate).getMonth() + 1)) + "-" +
                    new Date(Todate).getDate()
            }

            if (votes) {

                $.ajax({
                    url: "{{ route('fetch-chart') }}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        'vote_id': votes,
                        'from': FinalFrom,
                        'to': FinalTo,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        const vote = data.votes
                        const votedata = data.final
                        const ctx = document.getElementById('barChart').getContext('2d')
                        console.log(votedata)
                        if (chart) {
                            chart.destroy();
                        }
                        chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Active', 'Inactive'],
                                datasets: [{
                                    label: `Statistics of ${vote}`,
                                    data: [
                                        2,5
                                        // votedata.Active, votedata.Inactive
                                    ],
                                    backgroundColor: ['rgb(255,99,132)', 'rgb(54,162,235)'],
                                    borderWidth: 1,

                                    borderColor: 'rgba(60,141,188,0.8)',
                                    pointRadius: false,
                                    pointColor: '#3b8bba',
                                    pointStrokeColor: 'rgba(60,141,188,1)',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                datasetFill:false,
                                legend: {
                                    display: true
                                },

                                scales: {
                                    xAxes: [{
                                        gridLines: {
                                            display: true,
                                        }
                                    }],
                                    yAxes: [{
                                        gridLines: {
                                            display: true,
                                        },
                                        beginAtZero: true
                                    }]
                                }



                             }
                        })
                        console.log(data.final)
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            } else {
                alert(" Select a vote")
            }

        }
    </script>
    {{-- <script src="{{ asset('system/pagespecific/charts.js') }}"></script> --}}
@endsection
