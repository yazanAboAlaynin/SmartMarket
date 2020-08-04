@extends('layouts.vendor')

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center"><h2>Top 5 Products</h2></div>
                    <div class="row">
                        <div class="col-md-12">
                            <a id="download" href="#" onclick="saveit()" download>download</a>
                        </div>

                    </div>
                    <div class="row ">
                        <div class="col-md-12 text-center">
                            <canvas id="bar" width="500" height="300" style="border:1px solid #e1e8d1; background-color: #e1e8d1">
                            </canvas>
                            <img id="image" style="display: none;"/>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center"><h2>Top 5 Products</h2></div>
                    <div class="row">
                        <div class="col-md-12">
                            <a id="download" href="#" onclick="saveit()" download>download</a>
                        </div>

                    </div>
                    <div class="row ">
                        <div class="col-md-12 text-center">
                            <div class="col-md-12" style="overflow: scroll">
                                <canvas id="coordinate" width="1000" height="300" style="border:1px solid black">
                                </canvas>
                                <img id="image" style="display: none;"/>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container justify-content-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center"><h2>Products sales</h2></div>

                    <div class="row">
                        <div class="col-md-12">
                            <a id="download" href="#" onclick="saveit()" download>download</a>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">
                            <canvas id="circle" width="500" height="500"></canvas>
                            <img id="image" style="display: none;"/>
                        </div>
                        <div class="col-md-4">
                            <ul id="dvLegend" style="height: 400px; overflow: scroll"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        var canvas = document.getElementById("circle");
        var ctx = canvas.getContext("2d");

        var barCan = document.getElementById("bar");
        var barCtx = barCan.getContext("2d");

        var Ccanvas = document.getElementById("coordinate");
        var Cctx = Ccanvas.getContext("2d");
        var color = "#042b76";
        var lastend = 0;
        var values = {!! $all !!};
        var entries = Object.entries(values);

    </script>

@endsection