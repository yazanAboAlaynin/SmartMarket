@extends('layouts.admin')

@section('content')


  <div class="container pt-2">
  <div class="row justify-content">
  <div class="col-md-8">
    <div class="card card-default">
        <div class="card-header">
            All Users and Vendors and Products
        </div>
        <table class="card-body">
        <table class="table">
                <tbody>

                    <tr>
                        <td>
                            Users <span id="users" class="ml-2 badge badge-warning"></span>
                        </td> 
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    </tr>
                        <td>
                            Vendors <span id="vendors" class="ml-2 badge badge-warning"></span>
                        </td>
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    <tr>
                    </tr>
                        <td>
                            Vendors Requests <span id="vendorsReq"  class="ml-2 badge badge-warning"></span>
                        </td>
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            Orders <span id="orders" class="ml-2 badge badge-warning"></span>
                        </td>
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    </tr>

                    </tr>

                </tbody>
        </table>
        </table>
    </div>
    </div>
    </div>
  </div>

  <script>

      $.ajax({
          url: "{{ route('admin.users.count') }}",
          type: 'get',
          dataType: 'html',
          success: function (data) {
              $('#users').html(data);
          }
      });
      $.ajax({
          url: "{{ route('admin.vendors.count') }}",
          type: 'get',
          dataType: 'html',
          success: function (data) {
              $('#vendors').html(data);
          }
      });
      $.ajax({
          url: "{{ route('admin.orders.count') }}",
          type: 'get',
          dataType: 'html',
          success: function (data) {
              $('#orders').html(data);
          }
      });
      $.ajax({
          url: "{{ route('admin.vendors.req.count') }}",
          type: 'get',
          dataType: 'html',
          success: function (data) {
              $('#vendorsReq').html(data);
          }
      });
  </script>

@endsection
