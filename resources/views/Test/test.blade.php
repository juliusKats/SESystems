@extends('layouts._authlayout')
@section('page_title')
    Forgot Password
@endsection
@section('auth_content')
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <form action="#" method="post">
                    @csrf



                    <div class="form-group">
                        <label>Line Ministry</label>
                        <select id="entity" name="entities[]" class="select2 form-control" multiple>
                            <option value=""> Select line ministry</option>
                            @foreach ($lines as $item)
                                <option value="{{ $item->id }}"> {{ $item->entityName }}</option>
                            @endforeach
                        </select>
                        <label id="btnFetch" class="btn btn-sm btn-primary mt-1">Get Institutions</label>
                    </div>


                    <div class="form-group mb-2">
                        <label>Institution Name</label><br>
                        <select id="institute" class=" select2 form-control @error('instittute') is-invalid @enderror" name="institute" multiple>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark float-right">EMAIL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('pgscripts')
    <script>
        $('#btnFetch').on('click', function() {
            var entity = document.getElementById('entity');
            var entity_id = Array.from(entity.selectedOptions).map(option => option.value);
            if (entity_id == "") {
                alert("select item")

            } else {
                $.ajax({
                    // var path =
                    url: "{{ route('fetch-multiple-institution') }}",
                    type: 'GET',
                    dataType: 'json',
                    method: 'GET',
                    data: {
                        'entities': entity_id,
                        // _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        console.log(result)
                        if (result.entity.length > 0) {
                            $('#institute').html('<option = ""> Select Institution</option>')
                            $.each(result.entity, function(key, value) {
                                $('#institute').append('<option = "' + value.id + '">' + value
                                    .institution + '</option>')
                                console.log(key)
                            })
                        }
                    }

                })


            }
        })

        $('#entity').on('change', function() {
            var entity = document.getElementById('entity');
            var entity_id = Array.from(entity.selectedOptions).map(option => option.value);
            if (entity_id == "") {
                alert("select item")

            } else {
                $.ajax({
                    // var path =
                    url: "{{ route('fetch-multiple-institution') }}",
                    type: 'GET',
                    dataType: 'json',
                    method: 'GET',
                    data: {
                        'entities': entity_id,
                        // _token: '{{ csrf_token() }}',
                    },
                    success: function(result) {
                        console.log(result)
                        if (result.entity.length > 0) {
                            $('#institute').html('<option = ""> Select Institution</option>')
                            $.each(result.entity, function(key, value) {
                                $('#institute').append('<option = "' + value.id + '">' + value
                                    .institution + '</option>')
                                console.log(key)
                            })
                        }
                    }

                })


            }
        })



        // $('#btnFetch').on('change', function() {
        //     var entityId = $(this).val()
        //     console.log(entityId)
        //

        // });
    </script>
@endsection
