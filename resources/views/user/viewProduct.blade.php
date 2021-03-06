
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
                <p class="new-saly text-center">New/sale</p>
                <h2> {{$product->name}} </h2>
                <p><b>Rating : </b>
                    @for($i=0;$i<$avg;$i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    @for($i=$avg;$i<5;$i++)
                        <i class="fa fa-star-o"></i>
                    @endfor
                </p>

                <p class="" style="color: red; font-size: 20px"><b>Price : </b> {{$product->price}} S.P</p>
                @if($product->discount != '0')
                <p><b>Discount : </b> {{$product->discount}}%</p>
                <?php
                $priceAfterDiscount = ( $product->price * $product->discount )/100 ;
                $priceAfterDiscount = ($product->price) - $priceAfterDiscount ;

                ?>

                <p class="price-discount"><b>Price after Discount : </b> {{ $priceAfterDiscount}} S.P</p>
                @endif
                <p><b>Brand : </b> {{$product->brand->name}}</p>

                <form method="GET" action="{{ Route('addProduct',$product->id) }}">
                    @csrf
                    <label for="quantity" class="">{{ __('Quantity') }}</label>
                    <input id="quantity" type="number" min="1" name="quantity" value="1" required autocomplete="quantity" autofocus>
                    <button class="btn btn-primary">Add to Cart</button>
                </form>
            </div>

        </div>

    </div>

</section>
@if(sizeof($properties) > 0)

<section class="product-description">
    <div class="container">
       <h6>Properties</h6>
        @foreach($properties as $property)
            <h3><span><b>{{$property->name}}:</b> {{$property->value}}</span></h3>
            @if(sizeof($otherProp[$property->name][0]) > 0)

            <div class="row mb-2 ml-1">
                <p>
                    <b style="font-size:15px;">other {{ $property->name }} : &nbsp; &nbsp;</b>
                </p>


                <div class="dropdown">
                    <button class="dropbtn">Select {{ $property->name }} <i class="fa fa-chevron-down"></i></button>
                    <div class="dropdown-content">


                        @foreach($otherProp[$property->name] as $p)
                            <?php $last= ''?>
                            @foreach($p as $pp)
                                @if($last != $pp->value)
                                    <?php $last = $pp->value ?>
                                   <a href="{{ route('viewProduct',$pp->product_id) }}">{{ $pp->value }}</a>
                                @endif
                                @endforeach

                        @endforeach

                    </div>
                </div>

            </div>
            @endif
        @endforeach
    </div>
</section>
    <br/><br/><br/>
@endif

<!--     Description       -->
<section class="product-description">
    <div class="container">
        <h6>Product Description</h6>
        <p>{{$product->description}}</p>

        <hr>
    </div>
</section>

<!--  Ratings & Raviews  -->
<div class="container mt-5 mb-5">
    <div class="row title-box">
        <h2>Reviews</h2>
    </div>
@if(sizeof($ratings))
    @foreach($ratings as $rating)
        <div class="card p-2">
            <div class="media">
                <img src="/storage/{{ $rating->user->image }}" class="mr-3" style="width:80px">
                <div class="media-body">
                    <h5 class="mt-0">{{ $rating->user->name }}</h5>
                        <span class="text-warning">
                            @for($i=0;$i<$rating->rate;$i++)
                            <i class="fa fa-star"></i>
                            @endfor
                            @for($i=$rating->rate;$i<5;$i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                        </span>

                    <p class="" style="background-color: white">{{ $rating->description }}</p>

                </div>
            </div>
        </div>
        <br/>
    @endforeach
    @else <div class="alert-warning"><h2>there is no reviews </h2></div>
    @endif




</div>
<script>

</script>
@endsection
