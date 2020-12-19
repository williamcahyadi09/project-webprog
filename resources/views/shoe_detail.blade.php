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
            <div class="card">
                <div class="card-header">{{ $shoe->name }}</div>

                <div class="card-body">
                    {{Auth::user()->username}}<br>
                    <img style="height: 300px; width:300px;" src="{{asset('/images/'.$shoe['image'])}}"><br>
                    {{$shoe->description}}<br>
                    Rp. {{$shoe->price}}<br>
                    @if(Auth::user()->role_id==1)
                    <a href="/shoe/edit/{{$shoe->id}}">Update Shoe</a>
                    @else
                    <a href="/cart/create/{{$shoe->id}}">Add to cart</a>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection