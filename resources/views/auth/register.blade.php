<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-messaging.js"></script>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
</head>
<style>
    .middle {
        margin-left: 100px;

    }

    input {
        margin-top: 20px;
    }

    button {
        margin-top: 30px;
    }
</style>
<body style="
        background-color: #90caf8;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        ">
<div id="app">

    <main class="py-4">
        <div class="container p-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-white border-0 pt-5">
                            <h2 class="text-center">{{ __('Register User') }}</h2>

                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input id="name" type="text"
                                               class="middle form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name') }}" required autocomplete="name"
                                               autofocus placeholder="Name">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">


                                    <div class="col-md-8">
                                        <input id="email" type="email"
                                               class="middle form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" required autocomplete="email"
                                               placeholder="Email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">


                                    <div class="col-md-8">
                                        <input id="password" type="password"
                                               class="middle form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="new-password"
                                               placeholder="Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="middle form-control"
                                               name="password_confirmation" required autocomplete="new-password"
                                               placeholder="Confirm Password">
                                    </div>
                                </div>


                                <div class="form-group row">


                                    <div class="col-md-8">
                                        <input id="mobile" type="text"
                                               class="middle form-control @error('mobile') is-invalid @enderror"
                                               name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile"
                                               placeholder="Mobile">

                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input id="address" type="text"
                                               class="middle form-control @error('mobile') is-invalid @enderror"
                                               name="address" value="{{ old('address') }}" required
                                               autocomplete="address" placeholder="Address">

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input id="career" type="text"
                                               class="middle form-control @error('mobile') is-invalid @enderror"
                                               name="career" value="{{ old('career') }}" required autocomplete="career"
                                               placeholder="Career">

                                        @error('career')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <br/>
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
                                <br/>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <textarea class="middle form-control @error('mobile') is-invalid @enderror"
                                                  name="three_most_hobbies" required autocomplete="three_most_hobbies"
                                                  placeholder="Three most hobbies" id="three_most_hobbies"
                                                  rows="3">{{ old('three_most_hobbies') }}</textarea>
                                        {{--<input id="three_most_hobbies" type="text" class="middle form-control @error('mobile') is-invalid @enderror" name="three_most_hobbies" value="{{ old('three_most_hobbies') }}" required autocomplete="three_most_hobbies" placeholder="Three most hobbies">--}}

                                        @error('three_most_hobbies')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="dob" class="col-md-4 col-form-label text-md-right"
                                           style="margin-top: 20px;">{{ __('Date of birth') }}</label>

                                    <div class="col-md-6">
                                        <input id="dob" type="date"
                                               class="form-control @error('dob') is-invalid @enderror" name="dob"
                                               value="{{ old('dob') }}" required autocomplete="dob">

                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right"
                                           style="margin-top: 20px">{{ __('Image') }}</label>

                                    <div class="col-md-6">
                                        <input id="image" type="file" class="form-control" name="image"
                                               value="{{ old('image') }}" required autofocus>

                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-2">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 p-0">
                    <div class="" style="height: 500px;">

                        <div class="card-body">
                            <img src="{{asset('images/logo.png')}}"
                                 style="width: 500px;height: 500px;padding-right: 40px"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>


