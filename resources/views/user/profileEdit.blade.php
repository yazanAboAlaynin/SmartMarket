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

                    <form method="POST" action="{{ route('profile.update') }}">
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

                        <div  class="form-group{{ $errors->has('occupation') ? ' has-error' : '' }}">
                            <label for="occupation" class="col-md-4 control-label">Occupation</label>
                            <div >
                                <input id="occupation" type="text" class="form-control" name="occupation"
                                       value="{{ old('occupation') ?? $user->occupation }}"  required autofocus>
                            </div>

                            @if ($errors->has('occupation'))
                                <span class="help-block">
                            <strong>{{ $errors->first('occupation') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div  class="form-group{{ $errors->has('social_status') ? ' has-error' : '' }}">
                            <label for="social_status" class="col-md-4 control-label">Social status</label>
                            <div >
                                <input id="social_status" type="text" class="form-control" name="social_status"
                                       value="{{ old('social_status') ?? $user->social_status }}"  required autofocus>
                            </div>

                            @if ($errors->has('social_status'))
                                <span class="help-block">
                            <strong>{{ $errors->first('social_status') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div  class="form-group{{ $errors->has('scientific_level') ? ' has-error' : '' }}">
                            <label for="scientific_level" class="col-md-4 control-label">Scientific level</label>
                            <div >
                                <input id="scientific_level" type="text" class="form-control" name="scientific_level"
                                       value="{{ old('scientific_level') ?? $user->scientific_level }}"  required autofocus>
                            </div>

                            @if ($errors->has('scientific_level'))
                                <span class="help-block">
                            <strong>{{ $errors->first('scientific_level') }}</strong>
                        </span>
                            @endif

                        </div>

                        <div  class="form-group{{ $errors->has('three_most_hobbies') ? ' has-error' : '' }}">
                            <label for="three_most_hobbies" class="col-md-4 control-label">Three most hobbies</label>
                            <div >
                                <textarea  id="three_most_hobbies" type="text" class="form-control" name="three_most_hobbies" rows="3" required autofocus>{{ old('three_most_hobbies') ?? $user->three_most_hobbies }}</textarea>
                                {{--<input id="three_most_hobbies" type="text" class="form-control" name="three_most_hobbies"--}}
                                       {{--value="{{ old('three_most_hobbies') ?? $user->three_most_hobbies }}"  required autofocus>--}}
                            </div>

                            @if ($errors->has('three_most_hobbies'))
                                <span class="help-block">
                            <strong>{{ $errors->first('three_most_hobbies') }}</strong>
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




