@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!--
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                -->
                @foreach($transactions as $transaction)
                <div class="card-header">
                    Transaction id : {{ $transaction->id }}<br>
                    Date : {{ $transaction->dateTime }}
                </div>

                <div class="card-body">
                    @foreach($transaction->transaction_details as $details)
                    <div class="card-header">
                        {{ $details->id }}
                    </div>

                    <div class="card-body">
                        {{ $details->shoe->name }}<br>
                        Quantity : {{ $details->quantity }}
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection