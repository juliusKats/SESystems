@extends('NEW.NON.layout')
@section('page_title')
    Establishment
@endsection
@section('content')

    <div class="content-header"></div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header bg-primary text-center">
                            Search Item
                        </div>
                        <div class="card-body">
                            <button id="btnSearch" class="btn btn-success btn-lg">Search</button>
                            <hr />
                            <div id="searchCriteria" hidden>
                                <div>
                                    <input id="VC" type="radio" name="customRadio"
                                        style="width:20px;height:20px;">&nbsp;&nbsp;
                                    <label style="font-size: 20px;">Vote Code</label>
                                </div>
                                <div>
                                    <input id="VN" type="radio" name="customRadio"
                                        style="width:20px;height:20px;">&nbsp;&nbsp;
                                    <label style="font-size: 20px;">Vote Name</label>
                                </div>
                                <div>
                                    <input id="VD" type="radio" name="customRadio"
                                        style="width:20px;height:20px;">&nbsp;&nbsp;
                                    <label style="font-size: 20px;">Upload Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div hidden id="VCCriteria" class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <select id="VCSelect" name="votecode" class="select2 form-control" required>
                                    <option value="">Select Vote Vode</option>
                                    @foreach ($votes as $item)
                                        <option value="{{ $item->id }}">{{ $item->votecode }}-{{ $item->votename }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input id="VCInput" name="votename" type="text" readonly placeholder="Vote Name"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="btnsearchA" type="submit" value="Search" class="btn btn-success">
                            </div>

                        </div>
                    </div>

                    <div hidden id="VNCriteria" class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <select id="VNameSelect" name="votecode" class="select2 form-control" required>
                                    <option value="">Type Vote Name</option>
                                    @foreach ($votes as $item)
                                        <option value="{{ $item->id }}">{{ $item->votename }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input id="btnsearchB" type="submit" value="Search" class="btn btn-success">
                            </div>

                        </div>
                    </div>

                    <div hidden id="VDCriteria" class="card">
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" id="daterange-btn" name="daterange">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="btnsearchC" type="submit" value="Search" class="btn btn-success">
                            </div>

                        </div>
                    </div>

                </div>


                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Fetch All</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="establishment">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-center"> #</th> --}}
                                            <th>Vote Details</th>
                                            {{-- <th>Excel Name</th> --}}
                                            <th>PDF File</th>
                                            <th>PS Approved Date</th>
                                            <th>Action</th>
                                            {{--   <th>Approved On</th>     --}}
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">

                                        @foreach ($files as $key => $item)
                                            <?php

                                            $upload = \Carbon\Carbon::parse($item->ApprovedOn)->format('M d, Y');
                                            if ($item->PDF) {
                                                $Yr = explode('_', $item)[3];
                                                $Month = explode('_', $item)[2];
                                                $PDFsize = Number::fileSize(File::size('storage/Votes/' . $Yr . '/' . $Month . '/PSPDF/' . $item->PDF));
                                                $PDFext = File::extension('storage/Votes/' . $Yr . '/' . $Month . '/' . $item->PDF);
                                                $finalPDF = explode('_', $item->PDF)[5];
                                            }

                                            ?>

                                            <tr>
                                                <td><a href="#">{{ $item->votecode }} -{{ $item->VoteName }}</a>
                                                </td>

                                                <td>


                                                    <a style="display: inline"
                                                        href="{{ route('preview.ps.file', $item->id) }}"
                                                        title="Preview {{ $item->pdfOriginal }}" target="_blank">
                                                        <i style="color: red; font-size: 30px;" class="far fa-file-pdf"></i>
                                                        {{ $finalPDF }} &nbsp;&nbsp;
                                                        -{{ $PDFsize }}
                                                    </a>

                                                </td>

                                                <td>
                                                    {{ $upload }}</td>
                                                <td>

                                                    <div class="dropdown mt-1 btn-sm">
                                                        <button class="btn btn-danger btn-sm dropdown-toggle" href="#"
                                                            role="button" data-toggle="dropdown" arial-haspopup="true"
                                                            arial-expanded="false">
                                                            Action
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('preview.ps.file', $item->id) }}"
                                                                class="btn btn-primary ml-2" target="_blank">Preview
                                                                PDF</a>
                                                            <a target="_blank"
                                                                href="{{ route('download.ps.file', $item->id) }}"
                                                                class="btn btn-success mt-2 ml-2">Dowload PDF</a>
                                                        </div>

                                                    </div>
                                                </td>





                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var searchcriteria = document.getElementById('searchCriteria')
        var vccriteria = document.getElementById('VCCriteria')
        var vncriteria = document.getElementById('VNCriteria')
        var vdcriteria = document.getElementById('VDCriteria')
        var votename = document.getElementById('VCInput')
        var tbody = document.getElementById('tbody')
        $('#btnSearch').on('click', function() {
            searchcriteria.removeAttribute('hidden', 'hidden')

        })
        $('#VC').on('click', function() {
            vccriteria.removeAttribute('hidden', 'hidden')
            vncriteria.setAttribute('hidden', 'hidden')
            vdcriteria.setAttribute('hidden', 'hidden')
        });
        $('#VN').on('click', function() {
            vncriteria.removeAttribute('hidden', 'hidden')
            vccriteria.setAttribute('hidden', 'hidden')
            vdcriteria.setAttribute('hidden', 'hidden')
        });
        $('#VD').on('click', function() {
            vdcriteria.removeAttribute('hidden', 'hidden')
            vncriteria.setAttribute('hidden', 'hidden')
            vccriteria.setAttribute('hidden', 'hidden')
        });
        $('#VCSelect').on('change', function() {
            var VoteId = $(this).val()

            $.ajax({
                url: "{{ route('fetch-vote') }}",
                type: 'GET',
                data: {
                    'vote_id': VoteId,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(result) {
                    console.log(result)
                    console.log(result.vote.length)
                    // if (result.vote.length != 0) {
                    $.each(result.vote, function(key, value) {
                        votename.value = value.votename
                    })
                    // }
                },
                error: function(error) {
                    alert(error)
                }
            })
        })

        $("#btnsearchA").on('click', function() {
            var code = document.getElementById('VCSelect').value;
            // alert(code)
            if (code == "") {
                alert('Select Enter or Select A valid vote Code')
            } else {
                $.ajax({
                    url: "{{ route('fetch-establishment') }}",
                    type: 'GET',
                    data: {
                        'votecode': code,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        $('#tbody').empty()
                        // console.log(result.vote.length)
                        // if (result.vote.length != 0) {
                        // $.each(result.vote, function(key, value) {
                        //     votename.value = value.votename
                        // })
                        // }
                    },
                    error: function(error) {
                        alert(error)
                    }
                })
            }
        })
        $("#btnsearchB").on('click', function() {
            var name = document.getElementById('VNameSelect').value;
            if (name == "") {
                alert('Select Enter or Select A valid vote Name')
            } else {
                $.ajax({
                    url: "{{ route('fetch-establishment') }}",
                    type: 'GET',
                    data: {
                        'votecode': name,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        console.log(result.file.length)
                        if (result.vote.length > 0) {
                            // $.each(result.vote, function(key, value) {
                            //     votename.value = value.votename
                            // })
                        }
                    },
                    error: function(error) {
                        alert(error)
                    }
                })
            }
        })
        $("#btnsearchC").on('click', function() {
            var dates = document.getElementById('daterange-btn').value;
            var from = dates.split("-")[0];
            var to = dates.split("-")[1]; // YMD
            var fromSQL = from.split("/")[2].split(' ')[0] + "-" + from.split("/")[1] + "-" + from.split("/")[0]
            var toSQL = to.split("/")[2].split(' ')[0] + "-" + to.split("/")[1] + "-" + to.split("/")[0].split(' ')[
                1]
            // alert(toSQL)
            if (dates == "") {
                alert('Select Enter or Select A valid date')
            } else {
                $.ajax({
                    url: "{{ route('fetch-establishment') }}",
                    type: 'GET',
                    data: {
                        'fromDate': fromSQL,
                        'toDate': toSQL,
                        _token: '{{ csrf_token() }}',
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        console.log(result.file.length)
                        // var htm='<tr><td></td><td></td><td></td><td>Action</td></tr>';
                        if (result.file.length > 0) {

                            $.each(result.file, function(key, value) {
                                var row = '<tr>'
                                row += '<td>' + value.votecode + "-" + value.VoteName + '</td>'
                                row += '<td>' + value.PDF.split('_')[5] + '</td>'
                                row += '<td>' + value.ApprovedOn + '</td>'
                                row += '<td>' + value.id + '</td>'
                                row += '</tr>'
                                $('#tbody').append((row))
                            })




                        }
                    },
                    error: function(error) {
                        alert('invalid')
                    }
                })
            }
        })
    </script>
@endsection
