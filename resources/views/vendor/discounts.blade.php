@extends('layouts.vendor2')

@section('content')

    <div class="container">

        <h1>Discounts:</h1>

        <br/>
        <br/>

        <table class="table table-bordered table-striped data-table">

            <thead>

            <tr>

                <th>id</th>

                <th>image</th>

                <th>Name</th>

                <th>Discount</th>

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

                ajax: "{{ route('vendor.discounts') }}",

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

                    {data: 'discount', name: 'discount'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });



        });

        function update(id) {
            window.location.href = 'discount/'+id+'/update';
        }

        function del(id) {

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById("test").innerHTML = this.responseText;
                    //window.alert("deleted successfuly id = "+this.responseText);
                    $('.data-table').DataTable().ajax.reload();
                    alert('Discount Deleted');
                }
            };

            xhttp.open("get", "{{ route("vendor.discount.delete") }}?id=" + id, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();

        }

    </script>


@endsection