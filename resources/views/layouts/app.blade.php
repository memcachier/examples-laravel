<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>MemCachier Laravel Tutorial</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"
          rel='stylesheet' type='text/css'>

    <!-- CSS  -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

  </head>

  <body>
    <div class="container">
      <nav class="navbar navbar-default">
        <!-- Navbar Contents -->
      </nav>
    </div>

    @yield('content')

    <!-- JavaScripts -->
    <script src="{{ elixir('js/app.js') }}"></script>
  </body>
</html>
