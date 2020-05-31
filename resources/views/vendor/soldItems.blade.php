@extends('layouts.vendor2')

@section('content')

    <div class="container">

        <h1>Orders:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>order id</th>

                <th>product id</th>

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

                ajax: "{{ route('vendor.soldItems') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'order_id', name: 'order_id'},

                    {data: 'product_id', name: 'product_id'},

                    {data: 'quantity', name: 'quantity'},

                    {data: 'price', name: 'price'},

                ]

            });



        });



    </script>


@endsection