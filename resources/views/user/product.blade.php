
@extends('layouts.user')

@section('content')

<section class="single-product">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div id="prouct-slider" class="carousel slide carousel-fade" data-ride="carousel">
                       <div class="carousel-inner shadow p-3 mb-5 rounded">
                            <div class="carousel-item active">
                                <img src="/storage/2.jpg" class="d-block w-100 ">
                            </div>
                            <div class="carousel-item ">
                                <img src="/storage/w.jpg" class="d-block w-100">
                            </div>
                            <div class="carousel-item ">
                                <img src="/storage/ww.jpg" class="d-block w-100">
                            </div>
                            <div class="carousel-item ">
                                <img src="/storage/www.jpg" class="d-block w-100">
                            </div>
                            <div class="carousel-item ">
                                <img src="/storage/w.jpg" class="d-block w-100">
                            </div>

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
                <h2>Name of product</h2>
                <p><b>Reting : </b> 
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>  </p>
                
                <p class="price"><b>Price : </b> 1500</p>
                <p><b>Discount : </b> 15%</p>
                <p class="price-discount"><b>Price-Discount : </b> 1000</p>
                <p><b>Brand : </b> Adidas</p>
                <b> Quantity : </b>
                <input type="text" value="1">
                <button type="button" class="btn btn-primary">Add to Cart</button>

            </div>

        </div>
    </div>

</section>

<!--     Description       -->
<section class="product-description">
    <div class="container">
        <h6>Product Description</h6>
        <p>product-description product-description product-description product-description product-description
           product-description product-description product-description product-description product-description
           product-description product-description product-description product-description product-description
        </p>

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
                                    <i class="fa fa-eye" style="height:70px;width:100px;margin-top: 120px;margin-left: 46px;font-size:70px;background-image: linear-gradient( #343a4073,#ffffffc2);padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="product-top">
                            <img src="/storage/www.jpg" class="d-block w-100">
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick Shop">
                                    <i class="fa fa-eye" style="height:70px;width:100px;margin-top: 120px;margin-left: 46px;font-size:70px;background-image: linear-gradient( #343a4073,#ffffffc2);padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                   <div class="col-md-3">
                        <div class="product-top">
                            <img src="/storage/ww.jpg" class="d-block w-100">
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick Shop">
                                    <i class="fa fa-eye" style="height:70px;width:100px;margin-top: 120px;margin-left: 46px;font-size:70px;background-image: linear-gradient( #343a4073,#ffffffc2);padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="product-top">
                            <img src="/storage/w.jpg" class="d-block w-100">
                            <div class="overlay-right">
                                <button type="button" class="btn btn-secondary" title="Quick Shop">
                                    <i class="fa fa-eye" style="height:70px;width:100px;margin-top: 120px;margin-left: 46px;font-size:70px;background-image: linear-gradient( #343a4073,#ffffffc2);padding-top: 0;"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

</section>
