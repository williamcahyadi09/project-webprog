@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Cart list</h2>
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
                    Price : Rp.{{$price}}
                </div>
            </div>
            @endforeach
            <br>
            <h3>Total Price : Rp.{{$total_price}}</h3>
        </div>
    </div>
</div>
@endsection