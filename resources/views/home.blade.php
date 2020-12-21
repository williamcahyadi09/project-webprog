@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2 class="mr-4">Shoes</h2>{{$shoes->links()}}
    </div>
    <div class="row justify-content-center">
        <div class="d-flex flex-row flex-wrap justify-content-center">
            @forelse($shoes as $shoe)
            <div class="card" style="width: 300px;margin: 10px">
                <img class="card-img-top" style="height:300px;width:300px;" src="{{asset('/images/'.$shoe['image'])}}">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">
                        <a href="{{route('shoe_detail',[$shoe])}}">{{$shoe->name}}</a>
                    </h5>
                    <div class="card-text">Rp. {{number_format($shoe->price,0,",",".")}}</div>
                </div>
            </div>
            @empty
            <h4>No Result Found :(</h4>
            @endforelse
        </div>
    </div>
</div>
@endsection