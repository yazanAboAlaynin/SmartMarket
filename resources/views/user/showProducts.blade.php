
@extends('layouts.showProducts')

@section('content')


<!-------------------------------             --------------------------------------->
<section class="featured-categories">
    @if($products->count() > 0)
    <div class="container card shadow">
        <div class="text-center">
            <h4>{{ $type }}</h4>
        </div>
        <br/>
         <div class="title-box">
            <h5>{{ $choice }}</h5>
        </div>


        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="product-top">
                  <a href="{{ Route('viewProduct',$product->id) }}"> <img src="/storage/{{ $product->image }}" class="d-block w-100"> </a>
                    <div class="overlay-right">
                        <button type="button" class="btn btn-secondary" title="Quick Shop">

                        </button>
                        <button type="button" class="btn btn-secondary" title="Add to wishlist">

                        </button>
                        <button type="button" class="btn btn-secondary" title="Add to Cart">

                        </button>
                    </div>
                </div>
                <div class="product-bottom text-center">
{{ round($product->ratings()->avg('rate')) }}
                    @for($i=0;$i<round($product->ratings()->avg('rate'));$i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    @for($i=round($product->ratings()->avg('rate'));$i<5;$i++)
                        <i class="fa fa-star-o"></i>
                    @endfor
                    <h3>{{ $product->name }}</h3>
                    <h5>Price: {{ $product->price }}</h5>
                    @if($product->discount != '0')
                        <?php
                        $priceAfterDiscount = ( $product->price * $product->discount )/100 ;
                        $priceAfterDiscount = ($product->price) - $priceAfterDiscount ;
                        ?>
                        <p class="price-discount"><b>Price after Discount : </b> {{ $priceAfterDiscount}} S.P</p>
                        @endif
                </div>
            </div>
            @endforeach
        </div>


    </div>

    @else
        <div class="text-center">
            <h4>{{ $type }}</h4>
        </div>
        <br/>
        <div class="title-box">
            <h4>{{ $choice }}</h4>
        </div>
        <div class="alert alert-secondary mt-lg-3 ml-lg-3 mr-lg-5 mb-lg-4">

            <h3 class="text-center">
                No Products Yet.
            </h3>
        </div>

    @endif

</section>


@endsection
