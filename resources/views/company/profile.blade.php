@extends('layouts.company2')

@section('content')


        <div class="row">    
            <!-- Container (About Section) -->
        <div id="about" class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                <h2>About Company</h2><br>
                <h4>Description company Description company Description company Description company
                Description company Description company Description company Description company Description company
                Description company Description company Description company.</h4><br> 
                </div>
                <div class="col-sm-4">
                   <img src="/storage/www.jpg">
                </div>
            </div>
            </div>

            <div class="container-fluid bg-grey">
                <div class="row">
                    <div class="col-sm-4">
                       <img src="/storage/ww.jpg">
                    </div>
                    <div class="col-sm-8">
                    <h2>Our areas of spread</h2><br>
                    <h4><strong>The region is more spread out : </strong> Description company Description company Description company Description company
                Description company Description company Description company Description company Description company
                Description company Description company Description company .</h4><br>
                    </div>
                </div>
            </div>

            <!-- Container (Portfolio Section) -->
                <div id="portfolio" class="container-fluid text-center">
                    <h2>Area</h2>
                    <div class="row text-center slideanim">
                        <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="/storage/www.jpg">
                            <p><strong>place</strong></p>
                            <p>address</p>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="/storage/www.jpg">
                            <p><strong>place</strong></p>
                            <p>address</p>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <div class="thumbnail">
                            <img src="/storage/www.jpg">
                            <p><strong>place</strong></p>
                            <p>address</p>
                        </div>
                        </div>
                    </div>
                </div>

            <!-- Container (Services Section) -->
            <div id="services" class="container-fluid text-center bg-grey">
                <h2>SERVICES</h2>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                      <i class="fa fa-bar-chart" style="font-size:50px;color:black"></i>
                    <h4>Guarantee</h4>
                    <p>Guarantee for is month..</p>
                    </div>       
                    <div class="col-sm-4">
                       <i class="fa fa-wrench" style="font-size:50px;color:black"></i>
                    <h4>Maintenance</h4>
                    <p>Maintenance throughout the day ..</p>
                    </div>
                    <div class="col-sm-4">
                        <i class="fa fa-truck" style="font-size:50px;color:black"></i>
                    <h4>Delivery</h4>
                    <p>Delivery throughout the day..</p>
                    </div>
                </div> 
            </div>

            <!-- Container (Contact Section) -->
            <div id="contact" class="container-fluid" style="background-color: #263238;">
                <h2 class="text-center" style="color: #000;">CONTACT</h2>
                <div class="row text-center pt-2">
                    <div class="col-md-12">
                    <p><i class="fa fa-map-marker" style="font-size:22px;"></i> <strong>place :</strong> mazah </p> 
                    <p><i class="fa fa-phone" style="font-size:22ph;"></i> <strong>number :</strong> 09000</p>
                    <p><i class="fa fa-envelope-o" style="font-size:22px;"></i> <strong>emiil :</strong> company@gmail.com</p>
                    </div>
                </div>
            </div>

        </div>
    


@endsection
