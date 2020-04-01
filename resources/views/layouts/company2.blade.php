<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Gelasio&display=swap" rel="stylesheet">

    <style>
/* profile */
body {
    font-family: 'Gelasio', serif;
    line-height: 1.8;
    color: #818181;
}
h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 600;
    margin-bottom: 15px;
}
h4 {
    font-size: 19px;
    color: #303030;
    font-weight: 400;
    margin-bottom: 15px;
}
.container-fluid {
    padding: 5px 10px;
}
.bg-grey {
    background-color: #cfd8dc;
    height: 250px;
    padding-top: 15px;
}


</style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #3f5c80; z-index: 2">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <nav class="navbar navbar-expand-md shadow-sm navbar-light sticky-top" style="background-color: #b0b6b8;z-index: 1">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="color: #3f5c80;font-weight: bold;font-size: 17px;" href="{{ Route('company.home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #3f5c80;font-weight: bold;font-size: 17px;" href="{{ Route('company.profile')}}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #3f5c80;font-weight: bold;font-size: 17px;" href="{{ Route('company.products')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #3f5c80;font-weight: bold;font-size: 17px;" href="{{ Route('company.orders')}}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #3f5c80;font-weight: bold;font-size: 17px;" href="{{ Route('company.soldItems')}}">Sold Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #3f5c80;font-weight: bold;font-size: 17px;" href="{{ Route('company.add.product')}}">Add Product</a>
                </li>

            </ul>
        </nav>

        <main class="py-4" style="margin-top: 40px">
            @yield('content')
        </main>
    </div>
</body>
</html>
