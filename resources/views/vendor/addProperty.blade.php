@extends('layouts.vendor2')

@section('content')

<div class="card-body">
    <div class="row justify-content-center">
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
        <div class="col-md-8 col-sm-8">
            <form method="POST" action="{{ route('vendor.product.store.properties',$product->id) }}">
                @csrf
                <div class="form-group text-center">
                    <input  class="btn btn-primary" type="submit" value="Add properties">
                </div>

            <table class="table table-bordered">
                <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        value
                    </th>
                </thead>
                <tbody id="dynamicInput">

                </tbody>
            </table>
            </form>
        </div>
    </div>

       <div class="form-group text-center">
           <input class="btn btn-primary" type="button" value="Add another text input" onClick="addInput('dynamicInput');">
      </div>



</div>

<script>

    var counter = 0;
    var limit = 10;

    function addInput(divName) {
        if (counter == limit) {
            alert("You have reached the limit of adding " + counter + " inputs");
        }
        else {
            var newdiv = document.createElement('tr');
            newdiv.innerHTML ="<td><input type='text' name='names[]' class=\"form-control\" required></td>" +
                "<td><input type='text' name='values[]' class=\"form-control\" required></td>";
            document.getElementById(divName).appendChild(newdiv);
            counter++;
        }
    }


</script>
@endsection
