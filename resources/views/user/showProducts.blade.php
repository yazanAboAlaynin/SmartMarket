
@extends('layouts.showProducts')

@section('content')


<!-------------------------------             --------------------------------------->
<section class="featured-categories">
    <div class="container card">
        <div class="text-center">
            <h2>{{ $type }}</h2>
        </div>
        <br/>
         <div class="title-box">
            <h2>{{ $choice }}</h2>
        </div>


        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3">
                <div class="product-top">
                  <a href="{{ Route('viewProduct',$product->id) }}"> <img src="/storage/{{ $product->image }}" class="d-block w-100"> </a>
                    <div class="overlay-right">
                        <button type="button" class="btn btn-secondary" title="Quick Shop">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-secondary" title="Add to wishlist">
                            <i class="fa fa-heart-o"></i>
                        </button>
                        <button type="button" class="btn btn-secondary" title="Add to Cart">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
                <div class="product-bottom text-center">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <h3>{{ $product->name }}</h3>
                    <h5>{{ $product->price }}</h5>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

</div>

@endsection