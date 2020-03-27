@extends('layouts.company')

@section('content')

<div class="container pt-2">

<div class="row justify-content-center ">
    <div class="col-md-8">

           <div class="card"> 

                   <div class="card-header">
                        <h1>add new product</h1>
                    </div>

              <div class="card-body">

                    <form action="{{ route('company.store.product') }}" enctype="multipart/form-data" method="post">
                       @csrf

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">name</label>


                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>


                            <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus></textarea>

                            @if ($errors->has('description'))
                                <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">price</label>


                            <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>

                            @if ($errors->has('price'))
                                <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-4 control-label">quantity</label>


                            <input id="quantity" type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" required autofocus>

                            @if ($errors->has('quantity'))
                                <span class="help-block">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">

                        <label for="category_id" class="col-md-4 control-label">category</label>
                                <select class="form-control" name="category_id" id="category_id" required autofocus>
                                    @foreach($categories as $c)
                                    <option value = "{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>


                        @if ($errors->has('category_id'))
                            <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                        @endif

                        </div>

                        <div class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">

                        <label for="brand_id" class="col-md-4 control-label">brand</label>
                                <select class="form-control" name="brand_id" id = "brand_id" >
                                    @foreach($brands as $b)
                                        <option value = "{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                </select>

                        @if ($errors->has('brand_id'))
                            <span class="help-block">
                        <strong>{{ $errors->first('brand_id') }}</strong>
                        </span>
                        @endif

                        </div>

                        <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                            <label for="discount" class="col-md-4 control-label">discount</label>


                            <input id="discount" type="text" class="form-control" name="discount" value="{{ old('discount') }}" required autofocus>

                            @if ($errors->has('discount'))
                                <span class="help-block">
                            <strong>{{ $errors->first('discount') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">image</label>


                            <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" required autofocus>

                            @if ($errors->has('image'))
                                <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                            @endif

                        </div>
                

                        <div class="form-group text-center">
                            <button class="btn btn-primary"  style="margin-top:10px;width: 30%">Add New Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection