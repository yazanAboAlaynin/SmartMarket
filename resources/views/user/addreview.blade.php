@extends('layouts.userHome')

@section('content')


<div class="container pt-4">
   <div class="row justify-content-center ">
       <div class="col-md-12">
                  <div class="card-header">
                     <h1 class="text-center">Add New Rating</h1>
                   </div>
                   
                   <div class="row card-body">
                  
            <div class="col-md-6" style="font-size:30px;"> 

                    <div style="margin-top:8px;">
                        <h5 class="text-center">check Rating</h5>
                    </div>
                   <div class="text-center" style="color:orange">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
            </div>
            <div class="vl">
                <span class="vl-innertext">and</span>
            </div>
            <div class="col-md-6">
            
                <div class="col">
                    <div>
                        <label for="name" class="col-md-4 control-label">Name User</label>
                                    <div>
                                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                                    </div>
                   </div>

                   <div>
                   <label for="comment" class="col-md-4 control-label mt-3">Add Comment</label>
                                <div>
                                <textarea id="comment" type="text" class="form-control" name="comment" required autofocus></textarea>
                                </div>
                    </div>          
                    <div class="form-group text-center">
                            <button class="btn btn-primary"  style="margin-top:10px;width: 20%">Ok</button>
                    </div>
                </div>
            </div>

            </div>
        </div>
   </div>
</div>

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


@endsection