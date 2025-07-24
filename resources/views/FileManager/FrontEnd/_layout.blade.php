
<!DOCTYPE html>
<html lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

@include('FileManager.FrontEnd._partials.header')

<body class="starter-page-page">


  <main class="main">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('user.entry.page') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        {{-- <img src="{{ asset('system/frontEnd/img/logo.webp') }}" alt=""> --}}
        <img src="{{ asset('system/Default/logo.png') }}" alt="">
        <h1 class="sitename">EDBRS</h1>
      </a>

     @include('FileManager.FrontEnd._partials.navbar')

    </div>
  </header>
    @yield('content')

   </main>


  <!-- Vendor JS Files -->
 @include('FileManager.FrontEnd._partials.footer')
  <!-- Vendor JS Files -->
  @include('FileManager.FrontEnd._partials.scripts')

</body>

</html>
