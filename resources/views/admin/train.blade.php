@extends('layouts.admin')

@section('content')

    <div class="container">
        <h1>Training</h1>
        <div class="row">
            <div class="col-md-7">
                <form method="POST" action="{{ route('admin.train1') }}">
                    @csrf
                    <div class="bg-white border-0 pt-1 pb-3">
                        <h2 class="text-center">{{ __('Train Model for Users has Orders') }}</h2>

                    </div>
                    <div class="form-group row">
                        <label for="cluster" class="col-md-4 col-form-label text-md-right">{{ __('Number of Clusters') }}</label>

                        <div class="col-md-6">
                            <input id="cluster" type="text" class="form-control @error('cluster') is-invalid @enderror" name="cluster" value="{{ old('cluster') }}" required autocomplete="cluster" autofocus>

                            @error('cluster')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <input type="hidden" name="device_token" id="device_token">
                            <button type="submit" class="btn btn-primary" style="width: 100%">
                                {{ __('Train') }}
                            </button>
                        </div>
                    </div>
                </form>
                <hr/>
                <form method="POST" action="{{ route('admin.train2') }}">
                    @csrf
                    <div class="bg-white border-0 pt-1 pb-3">
                        <h2 class="text-center">{{ __('Train Model for new Users') }}</h2>

                    </div>
                    <div class="form-group row">
                        <label for="cluster" class="col-md-4 col-form-label text-md-right">{{ __('Number of Clusters') }}</label>

                        <div class="col-md-6">
                            <input id="cluster" type="text" class="form-control @error('cluster') is-invalid @enderror" name="cluster" value="{{ old('cluster') }}" required autocomplete="cluster" autofocus>

                            @error('cluster')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <input type="hidden" name="device_token" id="device_token">
                            <button type="submit" class="btn btn-primary" style="width: 100%">
                                {{ __('Train') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    var op = <?PHP echo (($score!=0) ? json_encode($score) : '"%"'); ?>;
    if(op!='%')
    alert(op+'%');
</script>
@endsection
