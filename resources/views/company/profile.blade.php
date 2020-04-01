@extends('layouts.company2')

@section('content')


        <div class="row">    
            <!-- Container (About Section) -->
        <div id="about" class="container-fluid">
            <div class="row">
                <div class="col-sm-7" style=" margin-left: 40px;">
                <h2>{{ $company->name }}</h2><br>
                 <h4><i class="fa fa-envelope-o" style="font-size:22px;"></i><strong> Email : </strong>{{ $company->email}}</h4><br> 
                 <h4><i class="fa fa-map-marker" style="font-size:22px;"></i><strong> Address : </strong>{{ $company->address}}</h4><br> 
                 <h4><i class="fa fa-mobile" style="font-size:22px;"></i> <strong>Mobile : </strong>{{ $company->mobile}}</h4><br> 
                 <h4><i class="fa fa-phone" style="font-size:22px;"></i> <strong> Phone : </strong>{{ $company->phone}}</h4><br>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 ">
                            <a href="{{ Route('company.profile.edit') }}" class="btn btn-primary" style="border-radius:10%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);">
                                {{ __('Edit Profile') }}
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                   <img src="/storage/{{ $company->image }}" style="width:90%;margin-bottom: 20px;border-radius: 50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);">
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

         

        </div>

       
    


@endsection

