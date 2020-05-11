@extends('layouts.userHome')

@section('content')

    <form method="POST" action="{{ route('review') }}">
        @csrf
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
                <div class="card-header">
                    <h1 class="text-center">Add New Rating</h1>
                </div>

                <div class="row card-body">

                    <div class="col-md-5" style="font-size:30px;">

                        <div style="margin-top:8px;">
                            <h5 class="text-center">Review the product</h5>
                        </div>
                        <div class="text-center" style="color:orange">
                            <i id="star1" class="fa fa-star-o" onclick="clicki(1)" onmouseleave="endhover(1)"
                               onmouseover="hover(1)"></i>
                            <i id="star2" class="fa fa-star-o" onclick="clicki(2)" onmouseleave="endhover(2)"
                               onmouseover="hover(2)"></i>
                            <i id="star3" class="fa fa-star-o" onclick="clicki(3)" onmouseleave="endhover(3)"
                               onmouseover="hover(3)"></i>
                            <i id="star4" class="fa fa-star-o" onclick="clicki(4)" onmouseleave="endhover(4)"
                               onmouseover="hover(4)"></i>
                            <i id="star5" class="fa fa-star-o" onclick="clicki(5)" onmouseleave="endhover(5)"
                               onmouseover="hover(5)"></i>
                        </div>
                        <input type="hidden" name="stars" id="stars">
                    </div>
                    <div class="col-md-2">
                        <div class=" vl">
                            <span class="vl-innertext">and</span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col">
                            <div>
                                <label for="comment" class="col-md-4 control-label mt-3">Add Comment</label>
                                <div>
                                    <textarea id="comment" type="text" class="form-control" name="comment" required
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
            <div class="col-6">

                <div class="form-group text-center">
                    <button class="btn btn-primary" style="margin-top:10px;width: 20%">Add</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <script>

        var state = 0;

        function clicki(x) {
            for (var i = 1; i <= x; i++) {
                document.getElementById('star' + i).className = 'fa fa-star clicked';
            }
            for (var i = x + 1; i <= 5; i++) {
                document.getElementById('star' + i).className = 'fa fa-star-o';
            }
            state = x;
            $('#stars').val(x);
        }

        function hover(x) {

            for (var i = 1; i <= x; i++) {
                if (document.getElementById('star' + i).className.localeCompare('fa fa-star clicked')) {
                    document.getElementById('star' + i).className = 'fa fa-star';
                }

            }

        }

        function endhover(x) {

            for (var i = 1; i <= x; i++) {
                if (document.getElementById('star' + i).className.localeCompare('fa fa-star clicked')) {
                    document.getElementById('star' + i).className = 'fa fa-star-o';
                }
            }

        }
    </script>


@endsection