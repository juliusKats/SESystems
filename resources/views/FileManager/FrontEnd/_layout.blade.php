
<!DOCTYPE html>
<html lang="en">

@include('FileManager.FrontEnd._partials.header')

<body class="starter-page-page">


  <main class="main">
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('system/frontEnd/img/logo.webp') }}" alt="">
        <h1 class="sitename">EBRDS</h1>
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
