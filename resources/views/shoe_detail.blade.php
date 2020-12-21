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
            <div class="card">
                <div class="card-body">
                    <div class="card flex-row flex-wrap">
                        <div class="card-header">
                            <img style="height: 300px; width:300px;" src="{{asset('/images/'.$shoe['image'])}}">
                        </div>
                        <div class="card-block p-3">
                            <h4 class="card-title">{{$shoe->name}}</h4>
                            <div class="card-text my-3">
                                <div><strong>Price:</strong> Rp. {{number_format($shoe->price,0,",",".")}}</div>
                                <strong>Description:</strong>
                                <div>{{$shoe->description}}</div>
                            </div>
                            @guest
                            @else
                                @if(Auth::user()->role_id==config('enums.roles')['ADMIN'])
                                <a class="btn btn-primary" href="/shoe/edit/{{$shoe->id}}">Update Shoe</a>
                                @else
                                <a class="btn btn-primary" href="/cart/create/{{$shoe->id}}">Add to cart</a>
                                @endif
                            @endguest
                        </div>
                        <div class="w-100"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection