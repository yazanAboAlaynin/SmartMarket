<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Gelasio&display=swap" rel="stylesheet">

    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-sm sticky-top">
        <div class="container-fluid">
            <div class="navbar-header" >
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                    <a class="ap" href="#"><i class="fa fa-home" style="font-size:24px"></i> Home</a>
                    <a href="#"><i class="fa fa-user-circle-o" style="font-size:24px"></i> Profile</a>
                    <a href="#"><i class="fa fa-gear" style="font-size:24px"></i> Settings</a>
                    <a href="#"><i class="fa fa-times-rectangle" style="font-size:24px"></i> Delete Products</a>
                    <button class="dropdown-btn"><i class="fa fa-handshake-o" style="font-size:24px"></i> Company
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="#">Show Companies</a>
                        <a href="#">Add New Company</a>
                        <a href="#">Delete Company</a>
                    </div>
                    <button class="dropdown-btn"><i class="fa fa-group" style="font-size:24px"></i> Customer
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="#">Show Customer</a>
                        <a href="#">Delete Customer</a>
                    </div>
                    <button class="dropdown-btn"><i class="fa fa-first-order" style="font-size:24px"></i> Orders
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="#">Show Orders</a>
                        <a href="#">Show Old Orders</a>
                    </div>

                </div>
                <span class="myclass" style="cursor: pointer;font-size:26px" onclick="openNav()">&#9776;</span>
                <a class="navbar-brand" id="main" style="padding-left: 40px" href="{{ url('/admin') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
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
                    <li class="nav-item">
                         <a class="nav-link" href="#"><i class="fa fa-language" style="font-size:20px;color:orange"></i> Language</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="{{ route('cart') }}"><i class="fa fa-shopping-basket" style="font-size:20px;color:orange"></i> Cart
                             <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                         </a>
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


    <div class="row">
        <div class="col-sm-2 leftcolumn">

                <div class=" leftsidenav" id="leftsidenav">

                    <div class="row">
                        <div class="col-12">
                            <h6><b>Category</b></h6>
                            <ul>
                            @foreach($category as $c)

                                    <li> <a href="{{ Route('search',['category',$c->id]) }}"> {{$c->name}} </a></li>

                            @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h6><b>Brand</b></h6>
                            <ul>
                                @foreach($brands as $brand)

                                    <li> <a href="{{ Route('search',['brand',$brand->id]) }}"> {{$brand->name}} </a></li>

                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h6><b>Sellers</b></h6>
                            <ul>
                                @foreach($sellers as $seller)

                                    <li>  <a href="{{ Route('search',['seller',$seller->id]) }}">{{$seller->name}} </a></li>

                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h6><b>Avg. Customer Review</b></h6>
                            <ul>
                                <li> <a href="{{ Route('search',['onRate',4]) }}"> 4 stars & UP </a></li>
                                <li> <a href="{{ Route('search',['onRate',3]) }}"> 3 stars & UP </a></li>
                                <li> <a href="{{ Route('search',['onRate',2]) }}"> 2 stars & UP </a></li>
                                <li> <a href="{{ Route('search',['onRate',1]) }}"> 1 stars & UP </a></li>

                            </ul>
                        </div>
                    </div>

                </div>
       </div>

    <main class="py-4 content rightcolumn" id="content" >
        @yield('content')
    </main>
    </div>
    <div class="footer" >

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
                        <img src="/storage/ggg.jpg">
                    </div>
                </div>
                <hr>
                <p class="copyright">Smart Market <i class="fa fa-heart-o"></i> </p>
            </div>
        </section>
   </div>

</div>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";


    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.getElementById("content").style.marginLeft = "0";
        document.body.style.backgroundColor = "white";
    }

    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }

    function openmenu() {
    document.getElementById("leftsidenav").style.display="block";
    document.getElementById("menu-btn-open").style.display="none";
    document.getElementById("menu-btn-close").style.display="block";
    }
    function closemenu() {
        document.getElementById("leftsidenav").style.display="none";
        document.getElementById("menu-btn-open").style.display="block";
        document.getElementById("menu-btn-close").style.display="none";
    }



</script>
</body>
</html>
