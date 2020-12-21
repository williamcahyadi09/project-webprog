@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            @if ($cart->isEmpty())
            <h3>Your Cart is Empty</h3>
            @else 
            <h2>Cart list</h2>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th></th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td>
                                    <img style="height: 120px; width:120px;" src="{{asset('/images/'.$item->shoe->image)}}">
                                </td>
                                <td>
                                    <a href="{{route('shoe_detail',[$item->shoe])}}">{{$item->shoe->name}}</a>
                                </td>
                                <td>
                                    {{$item->quantity}}
                                </td>
                                <td>
                                    @php
                                    $price = $item->quantity * $item->shoe->price
                                    @endphp
                                    Rp. {{number_format($price,0,",",".")}}
                                </td>
                                <td>
                                    <a href="/cart/edit/{{$item->shoe->id}}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer" style="line-height:3">
                    <h4 class="d-inline">Total Price : Rp. {{number_format($total_price,0,",",".")}}</h4>
                    <a href='/cart/checkout' class='btn btn-success d-inline float-right'>Check Out</a>            
                </div>
            </div>
            <br>
            @endif
        </div>
    </div>
</div>
@endsection