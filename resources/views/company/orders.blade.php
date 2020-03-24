@extends('layouts.company')

@section('content')

    <div class="container">

        <h1>Orders:</h1>

        <div align="right">
            <button  type="button" name="create_record" id="create_record" class="btn btn-success btn-sm" >Create Record</button>
        </div>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>Total Price</th>

                <th>discount</th>

                <th width="100px">Action</th>

            </tr>

            </thead>

            <tbody>

            </tbody>

        </table>

    </div>



    </body>



    <script type="text/javascript">

        $(function () {



            var table = $('.data-table').DataTable({

                processing: true,

                serverSide: true,

                ajax: "{{ route('company.orders') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'total_price', name: 'total_price'},

                    {data: 'discount', name: 'discount'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });

        function show(id) {
            window.location.href = 'order/'+id+'/items';
        }

        function done(id) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById("test").innerHTML = this.responseText;
                    window.alert("deleted successfuly id = "+this.responseText);
                    $('.data-table').DataTable().ajax.reload();
                    alert('Data Deleted');
                }
            };
            var x = document.getElementById(id).value;
            xhttp.open("get", "{{ Route("company.order.done") }}?id=" + id, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

        }

    </script>


@endsection