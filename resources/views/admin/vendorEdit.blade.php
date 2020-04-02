@extends('layouts.admin')

@section('content')

 <div class="container pt-2">

    <div class="row justify-content-center mt-6">
        <div class="col-md-6">

            <div class="card">
                    <div class="card-header">
                       <h1>Edit Profile</h1>
                    </div>

               <div class="card-body">

                    <form method="POST" action="{{ route('vendor',$vendor->id) }}">
                        @csrf


                        <div  class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            
                                <div >
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') ?? $vendor->name }}"  required autofocus>
                                </div>

                            
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

                        </div>

                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label for="mobile" class="col-md-4 control-label">Mobile </label>
                        
                            <div >
                                <input id="mobile" type="text" class="form-control" name="mobile"
                                    value="{{ old('mobile') ?? $vendor->mobile }}" required autofocus>
                            </div>

                        
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif

                    </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>
                            
                                <div >
                                    <input id="phone" type="text" class="form-control" name="phone"
                                        value="{{ old('phone') ?? $vendor->phone }}" required autofocus>
                                </div>

                            

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif

                        </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">email</label>
                        
                            <div >
                                <input id="email" type="text" class="form-control" name="email"
                                    value="{{ old('email') ?? $vendor->email }}" required autofocus>
                            </div>

                        


                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 control-label">address</label>

                        
                            <div >
                                <input id="address" type="text" class="form-control" name="address"
                                    value="{{ old('address') ?? $vendor->address }}" required autofocus>
                            </div>

                        


                        @if ($errors->has('address'))
                            <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif

                    </div>

                        <div class="form-group text-center">
                            <button class="btn btn-primary"  style="margin-top:10px;width: 20%">Save Profile</button>
                        </div>

                    </form>

               </div>
           </div>
        </div>
   </div>
</div>
@endsection




