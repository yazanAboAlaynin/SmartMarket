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

        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #2c3e50;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 46px;
        }

        .sidenav a,.sidenav .dropdown-btn {
            padding: 8px 8px 8px 12px;
            text-decoration: none;
            font-size: 18px;
            color: #ede7f6;
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
            background-color: #c5cae9;
            color: #000000;
        }

        #mySidenav {
            box-shadow: 6px 1px 7px #526b729e;
        }

        .sidenav .dropdown-container {
            display: none;
            background-color: #75899b42;
            outline: 5px solid #ede7f6;
            padding-left: 8px;
        }

        .sidenav .fa-caret-down {
            float: right;
            padding-right: 6px;
            padding-top: 6px;
        }

        #main {
            transition: margin-left .5s;
            margin-left: 250px;
        }
        .myclass{
            font-size: 20px;
        }

        .content{
            margin-left: 250px;
        }

        .imagesidebar{
            border-radius: 50%;
            padding: 5px;
            margin-left: 6px;
            border: 3px solid;
            box-shadow: 6px 5px 4px 3px #b3e5fc;
        }


        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <div class="navbar-header">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

                    <img class="imagesidebar" src="/storage/ee.jpg" style="width:106px">
<br/><br/>
                    <a class="ap" href="{{ Route('admin.home') }}"><i class="fa fa-home" style="font-size:24px"></i> Home</a>
                    <a href="{{ Route('admin.home') }}"><i class="fa fa-user-circle-o" style="font-size:24px"></i> Profile</a>
                    <a href="{{ Route('admin.home') }}"><i class="fa fa-gear" style="font-size:24px"></i> Settings</a>
                    <a href="#"><i class="fa fa-product-hunt" style="font-size:24px"></i> Products</a>

                    <button class="dropdown-btn"><i class="fa fa-handshake-o" style="font-size:24px"></i> Company
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="{{ Route('admin.vendors') }}"><i class="fa " style="font-size:24px"></i> companies</a>
                        <a href="{{ Route('admin.pendingVendors') }}"><i class="fa " style="font-size:24px"></i> company requests</a>

                    </div>
                    <button class="dropdown-btn"><i class="fa fa-group" style="font-size:24px"></i> Customer
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="{{ Route('admin.users') }}"><i class="fa " style="font-size:24px"></i> Customers</a>

                    </div>
                    <button class="dropdown-btn"><i class="fa fa-first-order" style="font-size:24px"></i> Orders
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="{{ Route('admin.orders') }}"><i class="fa " style="font-size:24px"></i> Orders</a>
                        <a href="{{ Route('admin.oldOrders') }}"><i class="fa " style="font-size:24px"></i> old Orders</a>
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
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
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
