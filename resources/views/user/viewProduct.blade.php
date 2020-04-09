
@extends('layouts.userHome')

@section('content')

<section class="single-product">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div id="prouct-slider" class="carousel slide carousel-fade" data-ride="carousel">
                       <div class="carousel-inner shadow p-3 mb-5 rounded">
                           <div class="carousel-item active">
                               <img src="/storage/{{ $product->image }}" class="d-block w-100 ">
                           </div>
                           @foreach($images as $image)
                            <div class="carousel-item ">
                                <img src="/storage/{{ $image->src }}" class="d-block w-100 ">
                            </div>
                           @endforeach
                            <a class="carousel-control-prev" href="#prouct-slider" role="button" data-slide="prev" >
                                <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#prouct-slider" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                       </div>
                </div>
            </div>

            <div class="col-md-7">
                <p class="new-saly text-center">New/saly</p>
                <h2> {{$product->name}} </h2>
                <p><b>Reting : </b>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>  </p>

                <p class="price"><b>Price : </b> {{$product->price}}</p>
                <p><b>Discount : </b> {{$product->discount}}%</p>
                <?php
                $priceAfterDiscount = ( $product->price * $product->discount )/100 ;
                $priceAfterDiscount = ($product->price) - $priceAfterDiscount ;

                ?>
                <p class="price-discount"><b>Price-Discount : </b> {{ $priceAfterDiscount}}</p>
                <p><b>Brand : </b> {{$product->brand->name}}</p>

                <div class="row mb-2 ml-1">
                    <p>
                    <b style="font-size:15px;">Size : &nbsp; &nbsp;</b>
                    </p>
                    <div class="dropdown">
                    <button class="dropbtn">Select Size <i class="fa fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                    <a href="#">Small</a>
                    <a href="#">Larg</a>
                    <a href="#">X larg</a>
                    </div>
                    </div>
                </div>
                <form method="GET" action="{{ Route('addProduct',$product->id) }}">
                    @csrf
                    <label for="quantity" class="">{{ __('Quantity') }}</label>
                    <input id="quantity" type="number" max="10" min="1" name="quantity" value="1" required autocomplete="quantity" autofocus>
                    <button class="btn btn-primary">Add to Cart</button>
                </form>
            </div>

        </div>
    </div>

</section>

<!--     Description       -->
<section class="product-description">
    <div class="container">
        <h6>Product Description</h6>
        <p>{{$product->description}}</p>

        <hr>
    </div>

       <!--     Change color of product      -->
        <div class="container">
                <div class="title-box">
                    <h2>Change color</h2>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="product-top">
                            <img src="/storage/2.jpg" class="d-block w-100">
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick Shop">
                                    <i class="fa fa-eye" style="height:65px;width:80px;margin-top: 180px;margin-left: 60px;font-size:66px;background-color:#ffffffd4;border-radius: 20%;padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="product-top">
                            <img src="/storage/www.jpg" class="d-block w-100">
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick Shop">
                                    <i class="fa fa-eye" style="height:65px;width:80px;margin-top: 180px;margin-left: 60px;font-size:66px;background-color:#ffffffd4;border-radius: 20%;padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                   <div class="col-md-3">
                        <div class="product-top">
                            <img src="/storage/ww.jpg" class="d-block w-100">
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick Shop">
                                    <i class="fa fa-eye" style="height:65px;width:80px;margin-top: 180px;margin-left: 60px;font-size:66px;background-color:#ffffffd4;border-radius: 20%;padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="product-top">
                            <img src="/storage/w.jpg" class="d-block w-100">
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick Shop">
                                    <i class="fa fa-eye" style="height:65px;width:80px;margin-top: 180px;margin-left: 60px;font-size:66px;background-color:#ffffffd4;border-radius: 20%;padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

</section>

<!--  Ratings & Raviews  -->
<div class="container mt-5 mb-5">
    <div class="row title-box">
        <h2>Rating&Raview</h2>
    </div>

    <div class="row mt-5 mb-5">
      <div class="media">
        <img src="/storage/w.jpg" class="mr-3" style="width:80px">
        <div class="media-body">
          <h5 class="mt-0">user name . <span class="text-warning"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> </span></h5>
            comment
        </div>
      </div>
    </div>

    <div class="row mt-5 mb-5">
      <div class="media">
        <img src="/storage/w.jpg" class="mr-3" style="width:80px">
        <div class="media-body">
          <h5 class="mt-0">user name . <span class="text-warning"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> </span></h5>
            comment
        </div>
      </div>
    </div>


</div>

@endsection
