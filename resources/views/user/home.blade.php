@extends('layouts.userHome')

@section('content')

    <div id="carouselExampleCaptions" class="alert alert-dark carousel slide mr-3" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/logo.jpg" width="100%" height="556px"/>
                <div class="carousel-caption d-none d-md-block">
                    <button type="button" class="btn btn-info">Start Shopping</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/2.jpg" width="100%" height="556px"/>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="background-color: #00000094">Name Company</h5>
                    <p style="background-color: #00000094">Display.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/2.jpg" width="100%" height="556px"/>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="background-color: #00000094">Name Company</h5>
                    <p style="background-color: #00000094">Display.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/storage/2.jpg" width="100%" height="556px"/>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="background-color: #00000094">Name Company</h5>
                    <p style="background-color: #00000094">Display.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>






    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

@endsection
