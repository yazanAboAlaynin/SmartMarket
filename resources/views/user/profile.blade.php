@extends('layouts.userHome')

@section('content')


        <div class="row">    
            <!-- Container (About Section) -->
        <div id="about" class="container-fluid">
            <div class="row">
                <div class="col-sm-7" style=" margin-left: 40px;">
                <h2>{{ $user->name }}</h2><br>
                 <h4><i class="fa fa-envelope-o" style="font-size:22px;"></i><strong> Email : </strong>{{ $user->email}}</h4><br>
                 <h4><i class="fa fa-calendar" style="font-size:22px;"></i><strong> Date of birth : </strong>{{ $user->dob}}</h4><br>
                    <h4><i class="fa fa-address-card" style="font-size:22px;"></i> <strong>Address : </strong>{{ $user->address}}</h4><br>
                 <h4><i class="fa fa-mobile" style="font-size:22px;"></i> <strong>Mobile : </strong>{{ $user->mobile}}</h4><br>
                    <h4><i class="fa fa-suitcase" style="font-size:22px;"></i> <strong>Career : </strong>{{ $user->career}}</h4><br>
                    <h4><i class="fa fa-venus-mars" style="font-size:22px;"></i> <strong>Gender : </strong>{{ $user->gender}}</h4><br>
                    <h4><i class="fa fa-chain-broken" style="font-size:22px;"></i> <strong>Social status : </strong>{{ $user->social_status}}</h4><br>
                    <h4><i class="fa fa-graduation-cap" style="font-size:22px;"></i> <strong>Scientific level : </strong>{{ $user->scientific_level}}</h4><br>
                    <h4><i class="fa fa-thumbs-o-up" style="font-size:22px;"></i> <strong>Three most hobbies : </strong>{{ $user->three_most_hobbies}}</h4><br>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 ">
                            <a href="{{ Route('profile.edit') }}" class="btn btn-primary" style="border-radius:10%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);">
                                {{ __('Edit Profile') }}
                            </a>  
                        </div>
                    </div>  

                </div>
                <div class="col-sm-4">
                   <img src="/storage/{{ $user->image }}" style="width:80%;margin-top: 30px;margin-bottom: 20px;border-radius: 50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);">
                </div>
            </div>
              <hr style="width:60%;margin-top: 50px">
            </div>

   
         

            <!-- Container (productMine Section) -->
            <div class="container">
                <div class="row mt-5 title-box">
                    <h2>Sold Products</h2>
                </div>

                <div class="row mt-5">
                    @if(sizeof($ordersItems))
                    @foreach($ordersItems as $product)
                    <div class="col-md-3">

                            <div class="card shadow-sm">
                                <img src="/storage/{{ $product->product->image }}" class="card-img-top img-fluid">
                                <div class="card-title ml-2">
                                    <h4>{{ $product->product->name }}</h4>
                                </div>
                                <div class="card-text text-center">
                                    {{ $product->price }}
                                </div>
                            </div>

                    </div>
                    @endforeach
                        @else <h2>you don't have products yet</h2>
                        @endif
                </div>

           </div>

       
    


@endsection
