@extends('layouts.front')

@section('title')
    My Cart
@endsection
@section('content')
    <div class="py-3 md-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{url('/')}}">Home</a>  /
                <a href="{{url('cart')}}">
                    Cart
                </a>
               </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow ">
            <div class="card-body">
                @php $total = 0; @endphp
                @foreach($cartitems as $item)
                <div class="row product_data">
                    <div class="col-md-2 my-auto">
                        <img src="{{asset('assets/uploads/products/'.$item->products->image)}}" height="70px" width="70px" alt="">
                    </div>
                    <div class="col-md-3 my-auto">
                        <h6>{{$item->products->name}}</h6>
                    </div>
                    <div class="col-md-2 my-auto">
                        <h6>{{ $item->products->selling_price }}</h6>
                    </div>
                    <div class="col-md-3 my-auto">
                        <input type="hidden" class="prod_id" value="{{$item->prod_id}}">
                        <label for="Quantity">Quantity</label>
                        <div class="input-group text-center mb-3" style="width: 130px">
                            <button class="input-group-text changeQuantity decrement-btn">-</button>
                            <input type="text" name="quantity" class="form-control qty-input text-center" value="{{$item->prod_qty}}">
                            <button class="input-group-text changeQuantity increment-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger delete-cart-item">Remove</button>
                    </div>
                </div>
                    @php $total += $item->products->selling_price * $item->prod_qty ; @endphp
                @endforeach
            </div>
            <div class="card-footer">
                <h6>Total Price : {{$total}}
                <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                </h6>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {

            $('.addToCartBtn').click(function (e) {
                e.preventDefault();
                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty_input').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/add-to-cart",
                    data:{
                        'product_id': product_id,
                        'product_qty': product_qty,
                    },
                    success: function (response){
                        alert(response.status);
                    }
                });


            })

            $('.increment-btn').click(function (e){
                e.preventDefault();

                var inc_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10){
                    value++;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });


            $('.decrement-btn').click(function (e){
                e.preventDefault();

                var dec_value = $(this).closest('.product_data').find('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1){
                    value--;
                    $(this).closest('.product_data').find('.qty-input').val(value);
                }
            });

            $('.delete-cart-item').click(function (e){
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                $.ajax({
                    method: "POST",
                    url: "delete-cart-item",
                    data: {
                        'prod_id':prod_id,
                    },
                    success: function (response){
                        window.location.reload();
                        swal("", response.status, "success");
                    }
                });
            })

            $('changeQuantity').click(function (e){
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var prod_qty = $(this).closest('.product_data').find('.qty_input').val();
                data = {
                    'prod_id' : prod_id,
                    'qty_input' : qty,
                }
                $.ajax({
                    method: "POST",
                    url: "update-cart",
                    data: data,
                    success:function (response){
                        window.location.reload();
                    }
                });
            })


        });

    </script>
@endsection

