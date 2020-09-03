@extends('layouts.admin')

@section('content')

  <div class="container pt-5">
  <div class="row justify-content-center">

      <div class="col-md-5">
          <div class="container pt-lg-3 pb-lg-3" style="color:#fff;background-color:#1f8fa1;">
              <div><i class="fa fa-users" style="font-size:60px"></i></div>
              <div class="mr-2 float-right">
                  <h1>{{$users_count}}</h1>
              </div>
              <div class="mt-lg-4">
                  <h2 style="font-family: bold"><a href="{{ Route('admin.users') }}" class="badge-dark p-2">Users</a></h2>
              </div>
          </div>
      </div>

      <div class="col-md-5">
          <div class="container pt-lg-3 pb-lg-3" style="color:#fff;background-color:#26acc2;">
              <div><i class="fa fa-first-order" style="font-size:60px"></i></div>
              <div class="mr-2 float-right">
                  <h1>{{$orders_count}}</h1>
              </div>
              <div class="mt-lg-4">
                  <h2 style="font-family: bold"><a href="{{ Route('admin.orders') }}" class="badge-dark p-2">Orders</a></h2>
              </div>
          </div>
      </div>

      <div class="col-md-5  mt-4">
          <div class="container pt-lg-3 pb-lg-3" style="color:#fff;background-color:#219cb0">
              <div><i class="fa fa-line-chart" style="font-size:60px"></i></div>
              <div class="mr-2 float-right">
                  <h1>{{$vendors_count}}</h1>
              </div>
              <div class="mt-lg-4">
                  <h2 style="font-family: bold"><a href="{{ Route('admin.vendors') }}" class="badge-dark p-2">Vendors</a></h2>
              </div>
          </div>
      </div>

      <div class="col-md-5 mt-4">
          <div class="container pt-lg-3 pb-lg-3" style="color:#fff;background-color:#6cbfcc;">
              <div><i class="fa fa-briefcase" style="font-size:60px"></i></div>
              <div class="mr-2 float-right">
                  <h1>{{$vendorsReq_count}}</h1>
              </div>
              <div class="mt-lg-4">
                  <h2 style="font-family: bold"><a href="{{ Route('admin.pendingVendors') }}" class="badge-dark p-2">V_Requests</a></h2>
              </div>
          </div>
      </div>



  </div>
  </div>


@endsection
