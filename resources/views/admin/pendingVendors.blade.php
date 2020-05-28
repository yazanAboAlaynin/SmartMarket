@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1>Pending Companies:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>Name</th>

                <th>Email</th>

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

                ajax: "{{ route('admin.pendingVendors') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'name', name: 'name'},

                    {data: 'email', name: 'email'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });

        function done(id) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    $('.data-table').DataTable().ajax.reload();
                }
            };
            var x = document.getElementById(id).value;
            xhttp.open("get", "{{ Route("admin.vendor.approve") }}?id=" + id, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

        }

    </script>


@endsection