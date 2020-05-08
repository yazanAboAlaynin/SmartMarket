@extends('layouts.vendor2')

@section('content')

<div class="card-body">
    <div class="row justify-content-center">

        <div class="col-md-8 col-sm-8">

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
            newdiv.innerHTML ="<td><input type='text' name='myInputs[]' class=\"form-control\"></td>" +
                "<td><input type='text' name='myInputs[]' class=\"form-control\"></td>";
            document.getElementById(divName).appendChild(newdiv);
            counter++;
        }
    }


</script>
@endsection
