<!DOCTYPE html>
<html lang="en">

<head>
    @yield('meta_tag')
    @include('NEW._partials.styling.css')
    <style>
        .marquee-container {
            width: 100%;
            background-color: aliceblue;
            padding: 150px, 0;
        }

        .main-content {
            display: flex;
            animation: marquee 20s linear infinite;
        }

        .marquee-item {
            flex: 0 0 auto;
            padding: 0 20px;
            font-size: 1.2rem;
            color: #495057
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .marquee-container:hover .marquee-content {
            animation-play-state: paused;
        }

         .blink {
                animation: blinker 1.5s linear infinite;
                color: red;
                font-family: sans-serif;
                animation-play-state: paused;
            }

            @keyframes blinker {
                10% {
                    opacity: 0;
                }
            }
    </style>
</head>

<body class="hold-transition register-page" style="background-image:  url('{{ asset('system/Default/sys2.jpg') }}')">
    <div class="register-box" style="width:1000px">
         @if (session('success'))
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">{{ session('success') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">{{ session('error') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
        <div class="row">
            <div class="mt-2 marquee-container overflow-hidden bg-light shadow-sm col-md-12 mb-2">
                <div class="marquee-content d-flex align-items-center">
                    <marquee class="blink"  behavior="scroll" direction="left" scrollamount="5" style=" font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; font-weight: bolder; font-size: xx-large;">
                        ELECTRONIC DATA BACKUP AND RECOVERY SYSTEM
                    </marquee>
                     {{--   --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="card-outline card-primary">
                    <div class="card-header text-center text-white">
                        <a href="#" class="h1">Ministry Of Public Service</a>
                    </div>
                    <div class="card-body">
                        Img
                    </div>
                </div>
            </div>
            @yield('auth_content')


        </div>
    </div>
    @include('NEW._partials.styling.scripts')
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
    </script>
    @yield('pgscripts')
</body>

</html>
