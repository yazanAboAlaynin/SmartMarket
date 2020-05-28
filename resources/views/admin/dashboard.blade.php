@extends('layouts.admin')

@section('content')


  <div class="container pt-2">
  <div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card card-default">
        <div class="card-header">
            All Users and Vendors and Products
        </div>
        <table class="card-body">
        <table class="table">
                <tbody>

                    <tr>
                        <td class="pt-3">
                            <h3>Users</h3>
                        </td> 
                        <td>
                            <h2><span id="users" class="mr-2 float-right badge badge-warning">{{$users_count}}</span></h2>
                        </td>
                    </tr>
                        <td class="pt-3">
                            <h3>Vendors</h3> 
                        </td>
                        <td>
                            <h2><span id="vendors" class="mr-2 float-right badge badge-warning">{{$vendors_count}}</span></h2>
                        </td>
                    <tr>
                    </tr>
                        <td class="pt-3">
                            <h3>Vendors Requests</h3> 
                        </td>
                        <td>
                            <h2><span id="vendorsReq"  class="mr-2 float-right badge badge-warning">{{$vendorsReq_count}}</span></h2>
                        </td>
                    <tr>
                    <tr>
                        <td class="pt-3">
                            <h3>Orders </h3>
                        </td>
                        <td>
                            <h2><span id="orders" class="mr-2 float-right badge badge-warning">{{$orders_count}}</span></h2>
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


@endsection
