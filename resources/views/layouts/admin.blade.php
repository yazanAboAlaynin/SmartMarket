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
    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-messaging.js"></script>
    <link rel="manifest" href="{{ asset('manifest.json') }}" >

</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" >
        <div class="container-fluid">
            <div class="navbar-header">
                <div id="mySidenav" class="sidenav example" >
                    <a href="javascript:void(0)" class="closebtn" style="" onclick="closeNav()">&times;</a>

                    <img class="imagesidebar" src="{{ asset('images/avatar.png') }}" style="width:106px">
<br/><br/>
                    <a class="ap" href="{{ Route('admin.home') }}"><i class="fa fa-home" style="font-size:32px"></i>
                        <span style="margin-left: 30px;">Home</span></a>

                    <a href="{{ Route('admin.products') }}"><i class="fa fa-product-hunt" style="font-size:32px"></i>
                        <span style="margin-left: 30px">Products</span></a>

                    <a href="{{ Route('admin.vendors') }}"><i class="fa fa-signal" style="font-size:24px"></i>
                        <span style="margin-left: 30px">Vendors</span></a>

                    <a href="{{ Route('admin.pendingVendors') }}"><i class="fa fa-briefcase" style="font-size:24px"></i>
                        <span style="margin-left: 30px">Vendors requests</span></a>

                    <a href="{{ Route('admin.users') }}"><i class="fa fa-users" style="font-size:24px"></i>
                        <span style="margin-left: 30px">Customers</span></a>

                    <a href="{{ Route('admin.orders') }}"><i class="fa fa-first-order" style="font-size:24px"></i>
                        <span style="margin-left: 30px">Orders</span></a>

                    <a href="{{ Route('admin.oldOrders') }}"><i class="fa fa-first-order" style="font-size:24px"></i>
                        <span style="margin-left: 30px">Old Orders</span></a>

                    <a href="{{ Route('admin.categories') }}"><i class="fa fa-copyright" style="font-size:24px"></i>
                        <span style="margin-left: 30px">Categories</span></a>

                    <a href="{{ Route('admin.category.add') }}"><i class="fa fa-copyright" style="font-size:24px"></i>
                        <span style="margin-left: 30px">add Category</span></a>

                    <a href="{{ Route('admin.brands') }}"><i class="fa fa fa-delicious" style="font-size:24px"></i>
                        <span style="margin-left: 30px">Brands</span></a>

                    <a href="{{ Route('admin.brand.add') }}"><i class="fa fa-delicious" style="font-size:24px"></i>
                        <span style="margin-left: 30px">add Brand</span></a>
                    <br/>
                    <br/>
                    <br/>
                    <br/>


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
                            <li class="nav-item  dropdown show-order">
                                <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-bell" style="font-size:18px; color: red"></i>
                                    <span class="label number-alert">{{ $numberAlert }}</span>
                                </a>

                                <ul class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <li class="header number-message">
                                        <a class="dropdown-item" href="">
                                            you have {{ $numberAlert }} messages
                                        </a>
                                    </li>
                                    <li>
                                        <ul class="menu list-group order-notification" style="width: 400px; height: 400px; overflow-y: scroll">

                                        </ul>
                                    </li>
                                </ul>
                            </li>
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
<script src="{{ asset('js/firebase.js') }}"></script>
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

<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.show-order').on('click',function () {

            $.ajax({
                url: "{{ route('admin.read.order') }}",
                type: 'post',
                dataType: 'html',
                success: function (data) {
                    //console.log('hhhehfie');
                    $('.order-notification').html(data);
                }
            });
        });
    });
</script>

</body>
</html>
