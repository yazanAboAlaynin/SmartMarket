@extends('layouts.showProducts')

@section('content')


<!-------------------------------             --------------------------------------->
<section class="featured-categories">
    <a href="{{ Route('search',['seller',1]) }}">search</a>
    <div class="container">
        <div class="title-box">
            <h2>categories</h2>
        </div>
        <div class="row">
            @foreach($category as $c)
            <div class="col-md-3">
                <div class="product-top">
                 <a href="{{ Route('search',['category',$c->id]) }}">  <img src="/storage/2.jpg" class="d-block w-100"></a>
                </div>
                <div class="product-bottom text-center">
                    <h3>{{ $c->name }}</h3>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-------------------------------             --------------------------------------->
<section class="featured-categories">
    <div class="container">
        <div class="title-box">
            <h2>more pay</h2>
        </div>
        <div class="row">x
            <div class="col-md-3">
                <div class="product-top">
                   <img src="/storage/2.jpg" class="d-block w-100">
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
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <h3>Watch</h3>
                    <h5>5000</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-top">
                   <img src="/storage/2.jpg" class="d-block w-100">
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
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <h3>Watch</h3>
                    <h5>5000</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-top">
                   <img src="/storage/2.jpg" class="d-block w-100">
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
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <h3>Watch</h3>
                    <h5>5000</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-top">
                   <img src="/storage/2.jpg" class="d-block w-100">
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
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <h3>Watch</h3>
                    <h5>5000</h5>
                </div>
            </div>

        </div>
    </div>
</section>


</div>

</div>
</div>


@endsection
