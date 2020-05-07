@extends('layouts.admin')

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
                        <h1>add new Category</h1>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.category.store') }}" enctype="multipart/form-data" method="post">
                            @csrf

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">name</label>


                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                @endif

                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary"  style="margin-top:10px;width: 30%">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
