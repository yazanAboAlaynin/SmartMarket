@extends('layouts.company2')

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

                <th>order id</th>

                <th>product id</th>

                <th>quantity</th>

                <th>price</th>

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

                ajax: "{{ route('company.soldItems') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'order_id', name: 'order_id'},

                    {data: 'product_id', name: 'product_id'},

                    {data: 'quantity', name: 'quantity'},

                    {data: 'price', name: 'price'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });



    </script>


@endsection