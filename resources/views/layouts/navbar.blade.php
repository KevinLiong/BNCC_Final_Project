<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- My Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- <title>Hello, world!</title> --}}
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            @auth
              @if(Auth::user()->isAdmin==true)
                <a class="navbar-brand" href="/admin/products">Swift Mart</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <li class="nav-item">
                  <a class="nav-link active" href="/admin/products">View Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="/admin/products/create">Create Product</a>
              </li>
              @endif
    
              @if(Auth::user()->isAdmin==false)
                <a class="navbar-brand" href="/products">Swift Mart</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <li class="nav-item">
                    <a class="nav-link active" href="/products">View Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/cart">Cart</a>
                </li>
              @endif
            @endauth
         </ul>

        <div class="d-flex align-items-center ms-auto">
            @auth
                <div class="navbar-text me-3">
                    Logged in as: {{ Auth::user()->name }}
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout" method="post">Logout</a>
                    </li>
                </ul>
            @endauth
        </div>
      </nav>
    
      <div class="container mt-4">
        @yield('container')
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>