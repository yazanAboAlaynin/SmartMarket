@extends('layouts.showProducts')

@section('content')

<div class="container">
<!-------------------------------             --------------------------------------->
<section class="featured-categories">

    <div class="container">
        <div class="title-box">
            <h2>categories</h2>
        </div>
        @if($category->count() > 0)
        <div class="row">
            @foreach($category as $c)
            <div class="col-md-3">
                <div class="product-top">
                 <a href="{{ Route('search',['category',$c->id]) }}">  <img src="/storage/{{$c->image}}" class="d-block w-100"></a>
                </div>
                <div class="product-bottom text-center">
                    <h3>{{ $c->name }}</h3>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <div class="alert alert-secondary">
                <h3 class="text-center">
                    No Category Yet.
                </h3>
            </div>

        @endif

    </div>
</section>
<hr/>
<!-------------------------------             --------------------------------------->
    <section class="featured-brands">

        <div class="container">
            <div class="title-box">
                <h2>brands</h2>
            </div>
            @if($brands->count() > 0)
                <div class="row">
                    @foreach($brands as $c)
                        <div class="col-md-3">
                            <div class="product-top">
                                <a href="{{ Route('search',['brand',$c->id]) }}">  <img src="/storage/{{$c->image}}" class="d-block w-100"></a>
                            </div>
                            <div class="product-bottom text-center">
                                <h3>{{ $c->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-secondary">
                    <h3 class="text-center">
                        No Category Yet.
                    </h3>
                </div>

            @endif

        </div>
    </section>
    <hr/>
    <!-------------------------------             --------------------------------------->
    <section class="featured-sellers">

        <div class="container">
            <div class="title-box">
                <h2>top sellers</h2>
            </div>
            @if($sellers->count() > 0)
                <div class="row">
                    @foreach($sellers as $c)
                        <div class="col-md-3">
                            <div class="product-top">
                                <a href="{{ Route('search',['brand',$c->id]) }}">  <img src="/storage/{{$c->image}}" class="d-block w-100"></a>
                            </div>
                            <div class="product-bottom text-center">
                                <h3>{{ $c->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-secondary">
                    <h3 class="text-center">
                        No Category Yet.
                    </h3>
                </div>

            @endif

        </div>
    </section>
    <hr/>
</div>
@endsection
