@extends('layouts.admin')

@section('content')


  <div class="container pt-2">
  <div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card card-default">
        <div class="card-header">
            All Users and Vendors and Products
        </div>
        <table class="card-body">
        <table class="table">
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>
                            Users <span class="ml-2 badge badge-warning">6</span>
                        </td> 
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    </tr>
                        <td>
                            Vendors <span class="ml-2 badge badge-warning">6</span>
                        </td>
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    <tr>
                    </tr>
                        <td>
                            Vendors Requests <span class="ml-2 badge badge-warning">6</span>
                        </td>
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    <tr>
                    <tr>
                        <td>
                            Products <span class="ml-2 badge badge-warning">6</span>
                        </td>
                        <td>
                            <a href="  " class="btn float-right btn-dark btn-sm">Show</a>
                        </td>
                    </tr>

                    </tr>
                    @endforeach
                </tbody>
        </table>
        </table>
    </div>
    </div>
    </div>
  </div>




@endsection
