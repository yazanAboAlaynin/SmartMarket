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
        * {
            box-sizing: border-box;
        }

        body {
            background: #f1f1f1;
        }

        .leftcolumn {
            float: left;
            width: 80%;
        }

        .rightcolumn {
            float: left;
            width: 20%;
            padding-left: 6px;
        }

        /* Fake image */
        .fakeimg {
            background-color: #aaa;
            width: 100%;
            padding: 20px;
        }

        /* Add a card effect for articles */
        .card {
            background-color: white;
            padding: 20px;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* sidbar */

        .card .sidenav {
            height : 371px;
        }

        .sidenav {
            top: 20px;
            left: 10px;
            z-index:1;
            background-color: #aaa;
            padding: 8px 0;
            box-shadow: 1px 1px 4px 1px rgba(0, 0, 0, 0.5);
        }

        .sidenav ul {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 18px;
            color: #000;
            display: block;
        }

        .sidenav ul li {
            list-style-type: none;
            font-weight: bold;
            margin-top: 10px;
            cursor: pointer;
        }

        .sidenav  ul li:hover {
            color: #064579;
        }
        .sidenav  ul li ul {
            display: none;
            z-index: 10;

        }
        .sidenav  ul li:hover ul {
            display: block;
            height: 20%;
            margin-left: 15.2%;
            margin-top: -12px;
            padding: 0 16px 8px 8px;
            position: fixed;
            background: #ececec;
            box-shadow: 1px 1px 4px 1px rgba(0, 0, 0, 0.5);
        }
        .fa-angle-right {
            margin-top: 4px;
            margin-right: 8px;
            float: right;
        }

        .sidenav a {
            text-decoration: none;
            font-size: 18px;
            color: #000;
            display: block;
        }

        .sidenav a:hover {
            color: #064579;
        }
        #menu-btn-open , #menu-btn-close {
            font-size: 25px;
            color : orange;
            display:none;
            float:right;
            margin-right: 6px;
            margin-bottom: 6px;
        }

        #menu-btn-open:hover , #menu-btn-close:hover {
            background: #000;
        }

        @media only screen and (max-width:980px) {

            .sidenav {
                width: 66%;
                z-index: 20;
                font-size: 12px;
                display:none;
            }

            .sidenav ul li:hover ul {
                margin-left: 61%;
                margin-top: -12px;
            }
            #menu-btn-open{
                display:block;
            }

        }

        /* ----------------slider--------------------*/

        .slider {
            width: 100%;
            margin-left: 25px;
            padding: 0 60px;
        }
        .slider .carousel-item  {
            max-height: 371px;
        }
        .carousel {
            box-shadow: 1px 1px 4px 1px rgba(0, 0, 0, 0.5);
        }
        .carousel-indicators {
            z-index: 1 !important;
        }
        @media only screen and (max-width:980px) {
            .slider {
                width: 100%;
                margin-left: 0;
            }
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
            background: #000;
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
            border-top: 40px solid #000;
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
        .website-features img {
            width:20%;
        }


        /* Footer */
        .footer {
            padding: 20px;
            text-align: center;
            background: #ddd;
            margin-top: 20px;
        }


        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 800px) {
            .leftcolumn, .rightcolumn {
                width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

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
</div>

<div class="row">
    <div class="rightcolumn">
        <div class="card">
            <div>
                <i class="fa fa-bars" id="menu-btn-open" style="font-size:22px;margin-left: 1px;" onclick="openmenu()"></i>
                <i class="fa fa-times" id="menu-btn-close" style="font-size:22px" onclick="closemenu()"></i>
            </div>
            <div class="sidenav" id="sidenav">

                <ul>
                    <li>On Click <i class="fa fa-angle-right" style="font-size:22px"></i>
                        <ul>
                            <li>categories</li>
                            <li>rr</li>
                        </ul>
                    </li>
                    <li>off Click <i class="fa fa-angle-right" style="font-size:22px"></i>
                        <ul>
                            <li>categories</li>
                            <li>rrmm</li>
                        </ul>
                    </li>
                    <li>On Click <i class="fa fa-angle-right" style="font-size:22px"></i>
                        <ul>
                            <li>categories</li>
                            <li>rr</li>
                        </ul>
                    </li>
                    <li>On Click <i class="fa fa-angle-right" style="font-size:22px"></i>
                        <ul>
                            <li>categories</li>
                            <li>rr</li>
                        </ul>
                    </li>

                    <li> <a href="#"><i class="fa fa-shopping-basket" style="font-size:22px"></i> Card</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="leftcolumn">


        <div class="card">
            <div class="slider">
                <div id="slider" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/storage/2.jpg" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/2.jpg" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/2.jpg" class="d-block w-100">
                        </div>
                        <ol class="carousel-indicators">
                            <li data-target="#slider" data-slide-to="0" class="active"></li>
                            <li data-target="#slider" data-slide-to="1"></li>
                            <li data-target="#slider" data-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!------------------------           ------------------------------------->
        <div class="card">
            <section class="featured-categories">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/storage/2.jpg" >
                        </div>
                        <div class="col-md-4">
                            <img src="/storage/2.jpg">
                        </div>
                        <div class="col-md-4">
                            <img src="/storage/2.jpg">
                        </div>
                        <div class="col-md-4">
                            <img src="/storage/2.jpg">
                        </div>
                        <div class="col-md-4">
                            <img src="/storage/2.jpg">
                        </div>
                    </div>
                </div>
            </section>
            <!-------------------------------             --------------------------------------->
            <section class="on-sale">
                <div class="container">
                    <div class="title-box">
                        <h2>On Sale</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>Watch</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>Watch</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>Watch</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>Watch</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!--------------------------------               --------------------------------------->
            <section class="new-products">
                <div class="container">
                    <div class="title-box">
                        <h2>new Arrivals</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>shoes</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>shoes</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>shoes</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="product-top">
                                <img src="/storage/2.jpg" class="d-block w-100">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-secondary" title="Quick Shop">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to wishlist">
                                        <i class="fa fa-heart-o"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-bottom text-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <h3>shoes</h3>
                                <h5>5000</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!--------------------------------               --------------------------------------->
            <section class="website-features">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 feature-box">
                            <i class="fa fa-tachometer"></i>
                            <div class="feature-text">
                                <p><b>100% Original item</b></p>
                            </div>
                        </div>

                        <div class="col-md-3 feature-box">
                            <i class="fa fa-truck"></i>
                            <div class="feature-text">
                                <p><b>Get free delivery for every</b></p>
                            </div>
                        </div>


                    </div>
                </div>
            </section>

        </div>

    </div>
</div>



<div class="footer">
    <h2>Footer</h2>
</div>





<script>
    function openmenu() {
        document.getElementById("sidenav").style.display="block";
        document.getElementById("menu-btn-open").style.display="none";
        document.getElementById("menu-btn-close").style.display="block";
    }
    function closemenu() {
        document.getElementById("sidenav").style.display="none";
        document.getElementById("menu-btn-open").style.display="block";
        document.getElementById("menu-btn-close").style.display="none";
    }

</script>


</body>
</html>
