@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1>Vendors:</h1>

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

                ajax: "{{ route('admin.vendors') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'name', name: 'name'},

                    {data: 'email', name: 'email'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });



        function del(id) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById("test").innerHTML = this.responseText;
                    //window.alert("deleted successfuly id = "+this.responseText);
                    $('.data-table').DataTable().ajax.reload();
                    alert('Data Deleted');
                }
            };
            var x = document.getElementById(id).value;
            xhttp.open("get", "{{ route("admin.vendor.delete") }}?id=" + id, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

        }

    </script>


@endsection