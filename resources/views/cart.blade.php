@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            @if ($cart->isEmpty())
            <h3>Your Cart is Empty</h3>
            @else <h2>Cart list</h2>
            @foreach($cart as $item)
            <div class="card">
                <div class="card-header">
                    {{$item->shoe->name}}
                </div>

                <div class="card-body">
                    Quantity : {{ $item->quantity }}<br>
                    @php
                    $price = $item->quantity * $item->shoe->price
                    @endphp
                    Price : Rp.{{$price}}<br>
                    <a href="/cart/edit/{{$item->shoe->id}}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            @endforeach
            <br>
            <h4 class="d-inline">Total Price : Rp.{{$total_price}}</h4>
            <a href='/cart/checkout' class='btn btn-success d-inline float-right'>Check Out</a>

            @endif
        </div>
    </div>
</div>
@endsection