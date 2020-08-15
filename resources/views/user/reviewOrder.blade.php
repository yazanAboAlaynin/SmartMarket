@extends('layouts.userHome')

@section('content')
<h1> Please review your order :</h1>
    <section class="ftco-section">
        <div class="container-fluid">
            @foreach($items as $item)
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xl-3 d-flex">
                        <img src="/storage/{{$item->product->image}}" class="d-block w-100">
                    </div>
                    <div class="col-md-9 col-lg-9 col-xl-9 d-flex">
                        <div class="text w-100 pl-md-3">
                            <span class="subheading">{{$item->product->category->name}}</span>
                            <h2>{{$item->product->name}}</h2>
                            <div class="container pt-4">
                                <div class="row justify-content-center ">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="row card-body">

                                            <div class="col-md-5" style="font-size:30px;">

                                                <div style="margin-top:8px;">
                                                    <h5 class="text-center">Review the product</h5>
                                                </div>
                                                <div class="text-center" style="color:orange">
                                                    <i id="star1{{$item->product->id}}" class="fa fa-star-o" onclick="clicki(1,{{$item->product->id}})" onmouseleave="endhover(1,{{$item->product->id}})"
                                                       onmouseover="hover(1,{{$item->product->id}})"></i>
                                                    <i id="star2{{$item->product->id}}" class="fa fa-star-o" onclick="clicki(2,{{$item->product->id}})" onmouseleave="endhover(2,{{$item->product->id}})"
                                                       onmouseover="hover(2,{{$item->product->id}})"></i>
                                                    <i id="star3{{$item->product->id}}" class="fa fa-star-o" onclick="clicki(3,{{$item->product->id}})" onmouseleave="endhover(3,{{$item->product->id}})"
                                                       onmouseover="hover(3,{{$item->product->id}})"></i>
                                                    <i id="star4{{$item->product->id}}" class="fa fa-star-o" onclick="clicki(4,{{$item->product->id}})" onmouseleave="endhover(4,{{$item->product->id}})"
                                                       onmouseover="hover(4,{{$item->product->id}})"></i>
                                                    <i id="star5{{$item->product->id}}" class="fa fa-star-o" onclick="clicki(5,{{$item->product->id}})" onmouseleave="endhover(5,{{$item->product->id}})"
                                                       onmouseover="hover(5,{{$item->product->id}})"></i>
                                                </div>
                                                <input type="hidden" name="stars" id="stars{{$item->product->id}}">
                                            </div>
                                            <div class="col-md-2">
                                                <div class=" vl">
                                                    <span class="vl-innertext">and</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="col">
                                                    <div>
                                                        <label for="comment" class="col-md-4 control-label mt-3">Comment</label>
                                                        <div>
                                    <textarea id="comment{{$item->product->id}}" type="text" class="form-control" name="comment" required
                                              autofocus></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <br/>

                                <div class="row justify-content-center">
                                    <div class="col-8">

                                        <div class="form-group text-center">
                                            <button id="review{{$item->product->id}}" onclick="review({{$item->product->id}},getRateValue({{$item->product->id}}),getCommentValue({{$item->product->id}}))" class="btn btn-primary" style="margin-top:10px;width: 20%">Add Review</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
            @endforeach
        </div>
    </section>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <script>
        if(!{{ count($items) }}){
            location.replace("{{ route('products') }}");
        }
        var order = {{ $order->id }};
        function getRateValue(id){
            // Selecting the input element and get its value
            var inputVal = document.getElementById("stars"+id).value;
            return inputVal;
        }
        function getCommentValue(id){
            // Selecting the input element and get its value
            var inputVal = document.getElementById("comment"+id).value;
            return inputVal;
        }
        function review(id,rate,comment){
            $.ajax({
                url: "{{ route("review") }}?id=" + id+"&&rate="+rate+"&&comment="+comment+"&&order="+order,
                type: "get",
                dataType: "json",
                success: function (data) {
                    location.reload();
                }
            });
        }


        var state = 0;

        function clicki(x,id) {
            for (var i = 1; i <= x; i++) {
                document.getElementById('star' + i+id).className = 'fa fa-star clicked';
            }
            for (var i = x + 1; i <= 5; i++) {
                document.getElementById('star' + i+id).className = 'fa fa-star-o';
            }
            state = x;
            id = '#stars'+id;
            $(id).val(x);
        }

        function hover(x,id) {

            for (var i = 1; i <= x; i++) {
                if (document.getElementById('star' + i+id).className.localeCompare('fa fa-star clicked')) {
                    document.getElementById('star' + i+id).className = 'fa fa-star';
                }

            }

        }

        function endhover(x,id) {

            for (var i = 1; i <= x; i++) {
                if (document.getElementById('star' + i+id).className.localeCompare('fa fa-star clicked')) {
                    document.getElementById('star' + i+id).className = 'fa fa-star-o';
                }
            }

        }
    </script>
@endsection