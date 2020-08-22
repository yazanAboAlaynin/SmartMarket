@extends('layouts.vendor2')

@section('content')

    <div class="container pt-2">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit Discount</h1>
                    </div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('vendor.discount.edit',$discount->id) }}">
                            @csrf

                            <div  class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                                <label for="discount" class="col-md-4 control-label">discount</label>
                                <div>
                                    <input id="discount" type="text" class="form-control" name="discount"
                                           value="{{ old('discount') ?? $discount->discount }}"  required autofocus>
                                </div>

                                @if ($errors->has('discount'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('discount') }}</strong>
                        </span>
                                @endif

                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-primary"  style="margin-top:10px;width: 20%">Save Discount</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




