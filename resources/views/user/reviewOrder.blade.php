@extends('layouts.userHome')

@section('content')


    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($items as $item)
                    <div class="case">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-8 d-flex">
                                <a href="" class="img w-100 mb-3 mb-md-0" style="background-image: url({{ asset('/storage/' . $item->product->image) }});"></a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
                                <div class="text w-100 pl-md-3">
                                    <span class="subheading">{{$item->product->category->name}}</span>
                                    <h2><a href="">{{$item->product->name}}</a></h2>

                                    <div class="meta">
                                        <form method="POST" action="{{ route('review',$item->product->id) }}">
                                        {{--<p class="mb-0"><a href="">Add Review</a></p>--}}
                                                <div class="form-group text-center">
                                                    <button class="btn btn-dark" style="margin-right:10px;width: 30%">Add Review</button>
                                                </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>




    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

@endsection