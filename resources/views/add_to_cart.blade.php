@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"></div>
            <div class="card-header">{{ $shoe->name }}</div>

            <div class="card-body">
                {{Auth::user()->username}}<br>
                <img style="height: 300px; width:300px;" src="{{asset('/images/'.$shoe['image'])}}"><br>
                {{$shoe->description}}<br>
                Rp. {{$shoe->price}}<br>
                <form method="post" action='/cart/{{$shoe->id}}'>
                    @csrf
                    <div class="form-group row">
                        <label for="quantity" class="col-md-2 col-form-label">quantity</label>
                        <div class="col-md-4">
                            <input type="number" min='1' class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="input quantity" name="quantity">
                            @error('quantity')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add to cart</button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection