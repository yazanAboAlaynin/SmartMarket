@extends('layouts.company')

@section('content')

    <div class="container">

        <h1>Products:</h1>

        <div align="right">
            <button  type="button" name="create_record" id="create_record" class="btn btn-success btn-sm" >Create Record</button>
        </div>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>image</th>

                <th>Name</th>

                <th>Description</th>

                <th>Price</th>

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

                ajax: "{{ route('company.products') }}",

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

                    {data: 'description', name: 'description'},

                    {data: 'price', name: 'price'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });

        function update(id) {
            window.location.href = 'product/'+id+'/update';
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

            xhttp.open("get", "{{ route("company.product.delete") }}?id=" + id, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

        }

    </script>


@endsection