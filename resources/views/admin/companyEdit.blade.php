@extends('layouts.admin')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                <form method="POST" action="{{ route('admin.company.edit',$company->id) }}">
                    @csrf


                <div  class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input id="name" type="text" class="form-control" name="name"
                                   value="{{ old('name') ?? $company->name }}"  required autofocus>
                        </div>

                    </div>
                    @if ($errors->has('name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif

                </div>

                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    <label for="mobile" class="col-md-4 control-label">Mobile </label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input id="mobile" type="text" class="form-control" name="mobile"
                                   value="{{ old('mobile') ?? $company->mobile }}" required autofocus>
                        </div>

                    </div>
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                          <strong>{{ $errors->first('mobile') }}</strong>
                      </span>
                    @endif

                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Phone</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input id="phone" type="text" class="form-control" name="phone"
                                   value="{{ old('phone') ?? $company->phone }}" required autofocus>
                        </div>

                    </div>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                          <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                    @endif

                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">email</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input id="email" type="text" class="form-control" name="email"
                                   value="{{ old('email') ?? $company->email }}" required autofocus>
                        </div>

                    </div>


                    @if ($errors->has('email'))
                        <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif

                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">address</label>

                    <div class="row">
                        <div class="col-lg-6">
                            <input id="address" type="text" class="form-control" name="address"
                                   value="{{ old('address') ?? $company->address }}" required autofocus>
                        </div>

                    </div>


                    @if ($errors->has('address'))
                        <span class="help-block">
                          <strong>{{ $errors->first('address') }}</strong>
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




