<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

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
        body {
            font-family: 'Gelasio', serif;
            transition: background-color .5s;
        }

        .navbar {
            background-color: #263238;
            color:#BBD2C5;
        }
        .navbar a {
            color:#fff;
        }
        .navbar a:hover {
            color:#BBD2C5;
        }
        /*   .......... sidebar     .... */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #263238;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 46px;
        }

        .sidenav a,.sidenav .dropdown-btn {
            padding: 8px 8px 8px 12px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: block;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            outline: none;
            width: 100%;
            transition: 0.3s;
        }
        .sidenav .ap{
            padding-top: 16px;
        }

        .sidenav a:hover,.sidenav .dropdown-btn:hover {
            color: #000000;
            background-color: #cae8bf;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            font-size: 26px;
            margin-left: 200px;
        }

        .sidenav .active {
            background-color: #BBD2C5;
            color: #000000;
        }

        #mySidenav {
            box-shadow: 6px 1px 7px #526b729e;
        }

        .sidenav .dropdown-container {
            display: none;
            background-color: #526b72;
            padding-left: 8px;
        }

        .sidenav .fa-caret-down {
            float: right;
            padding-right: 6px;
            padding-top: 6px;
        }

        #main {
            transition: margin-left .5s;

        }
        .myclass{
            font-size: 20px;
        }


        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        /*    ................................                */

          /* Fake image */
          .fakeimg {
            background-color: #aaa;
            width: 100%;
            padding: 20px;
        }

        /* Add a card effect for articles */
        .card {
            background-color: white;
            padding: 10px;
            margin-top: 6px;
        }


        /* ----------------select cart--------------------*/

        .column {
            float: right;
            width: 21.7%;
            margin-bottom: 6px;
            padding: 0 8px;
            margin-left:45px;
            margin-top:10px;
        }

        @media screen and (max-width: 650px) {
        .column {
            width: 100%;
            display: block;
        }
        }

        .title {
          color: grey;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #263234;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
        background-color: #556;
        }

        /* featured-categories */
        .featured-categories {
            margin:15px 0;
        }
        .featured-categories img {
            width:100%;
            padding:15px 0;
            transition:1s;
            cursor: pointer;
        }
        .featured-categories img:hover {
            transform : scale(1.1);
        }
        /* on-sale */
        .title-box {
            background: #526b72;
            color:#fff;
            width:180px;
            padding: 4px 10px;
            height:40px;
            margin-bottom:30px;
            display:flex;
        }
        .title-box h2 {
            font-size:24px;
        }
        .title-box::after {
            content: '';
            border-top: 40px solid #526b72;
            border-right: 50px solid transparent;
            position:absolute;
            display:flex;
            margin-top: -4px;
            margin-left: 170px;
        }
        /* product-top */
        .product-top img {
            width:100%;
            height:300px;
        }
        .overlay-right {
            display:block;
            opacity:0;
            position:absolute;
            top:10%;
            margin-left: 0;
            width:70px;
        }
        .overlay-right .fa {
            cursor: pointer;
            background-color:#fff;
            color:#000;
            height:35px;
            width:35px;
            font-size:20px;
            padding:7px;
            margin-top:5%;
            margin-bottom:5%;
        }
        .overlay-right .btn-secondary {
            background:none !important;
            border:none !important;
            box-shadow:none !important;
        }
        .product-top:hover .overlay-right {
            opacity:1;
            margin-left:5%;
            transition:0.5s;
        }
        /* product-bottom */
        .product-bottom .fa {
            color:orange;
            font-size:10px;
        }
        .product-bottom h3 {
            font-size:20px;
            font-weight:bold;
        }
        .product-bottom h5 {
            font-size:15px;
            padding-bottom:10px;
        }
        .new-products {
            margin: 15px 0;
        }
        /* website-features */
        .website-features {
            margin:20px 0;
        }
        .feature-text {
            margin-top: 10px;
            float: right;
            width: 80%;
            padding-left:20px;
            color:#E2E2E2;

        }
        .feature-box {
            padding-top:20px;
        }

        /* show product */
        .single-product img {
            height: 370px;
            width: 300px;

        }
        .single-product {
            margin-top: 50px;
        }
        .new-saly {
            background: #669b10;
            width: 12%;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            margin-top: 18px;
        }
        .col-md-7 h2 {
            color : #555;
        }
        .col-md-7 .fa {
            color:orange;
            font-size:20px;
        }
        .single-product .price {
            text-decoration-line: line-through;
            color:red;
        }
        .single-product .price-discount {
            color: orange;
            font-size: 18px;
            font-weight: bold;
        }
        .single-product input {
            border: 1px solid #ccc;
            font-weight: bold;
            height: 33px;
            text-align: center;
            width: 30px
        }
        .single-product .btn-primary {
            background: #263238 !important;
            color: #fff;
            font-size: 15px;
            margin-left: 20px;
            border: none;
            box-shadow: none !important;
        }
        .product-description h6 {
            background: #526b72;
            color:#fff;
            width:19%;
            padding: 6px 4px;
            height:30px;
            margin-bottom:30px;
            text-align: center;
            font-size: 18px;
        }
        .product-description hr {
            margin-bottom:50px;
            margin-top:30px;
        }


        /* Footer */
        .footer {
            margin-top: 50px;
            background-color: #263238;
            color:#fff;
        }
        .footer h1 {
            font-size:15px;
            margin:25px 0;
        }
        .footer a {
            text-decoration: none;
            font-size: 12px;
            color: #fff;
            display: block;
            padding-bottom: 15px;
        }

        .footer a:hover {
           color: red;
        }
        .copyright {
            margin-bottom: -80px;
            text-align: center;
            font-size: 15px;
            padding-bottom: 20px;
        }
        .fa-heart-o {
            color:red;
            font-size: 15px;
        }
        .footer hr {
            margin-top: 10px;
            background-color: #ccc;
        }
        .footer-image img {
            width: 150px;
        }
        .footer .row .fa {
            padding-right:6px;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 800px) {
            .leftcolumn, .rightcolumn {
                width: 100%;
                padding: 0;
            }
        }

         /* dropdown-menu */
        .dropdown-menu {
            background-color: #f1a51be3;
        }
        .dropdown-menu a:hover {
            color: #263238;
            font-size:16px;
        }
        /* dropdown size products */
        .dropbtn {
            background-color: #263238 ;
            color: white;
            padding: 5px;
            font-size: 15px;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            width:110%;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #202326eb;;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: orange;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover { background-color: #ffa50094 ; color: #000; }

        .dropdown:hover .dropdown-content { display: block; }

        .dropdown:hover .dropbtn { background-color: #000; }


    </style>
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
                         <a class="nav-link" href="#"><i class="fa fa-shopping-basket" style="font-size:20px;color:orange"></i> Cart</a>
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



    <main class="py-4 content" id="content" >
        @yield('content')
    </main>

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
        document.getElementById("content").style.marginLeft = "250px";

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
</script>
</body>
</html>
