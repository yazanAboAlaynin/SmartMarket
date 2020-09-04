@extends('layouts.admin')

@section('content')

<div class="container pt-2">
   <div class="row justify-content-center ">
       <div class="col-md-8">
           <div class="card">
                   <div class="card-header">
                       <h1>Edit Product</h1>
                   </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.product.edit',$product->id) }}">
                        @csrf

                    <div  class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>
                            <div>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') ?? $product->name }}"  required autofocus>
                            </div>

                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif

                    </div>

                        <div  class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">description</label>
                                <div >
                                    <input id="description" type="text" class="form-control" name="description"
                                        value="{{ old('description') ?? $product->description }}"  required autofocus>
                                </div>

                            @if ($errors->has('description'))
                                <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div  class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">price</label>
                                <div >
                                    <input id="price" type="text" class="form-control" name="price"
                                        value="{{ old('price') ?? $product->price }}"  required autofocus>
                                </div>

                            @if ($errors->has('price'))
                                <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div  class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                            <label for="quantity" class="col-md-4 control-label">quantity</label>
                                <div >
                                    <input id="quantity" type="text" class="form-control" name="quantity"
                                        value="{{ old('quantity') ?? $product->quantity }}"  required autofocus>
                                </div>

                            @if ($errors->has('quantity'))
                                <span class="help-block">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">

                            <label for="category_id" class="col-md-4 control-label">category</label>
                            <select class="form-control" name="category_id"  id="category_id" required autofocus>
                                @foreach($category as $c)

                                    <option value = "{{ $c->id }}" {{ $c->id  === $product->category_id ?'selected' : ''}}>{{ $c->name }}</option>
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
                                    <option value = "{{ $b->id }}" {{ $b->id  === $product->brand_id ?'selected' : ''}}>{{ $b->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('brand_id'))
                                <span class="help-block">
                        <strong>{{ $errors->first('brand_id') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div  class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                            <label for="discount" class="col-md-4 control-label">discount</label>
                                <div>
                                    <input id="discount" type="text" class="form-control" name="discount"
                                        value="{{ old('discount') ?? $product->discount }}"  required autofocus>
                                </div>

                            @if ($errors->has('discount'))
                                <span class="help-block">
                            <strong>{{ $errors->first('discount') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary"  style="margin-top:10px;width: 20%">Save Product</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection




