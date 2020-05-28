@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1>Order {{ $order->id }} :</h1>

        <br/>
        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>quantity</th>

                <th>price</th>


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

                ajax: "{{ route('admin.order.items',$order->id) }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'quantity', name: 'quantity'},

                    {data: 'price', name: 'price'},


                ]

            });



        });

        function show(id) {
            window.location.href = 'order/'+id+'/view';
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
            xhttp.open("get", "{{ Route("admin.order.done") }}?id=" + id, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

        }

    </script>


@endsection