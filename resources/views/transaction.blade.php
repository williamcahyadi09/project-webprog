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
            @foreach($transactions as $transaction)
            <div class="card m-2">
                <div class="card-header d-flex flex-row justify-content-between">
                    <div class="d-inline-block">
                        Date : {{ $transaction->dateTime }}
                    </div>
                    <div class="d-inline-block">
                        Total Price : Rp. {{number_format($transaction->total_price,0,",",".")}}
                    </div>
                </div>
                <div class="card-body d-flex flex-row justify-content-center">
                    @foreach($transaction->transaction_details as $details)
                    <div class="card m-2" style="width:180px">
                        <img class="card-img-top" style="height: 180px; width:180px;" src="{{asset('/images/'.$details->shoe->image)}}">
                        <div class="card-body p-2 d-flex flex-column justify-content-between">
                            <div class="card-title">
                                <a href="{{route('shoe_detail',[$details->shoe])}}">{{ $details->shoe->name }}</a>
                            </div>
                            <div class="card-text">
                                Quantity : {{ $details->quantity }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection