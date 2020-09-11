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

    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
    <script src="{{ asset('js/circle.php') }}" defer></script>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #3f5c80; z-index: 2">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Smart Market') }}
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
                                <a class="nav-link" href="{{ route('vendor') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('company.register') }}">{{ __('Register') }}</a>
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



        <nav class="navbar navbar-expand-md shadow-sm navbar-light" style="background-color: #b0b6b8;z-index: 1">
            <div class="container">
            <ul class="navbar-nav bakcolor">
                <li class="nav-item">
                    <a class="nav-link"  href="{{ Route('vendor.home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ Route('vendor.profile')}}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ Route('vendor.products')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ Route('vendor.discounts')}}">Discounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ Route('vendor.orders')}}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ Route('vendor.soldItems')}}">Sold Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ Route('vendor.add.product')}}">Add Product</a>
                </li>

            </ul>
            </div>
        </nav>

        <main class="py-4" style="margin-top: 40px">
            @yield('content')
        </main>


        <script>
            var myTotal = 0;
            var myColor = ['#001845','#001233','#33415c','#979dac','#7d8597','#5c677d','#99c1de','#bcd4e6','#d6e2e9','#c5dedd','#0899ba','#04a6c2','#0f80aa','#20bac5']; // Colors of each slice


            var arcs = [];

            function draw() {
                arcs = [];
                myTotal = 0;

                // calculate the total value we have
                entries.forEach(function (val, idx) {

                    myTotal += val[1][1] / 1;

                });
                // get the <ul> to put <li> in it that have the name and input to change the color
                document.getElementById("dvLegend").innerHTML = "";
                var beginAngle = 0;
                var endAngle = 0;
                entries.forEach(function (val, idx) {

                    ctx.fillStyle = myColor[idx % myColor.length]; // choosing color
                    ctx.beginPath(); // start drawing
                    ctx.moveTo(canvas.width / 2, canvas.height / 2); // move the cursor to start position
                    // Arc Parameters: x, y, radius, startingAngle (radians), endingAngle (radians), antiClockwise (boolean)
                    ctx.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, lastend, lastend + (Math.PI * 2 * (val[1][1] / myTotal)), false);
                    ctx.lineTo(canvas.width / 2, canvas.height / 2); // رسم القطاع الدائري و اغلاقه
                    ctx.fill();
                    // store the value of each circle start angle and end angle to use it again in arcs array
                    arcs.push([lastend, lastend + (Math.PI * 2 * (val[1][1] / myTotal))]);
                    var atag = document.createElement("a");

                    var x = document.createElement("LI"); // create li element to put it in the ul
                    x.id = idx; // assign id value

                    var t = document.createTextNode(val[1][0]); // create text inside the li

                    // put the elements inside each other
                    atag.href = "<?= route('vendor.product')  ?>?id=" + val[1][0];
                    x.appendChild(t);


                    atag.appendChild(x);
                    x.style.background = myColor[idx % myColor.length]; // give a background color to the li same as the color of its arc
                    x.className = "list-group-item";

                    atag.title = "Click to view this product";
                    document.getElementById("dvLegend").append(atag);
                    // put the value in the middle of the arc and this is the equation to make that
                    beginAngle = endAngle; //begin angle
                    endAngle = endAngle + ((Math.PI * 2) * (val[1][1] / myTotal)); //end angle
                    var pieRadius = Math.min(canvas.width / 2, canvas.height / 2);
                    var labelX = canvas.width / 2 + (pieRadius / 2) * Math.cos(beginAngle + (endAngle - beginAngle) / 2);
                    var labelY = canvas.height / 2 + (pieRadius / 2) * Math.sin(beginAngle + (endAngle - beginAngle) / 2);
                    ctx.fillStyle = "white";
                    ctx.font = "bold 10px Arial";
                 //   ctx.fillText("" + val[1][0], labelX, labelY);


                    // when mouse move on the li element
                    x.onmouseover = function () {
                        hover(this.id); // call hover function that will draw again
                        this.style.fontSize = "20px"; // make the font bigger
                        this.style.cursor = "pointer";
                    };

                    // when moving mouse out of the li
                    x.onmouseout = function () {
                        //hover(this.id);
                        this.style.fontSize = "18px"; // just make the font as default
                    };



                    // move cursor to the end of arc to draw the next arc
                    lastend += Math.PI * 2 * (val[1][1] / myTotal);
                });
            }

            function edit(idx, col) {

                myColor[idx] = col; // change the color as requested
                reset(); // clear canvas
                draw(); // draw again with the new color
            }

            function reset() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }

            function hover(id) {
                // this function to draw again when mouse over li element
                // and we use arcs array to draw
                var i = 0, r;
                var beginAngle = 0;
                var endAngle = 0;
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                var j = 0;
                while (r = arcs[i]) {
                    ctx.beginPath();
                    ctx.moveTo(canvas.width / 2, canvas.height / 2);
                    ctx.arc(canvas.width / 2, canvas.height / 2, canvas.height / 2, arcs[i][0], arcs[i][1], false);
                    ctx.lineTo(canvas.width / 2, canvas.height / 2);
                    ctx.fillStyle = myColor[j % myColor.length];

                    // the only difference from draw function
                    // we have the id of li element the mouse over it
                    // we make the arc bigger if we are drawing it and its id equal to the index
                    if (id == i) {
                        ctx.lineWidth = 8;
                        ctx.strokeStyle = myColor[j % myColor.length];
                        ctx.stroke();
                    }
                    ctx.fill();

                    beginAngle = arcs[i][0]; //begin angle
                    endAngle = arcs[i][1]; //end angle
                    var pieRadius = Math.min(canvas.width / 2, canvas.height / 2);
                    var labelX = canvas.width / 2 + (pieRadius / 2) * Math.cos(beginAngle + (endAngle - beginAngle) / 2);
                    var labelY = canvas.height / 2 + (pieRadius / 2) * Math.sin(beginAngle + (endAngle - beginAngle) / 2);
                    ctx.fillStyle = "white";
                    ctx.font = "bold 10px Arial";
                  //  ctx.fillText("" + values[i][0], labelX, labelY);

                    j++;
                    i++;
                }

            }



            // when mouse out of canvas resize the font to its default value
            canvas.onmouseout = function (e) {
                for (var i = 0; i < entries.length; i++) {
                    document.getElementById(i).style.fontSize = "18px";
                }
            };

            function saveit() {

                var dataUrl = canvas.toDataURL();
                document.getElementById("image").src = dataUrl;
                document.getElementById("download").href = dataUrl;
            }


            draw();
            // ============================================================================
            //---------------------------- Bar -------------------------------------------

            // colors we will use
            var colors = ['#001845','#001233','#33415c','#979dac','#0899ba','#04a6c2','#0f80aa','#20bac5'];

            function drawBar() {

                var width = 40; //bar width
                var X = 60; // first bar position
                // looping on the values to draw each rectangle
                for (var i =0; i<Math.min(5,values.length); i++) {
                    barCtx.fillStyle = colors[i%colors.length]; // choose color for rectangle
                    var h = Math.min(250,values[i][1]*30); // get the height of rectangle
                    // draw the rectangle (position on x,position on y,width of rectangle,height of rectangle)
                    barCtx.fillRect(X,barCan.height - h,width,h);

                    X +=  width+15; //increase the position on x to draw the next rectangle
                    /* text to display Bar number */
                    barCtx.fillStyle = '#4da6ff';
                    barCtx.fillText(values[i][0],X-50,barCan.height - h -20); // text on top of the rectangle
                    barCtx.fillText("qty = "+values[i][1],X-50,barCan.height - h -10);
                }
                /* Text to display scale */
                barCtx.fillStyle = '#000000';
                barCtx.fillText('Scale X : '+barCan.width+' Y : '+barCan.height,800,10);


            }

            // to make action on mouse move
            barCan.onmousemove = function (e) {

                var rect = this.getBoundingClientRect(),
                    x = e.clientX - rect.left, //get the x position
                    y = e.clientY - rect.top; //get the y position

                // clear the exist rectangle
                barCtx.clearRect(0, 0, barCan.width, barCan.height);

                var width = 40; //bar width
                var X = 60; // first bar position

                //start drawing again
                for (var i =0; i<Math.min(5,values.length); i++) {

                    var h = Math.min(250,values[i][1]*30);
                    barCtx.beginPath();
                    barCtx.rect(X,barCan.height - h,width,h);

                    // here is the difference : we change the bar color if mouse move above it
                    barCtx.fillStyle = barCtx.isPointInPath(x, y) ? "#008080" : colors[i%colors.length];
                    barCtx.fill();
                    X +=  width+15;
                    /* text to display Bar number */
                    barCtx.fillStyle = '#4da6ff';
                    barCtx.fillText(values[i][0],X-50,barCan.height - h -20);
                    barCtx.fillText("qty = "+values[i][1],X-50,barCan.height - h -10);
                }
                /* Text to display scale */
                barCtx.fillStyle = '#000000';
                barCtx.fillText('Scale X : '+barCan.width+' Y : '+barCan.height,800,10);




            };
            drawBar();
            // ============================================================================
            //---------------------------- Coordinate -------------------------------------------
            var colors2 = ['#001233','#001845','#33415c','#979dac','#0899ba','#04a6c2','#0f80aa','#20bac5'];


            function drawBar2() {

                var width = 40; //bar width
                var X = 5; // first bar position
                // looping on the values to draw each rectangle
                for (var i =0; i<Math.min(7,values2.length); i++) {
                    barCtx2.fillStyle = colors2[i%colors.length]; // choose color for rectangle
                    var h = Math.min(250,values2[i][1]*30); // get the height of rectangle
                    // draw the rectangle (position on x,position on y,width of rectangle,height of rectangle)
                    barCtx2.fillRect(X,barCan2.height - h,width,h);

                    X +=  width+15; //increase the position on x to draw the next rectangle
                    /* text to display Bar number */
                    barCtx2.fillStyle = '#4da6ff';
                    barCtx2.fillText(values2[i][0],X-50,barCan2.height - h -20); // text on top of the rectangle
                    barCtx2.fillText("qty = "+values2[i][1],X-50,barCan2.height - h -10);
                }
                /* Text to display scale */
                barCtx2.fillStyle = '#000000';
                barCtx2.fillText('Scale X : '+barCan2.width+' Y : '+barCan2.height,800,10);


            }

            // to make action on mouse move
            barCan2.onmousemove = function (e) {

                var rect = this.getBoundingClientRect(),
                    x = e.clientX - rect.left, //get the x position
                    y = e.clientY - rect.top; //get the y position

                // clear the exist rectangle
                barCtx2.clearRect(0, 0, barCan2.width, barCan2.height);

                var width = 40; //bar width
                var X = 5; // first bar position

                //start drawing again
                for (var i =0; i<Math.min(7,values2.length); i++) {

                    var h = Math.min(250,values2[i][1]*30);
                    barCtx2.beginPath();
                    barCtx2.rect(X,barCan2.height - h,width,h);

                    // here is the difference : we change the bar color if mouse move above it
                    barCtx2.fillStyle = barCtx2.isPointInPath(x, y) ? "#008080" : colors2[i%colors.length];
                    barCtx2.fill();
                    X +=  width+15;
                    /* text to display Bar number */
                    barCtx2.fillStyle = '#4da6ff';
                    barCtx2.fillText(values2[i][0],X-50,barCan2.height - h -20);
                    barCtx2.fillText("qty = "+values2[i][1],X-50,barCan2.height - h -10);
                }
                /* Text to display scale */
                barCtx2.fillStyle = '#000000';
                barCtx2.fillText('Scale X : '+barCan2.width+' Y : '+barCan2.height,800,10);




            };
            drawBar2();
            function saveit1() {

                var dataUrl = canvas.toDataURL();
                document.getElementById("image").src = dataUrl;
                document.getElementById("download").href = dataUrl;
            }
            function saveit2() {

                var dataUrl = barCan.toDataURL();
                document.getElementById("image2").src = dataUrl;
                document.getElementById("download2").href = dataUrl;
            }
            function saveit3() {

                var dataUrl = barCan2.toDataURL();
                document.getElementById("image3").src = dataUrl;
                document.getElementById("download3").href = dataUrl;
            }
        </script>

    </div>

</body>
</html>
