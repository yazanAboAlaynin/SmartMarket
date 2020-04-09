@extends('layouts.userHome')

@section('content')

<div class="container pt-2">
   <div class="row justify-content-center ">
       <div class="col-md-8">
           <div class="card"> 
                   <div class="card-header">
                       <h1>Edit Profile</h1>
                   </div>
                <div class="card-body">  

                    <form method="POST" action="{{ route('user') }}">
                        @csrf

                    <div  class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>
                            <div>
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') ?? $user->name }}"  required autofocus>
                            </div>

                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif

                    </div>

                        <div  class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob" class="col-md-4 control-label">Date of birth</label>
                                <div >
                                    <input id="dob" type="text" class="form-control" name="dob"
                                        value="{{ old('dob') ?? $user->dob }}"  required autofocus>
                                </div>

                            @if ($errors->has('dob'))
                                <span class="help-block">
                            <strong>{{ $errors->first('dob') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div  class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Mobile</label>
                                <div >
                                    <input id="mobile" type="text" class="form-control" name="mobile"
                                        value="{{ old('mobile') ?? $user->mobile }}"  required autofocus>
                                </div>

                            @if ($errors->has('mobile'))
                                <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-10">
                                <button type="submit" style="width: 20%" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>
@endsection




