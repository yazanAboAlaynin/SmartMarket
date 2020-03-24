@extends('layouts.company')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <h1>Edit Product</h1>
                </div>
                <form method="POST" action="{{ route('company.product.edit',$product->id) }}">
                    @csrf


                <div  class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input id="name" type="text" class="form-control" name="name"
                                   value="{{ old('name') ?? $product->name }}"  required autofocus>
                        </div>

                    </div>
                    @if ($errors->has('name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif

                </div>

                    <div  class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label">description</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="description" type="text" class="form-control" name="description"
                                       value="{{ old('description') ?? $product->description }}"  required autofocus>
                            </div>

                        </div>
                        @if ($errors->has('description'))
                            <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                        @endif

                    </div>

                    <div  class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="col-md-4 control-label">price</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="price" type="text" class="form-control" name="price"
                                       value="{{ old('price') ?? $product->price }}"  required autofocus>
                            </div>

                        </div>
                        @if ($errors->has('price'))
                            <span class="help-block">
                          <strong>{{ $errors->first('price') }}</strong>
                      </span>
                        @endif

                    </div>

                    <div  class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                        <label for="quantity" class="col-md-4 control-label">quantity</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="quantity" type="text" class="form-control" name="quantity"
                                       value="{{ old('quantity') ?? $product->quantity }}"  required autofocus>
                            </div>

                        </div>
                        @if ($errors->has('quantity'))
                            <span class="help-block">
                          <strong>{{ $errors->first('quantity') }}</strong>
                      </span>
                        @endif

                    </div>

                    <div  class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id" class="col-md-4 control-label">category</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="category_id" type="text" class="form-control" name="category_id"
                                       value="{{ old('category_id') ?? $product->category_id }}"  required autofocus>
                            </div>

                        </div>
                        @if ($errors->has('category_id'))
                            <span class="help-block">
                          <strong>{{ $errors->first('category_id') }}</strong>
                      </span>
                        @endif

                    </div>

                    <div  class="form-group{{ $errors->has('brand_id') ? ' has-error' : '' }}">
                        <label for="brand_id" class="col-md-4 control-label">brand</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="brand_id" type="text" class="form-control" name="brand_id"
                                       value="{{ old('brand_id') ?? $product->brand_id }}"  required autofocus>
                            </div>

                        </div>
                        @if ($errors->has('brand_id'))
                            <span class="help-block">
                          <strong>{{ $errors->first('brand_id') }}</strong>
                      </span>
                        @endif

                    </div>

                    <div  class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                        <label for="discount" class="col-md-4 control-label">discount</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="discount" type="text" class="form-control" name="discount"
                                       value="{{ old('discount') ?? $product->discount }}"  required autofocus>
                            </div>

                        </div>
                        @if ($errors->has('discount'))
                            <span class="help-block">
                          <strong>{{ $errors->first('discount') }}</strong>
                      </span>
                        @endif

                    </div>

                    <div  class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <label for="image" class="col-md-4 control-label">image</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="image" type="text" class="form-control" name="image"
                                       value="{{ old('image') ?? $product->image }}"  required autofocus>
                            </div>

                        </div>
                        @if ($errors->has('image'))
                            <span class="help-block">
                          <strong>{{ $errors->first('image') }}</strong>
                      </span>
                        @endif

                    </div>
                    <div class="row">
                        <button class="btn btn-primary"  style="margin-top:30px">Save Profile</button>
                    </div>

                </form>
            </div>
        </div>



        <br>


    </div>
@endsection



