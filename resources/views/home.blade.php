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
                @foreach($shoes as $shoe)
                <div class="card-header">{{ $shoe->name }}</div>

                <div class="card-body">
                    {{$shoe->description}}
                    <a href="{{route('shoe_detail',[$shoe])}}">view detail</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection