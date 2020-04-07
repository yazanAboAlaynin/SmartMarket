@extends('layouts.showProducts')

@section('content')

    <div class="container">
        <table id="cart" class="table table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Subtotal</th>
                <th style="width:10%">Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $total = 0;
            $u_id = auth()->user()->id;
            ?>

            @foreach($products as $product )
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs">
                                <img src="/storage/{{ $product['item']->image }}" width="100" height="100" class="img-responsive"/>
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $product['item']->name }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $product['item']->price }}</td>
                    <td data-th="Quantity">
                        {{ $product['qty'] }}
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $product['price'] }}</td>
                    <td class="actions" data-th="">
                        <a href="{{ Route("addProduct",$product['item']->id) }}" class="btn btn-info btn-sm update-cart"
                           data-id="{{ $product['item']->id }}" >+
                        </a>
                        <a href="{{ Route("deleteProduct",$product['item']->id) }}" class="btn btn-danger btn-sm delete-cart"
                           data-id="{{ $product['item']->id }}" >-
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr class="visible-xs">

            </tr>
            <tr>
                <td><a href="{{ url('/products') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                        Continue Shopping</a></td>
                <td></td>
                <td colspan="1" class="hidden-xs">{{ $totalQty }}</td>
                <td class="hidden-xs text-center"><strong>Total: {{ $totalPrice }}$</strong></td>
            </tr>
            </tfoot>
        </table>
        <a href="{{ Route('order') }}">Order Now</a>
    </div>

</div>


@endsection
