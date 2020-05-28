@extends('layouts.admin')

@section('content')

    <div class="container">

        <h1>Orders:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>image</th>

                <th>name</th>


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

                ajax: "{{ route('admin.brands') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {
                        "name": "image",
                        "data": "image",
                        "render": function (data, type, full, meta) {
                            return "<img src=\"/storage/" + data + "\" height=\"60\" />";
                        },
                        "title": "Image",
                        "orderable": true,
                        "searchable": true
                    },

                    {data: 'name', name: 'name'},



                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });
        function update(id) {
            window.location.href = 'brand/'+id+'/update';
        }

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

            xhttp.open("get", "{{ route("admin.brand.delete") }}?id=" + id, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

        }

    </script>


@endsection