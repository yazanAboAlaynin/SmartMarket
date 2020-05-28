@extends('layouts.vendor2')

@section('content')


        <div class="container">
            <!-- Container (About Section) -->
        <div id="about" class="container-fluid">
            <div class="row">
                <div class="col-sm-7">
                <h2>{{ $vendor->name }}</h2><br>
                 <h4><i class="fa fa-envelope-o" style="font-size:22px;"></i><strong> Email : </strong>{{ $vendor->email}}</h4><br>
                 <h4><i class="fa fa-map-marker" style="font-size:22px;"></i><strong> Address : </strong>{{ $vendor->address}}</h4><br>
                 <h4><i class="fa fa-mobile" style="font-size:22px;"></i> <strong>Mobile : </strong>{{ $vendor->mobile}}</h4><br>
                 <h4><i class="fa fa-phone" style="font-size:22px;"></i> <strong> Phone : </strong>{{ $vendor->phone}}</h4><br>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 ">
                            <a href="{{ Route('vendor.profile.edit') }}" class="btn btn-primary" style="border-radius:10%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);">
                                {{ __('Edit Profile') }}
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">
                   <img src="/storage/{{ $vendor->image }}" style="width:96%;margin-bottom: 20px;border-radius: 50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);">
                </div>
            </div>
            </div>

         

        </div>

       
    


@endsection

