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
                <div class="card-header">{{ $shoe->name }}</div>

                <div class="card-body">
                    {{Auth::user()->username}}<br>
                    <img style="height: 300px; width:300px;" src="{{asset('/images/'.$shoe['image'])}}"><br>
                    {{$shoe->description}}<br>
                    Rp. {{$shoe->price}}<br>
                    @if(Auth::user()->role_id==1)
                    <a href="cart/add">Update Shoe</a>
                    @else
                    <a href="">Add to cart</a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection