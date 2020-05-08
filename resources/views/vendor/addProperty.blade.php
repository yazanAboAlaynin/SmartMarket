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
                    <th style="text-align: center">
                        <a href="" class="btn btn-info addRow">+</a>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="name" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="value" class="form-control">
                        </td>
                        <td style="text-align: center">
                            <a href="" class="btn btn-danger remove">-</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </div>

       <div class="form-group text-center">
               <button class="btn btn-primary"  style="margin-top:10px;width: 10%">Add Property</button>
      </div>
 
</div>


    <script type="text/javascript">
            $('.addRow').on('click',function(){
                    addRow();
            });

            function addRow() {
                var tr = '<tr>'+
                        '<td><input type="text" name="name" class="form-control"></td>'+
                        '<td><input type="text" name="value" class="form-control"></td>'+
                        '<td style="text-align: center"><a href="" class="btn btn-danger remove">-</a></td>'+
                    '</tr>';
                    $('tbody').append(tr);
            };

            $('tbody').on('click', '.remove', function(){
                $(this).parent().parent().remove();
            });

    </script>


@endsection
