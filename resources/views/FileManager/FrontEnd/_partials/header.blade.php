<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <script>
    window.history.forward();
    function noBack(){
        window.history.forward();
    }
  </script>

   <link href="{{ asset('system/Default/logo.png') }}" alt=""  rel="icon">
   <link href="{{ asset('system/Default/logo.png') }}" alt="" rel="apple-touch-icon">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{ asset('system/plugins/fontawesome-free/css/all.min.css')}}">
   <link rel="stylesheet" href="{{ asset('system/dist/css/adminlte.min.css')}}">
  <link href="{{ asset('system/frontEnd/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('system/frontEnd/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
   <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('system/plugins/fontawesome-free/css/all.min.css')}}">

  <link href="{{ asset('system/frontEnd/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('system/frontEnd/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('system/frontEnd/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('system/frontEnd/css/main.css')}}" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('system/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('system/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('system/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('system/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('system/plugins/toastr/toastr.min.css') }}">

</head>
