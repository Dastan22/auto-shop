@extends('layouts.front')

@section('title')
    Category
@endsection

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>All categories</h2>
            <div class="col-md-12">
                <div class="row">
                    @foreach($category as $cate)
                                        <div class="col-md-3 mb-3">
                                            <a href="{{url('view-category/'.$cate->slug)}}">
                                            <div class="card">
                                            <img src="{{asset('assets/uploads/category/'.$cate->image)}}" alt="Product image">
                                            <div class="card-body">
                                                <h5>{{$cate->name}}</h5>
                                                <p>
                                                    {{$cate->description}}
                                                </p>
                                </div>
                            </div>
                                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
