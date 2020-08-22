@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1>Old Orders:</h1>

        <br/>
        <br/>
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

                ajax: "{{ route('admin.oldOrders') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'total_price', name: 'total_price'},

                    {data: 'discount', name: 'discount'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });

        function show(id) {
            window.location.href = '/admin/order/'+id+'/items';
        }

    </script>


@endsection