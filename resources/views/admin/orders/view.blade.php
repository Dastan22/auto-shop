@extends('layouts.front')

@section('title')
    View Order
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Order View</h4>
                        <a href="{{url('orders')}}" class="btn btn-warning float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <div class="border p-2">{{$orders->fname}}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2">{{$orders->lname}}</div>
                                <label for="">Email</label>
                                <div class="border p-2">{{$orders->email}}</div>
                                <label for="">Contact No.</label>
                                <div class="border p-2">{{$orders->phone}}</div>
                                <label for="">Shipping Address</label>
                                <div class="border p-2">
                                    {{$orders->address1}},
                                    {{$orders->address2}},
                                    {{$orders->city}},
                                    {{$orders->state}},
                                    {{$orders->country}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders->orderitems as $orders)
                                        <tr>
                                            <td>{{$orders->products->name}}</td>
                                            <td>{{$orders->qty}}</td>
                                            <td>{{$orders->price}}</td>
                                            <td>
                                                <img src="{{asset('assets/uploads/products/'.$orders->products->image)}}" alt="">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2"> Grand Total: <span class="float-end">{{$orders->total_price}}</span></h4>
                              <div class="mt-5 px-2">
                                <label for="">Order Status</label>
                                  <form action="{{url('update-order/'.$orders->id)}}" method="POST">
                                      @csrf
                                      @method('PUT')
                                <select name="order_status" id="" class="form-select">
                                    <option {{$orders->status =='0'? 'selected' : ''}} value="0">Отправлен</option>
                                    <option {{$orders->status =='1'? 'selected' : ''}} value="1">Выполнен</option>
                                </select>
                                      <button type="submit" class="btn btn-primary float-end p-2">Update</button>
                                  </form>
                              </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
