@extends('NEW.AUTH.layout')
@section('page_title')
    Profile
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Adding User </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <label>Photo</label>
                            <div id="imgpreview">
                                <img style="width:100px;height:100px; border-color: blue; border-width: 2px; border-radius: 100%;"
                                    src="{{ asset('system/Default/defaultuser.jpg') }}">
                            </div>

                            <div class="mt-2">
                                <button id="btnupload" class="btn btn-primary">Select A New Photo</button>

                            </div>
                            <div class="mt-1">
                                <form method="post" enctype="multipart/form-data" action="{{ route('save.user') }}">
                                    @csrf
                                    <input id="file-input" type="file" name="userphoto" accept=".png,.jpg,.jpeg"
                                        class="form-control" style="display: none">

                                    <div class="form-group row mt-1">
                                        {{-- name --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Surname</label>
                                                <input type="text" value="{{ old(sname) }}" name="sname" required placeholder ="Surname Name is required"
                                                    class="form-control @error('sname')is-invalid @enderror">
                                                @error('sname')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" value="{{ old(fname) }}" name="fname" required placeholder ="First Name is required"
                                                        class="form-control @error('fname') is-invalid @enderror">
                                                    @error('fname')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Other Name</label>
                                                    <input type="text" value="{{ old(oname) }}" name="oname" placeholder ="Enter Other Name"
                                                        class="form-control @error('oname') is-invalid @enderror">
                                                    @error('oname')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                        <div class="form-group ">
                                            <label>Positions</label>
                                                <select  name="position" class="form-control select2 @error('fullname') is-invalid @enderror" required>
                                                    <option value="">Select Positon</option>
                                                    @foreach($positions as $position)
                                                    <option value="{{$position->id}}" @if($position->id == old('position')) selected @endif>{{$position->positionName}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    </div>

                                        <div class="form-group row">
                                            <label class="col-md-4">Email</label>
                                            <div class="col-md-8">
                                                <input type="email" required placeholder="johndoe@domain.xxx"
                                                    name="email" value="{{ old('email') }}"
                                                    class="form-control @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Password</label>
                                            <div class="col-md-8">
                                                <input type="password" required placeholder="Enter Password" name="password"
                                                    value="{{ old('password') }}"
                                                    class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Confirm Password</label>
                                            <div class="col-md-8">
                                                <input type="password" required placeholder="Enter Password"
                                                    name="confirmpassword" value="{{ old('confirmpassword') }}"
                                                    class="form-control @error('confirmpassword') is-invalid @enderror">
                                                @error('confirmpassword')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3">Roles</label>
                                            <div class="col-md-9">
                                                <label><input required name="role" style="width:20px;height:20px;"
                                                        value="superadmin" type="radio"> Super Admin</label>
                                                <label><input required name="role" style="width:20px;height:20px;"
                                                        value="admin" type="radio"> Admin</label>
                                                <label><input required name="role" style="width:20px;height:20px;"
                                                        value="ps" type="radio"> HOD</label>
                                                <label><input required name="role" style="width:20px;height:20px;"
                                                        value="user" type="radio"> User</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4">Roles</label>
                                            <div class="col-md-8">
                                                <label><input required name="status" style="width:20px;height:20px;"
                                                        value="1" type="radio"> Active</label>
                                                <label><input required name="status" style="width:20px;height:20px;"
                                                        value="0" type="radio"> Inactive</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value="SAVE" class="btn btn-dark float-right">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('scripts')
    <script>
        $('#btnupload').on('click', function() {
            $('#file-input').trigger('click');
        })
        const img = document.getElementById('file-input')

        img.addEventListener('change', function() {
            getImgData();
        })

        function getImgData() {
            const files = img.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener('load', function() {
                    // imgpreview.setAttribute('class','profile-user-img img-fluid img-circle')
                    imgpreview.style.display = "block"
                    imgpreview.innerHTML = '<img style="width:150px;height:150px;border-radius:100%" src="' + this
                        .result + '" />';
                })
            }
        }


        var twoFactor = document.getElementById('twoFactor')
        var twoWrapper = document.getElementById('twoWrapper')

        $('#btnEnable').on('click', function() {
            twoWrapper.removeAttribute('hidden', 'hidde')
            twoFactor.setAttribute('hidden', 'hidde')
        })
        $('#btnreset').on('click', function() {
            twoWrapper.setAttribute('hidden', 'hidde')
            twoFactor.removeAttribute('hidden', 'hidde')
        })
        $('#btnlogout').on('click', function() {
            // alert("i am logout")
        })
        $('#btndelete').on('click', function() {
            alert("i am logout")
        })
    </script>
@endsection
