<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>
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

    <link href="{{ asset('css/user.css') }}" rel="stylesheet">

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-messaging.js"></script>
    <link rel="manifest" href="manifest.json">

</head>
<style>
    li{
        margin-right: 15px;
    }
</style>
<body>
<div id="app">
    <nav class="navbar navbar-expand-sm sticky-top">
        <div class="container-fluid">
            <div class="navbar-header">
                {{--<div id="mySidenav" class="sidenav">--}}
                {{--<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>--}}

                {{--<a class="ap" href="#"><i class="fa fa-home" style="font-size:24px"></i> Home</a>--}}
                {{--<a href="#"><i class="fa fa-user-circle-o" style="font-size:24px"></i> Profile</a>--}}
                {{--<a href="#"><i class="fa fa-gear" style="font-size:24px"></i> Settings</a>--}}
                {{--<a href="#"><i class="fa fa-times-rectangle" style="font-size:24px"></i> Delete Products</a>--}}
                {{--<button class="dropdown-btn"><i class="fa fa-handshake-o" style="font-size:24px"></i> Company--}}
                {{--<i class="fa fa-caret-down"></i>--}}
                {{--</button>--}}
                {{--<div class="dropdown-container">--}}
                {{--<a href="#">Show Companies</a>--}}
                {{--<a href="#">Add New Company</a>--}}
                {{--<a href="#">Delete Company</a>--}}
                {{--</div>--}}
                {{--<button class="dropdown-btn"><i class="fa fa-group" style="font-size:24px"></i> Customer--}}
                {{--<i class="fa fa-caret-down"></i>--}}
                {{--</button>--}}
                {{--<div class="dropdown-container">--}}
                {{--<a href="#">Show Customer</a>--}}
                {{--<a href="#">Delete Customer</a>--}}
                {{--</div>--}}
                {{--<button class="dropdown-btn"><i class="fa fa-first-order" style="font-size:24px"></i> Orders--}}
                {{--<i class="fa fa-caret-down"></i>--}}
                {{--</button>--}}
                {{--<div class="dropdown-container">--}}
                {{--<a href="#">Show Orders</a>--}}
                {{--<a href="#">Show Old Orders</a>--}}
                {{--</div>--}}

                {{--</div>--}}
                {{--<span class="myclass" style="cursor: pointer;font-size:26px" onclick="openNav()">&#9776;</span>--}}
                <a class="navbar-brand" id="main" style="padding-left: 40px" href="{{ url('/admin') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    {{--search--}}
                    <li class="nav-item mr-lg-2">
                        <form method="POST" action="{{ route('searchBtn') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">

                                    <select class="custom-select" id="inputGroupSelect01" name="category" required>
                                        <option disabled selected value>Choose Category</option>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <input class="form-control" type="text" name="choice" placeholder="Search.." required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                    </li>


                    <!-- Authentication Links -->
                    <li class="nav-item">
                        {{--<a class="nav-link" href="#"><i class="fa fa-language" style="font-size:20px;color:orange"></i> Language</a>--}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}" title="Cart"><i class="fa fa-shopping-basket"
                                                                          style="font-size:20px;color:orange"></i>
                            <span class="badge badge-pill badge-danger">{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}"><i class="fa"
                                                                          style="font-size:20px;color:orange"></i> Shopping</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recommendation') }}"><i class="fa"
                                                                          style="font-size:20px;color:orange"></i> Get Recommendation</a>
                    </li>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        {{ __('Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            @endguest

                </ul>
            </div>
        </div>
    </nav>


    <main class="py-4 content" id="content">
        @yield('content')
    </main>

    <div class="footer">

        <section class="website-features">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 feature-box">
                        <i class="fa fa-tachometer" style="font-size:50px"></i>
                        <div class="feature-text">
                            <p><b>100% Original item</b> are available at company</p>
                        </div>
                    </div>

                    <div class="col-md-4 feature-box">
                        <i class="fa fa-truck" style="font-size:50px"></i>
                        <div class="feature-text">
                            <p><b>Get free delivery for every</b> order on more than price.</p>
                        </div>
                    </div>

                    <div class="col-md-4 feature-box">
                        <i class="fa fa-retweet" style="font-size:47px"></i>
                        <div class="feature-text">
                            <p><b>Return within 3 days</b> of receiving your order.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!------------              --------------------------->
        <section class="footer">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-3">
                        <h1>Useful Links</h1>
                        <a href="">Profile</a>
                        <a href="">On Sale</a>
                        <a href="">Cart</a>
                    </div>
                    <div class="col-md-3">
                        <h1>Company</h1>
                        <a href="">About Us</a>
                        <a href="">Contact Us</a>
                        <a href="">Career</a>
                    </div>
                    <div class="col-md-3">
                        <h1>Follow Us On</h1>
                        <a href=""><i class="fa fa-facebook-official" style="font-size:17px;"></i> Facebook</a>
                        <a href=""><i class="fa fa-instagram" style="font-size:17px"></i> Instagram</a>
                        <a href=""><i class="fa fa-telegram" style="font-size:17px"></i> Telegram</a>
                    </div>
                    <div class="col-md-3 footer-image">
                        <h1>Download App</h1>
                        <img src="{{ asset('images/apps.jpg') }}">
                    </div>
                </div>
                <hr>
                <p class="copyright">Smart Market <i class="fa fa-heart-o"></i></p>
            </div>
        </section>
    </div>

</div>

<script src="{{ asset('js/firebase.js') }}"></script>


<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.getElementById("content").style.marginLeft = "250px";

    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("content").style.marginLeft = "0";
        document.body.style.backgroundColor = "white";
    }

    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
</body>
</html>
