@extends('layouts.userHome')

@section('content')

<div class="container pt-2">
   <div class="row justify-content-center ">
       <div class="col-md-8">
           <div class="card">
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

                        <div  class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div>
                                <input id="email" type="text" class="form-control" name="email"
                                       value="{{ old('email') ?? $user->email }}"  required autofocus>
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
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

                        <div  class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>
                            <div>
                                <input id="address" type="text" class="form-control" name="address"
                                       value="{{ old('address') ?? $user->address }}"  required autofocus>
                            </div>

                            @if ($errors->has('address'))
                                <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
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

                        <div  class="form-group{{ $errors->has('career') ? ' has-error' : '' }}">
                            <label for="career" class="col-md-4 control-label">Career</label>
                            <div >
                                <input id="career" type="text" class="form-control" name="career"
                                       value="{{ old('occupation') ?? $user->career }}"  required autofocus>
                            </div>

                            @if ($errors->has('career'))
                                <span class="help-block">
                            <strong>{{ $errors->first('career') }}</strong>
                        </span>
                            @endif

                        </div>

                        <br/>
                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right"
                            >{{ __('Social Status') }}</label>

                            <div class="col-md-5">
                                <select class="form-control @error('social_status') is-invalid @enderror" name="social_status" id="social_status" required autofocus>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated </option>
                                    <option value="Divorced">Divorced </option>
                                    <option value="Single">Single</option>
                                </select>
                            </div>
                        </div>
                        <br/>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right"
                            >{{ __('Gender') }}</label>

                            <div class="col-md-5">
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" required autofocus>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <br/>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right"
                            >{{ __('Scientific Degree') }}</label>

                            <div class="col-md-5">
                                <select class="form-control @error('scientific_level') is-invalid @enderror" name="scientific_level" id="scientific_level" required autofocus>
                                    <option value="Not Educated">Not Educated</option>
                                    <option value="High school diploma or equivalent">High school diploma or equivalent</option>
                                    <option value="Associate degree">Associate degree</option>
                                    <option value="Bachelor's degree">Bachelor's degree</option>
                                    <option value="Master's degree	">Master's degree </option>
                                    <option value="Doctoral degree">Doctoral degree </option>
                                </select>
                            </div>
                        </div>
                        <br/>

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




