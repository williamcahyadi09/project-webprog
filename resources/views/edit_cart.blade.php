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
                <form method="post" action='/cart/{{$shoe->id}}' class="d-inline">
                    @method('put')
                    @csrf
                    <div class="form-group row">
                        <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                        <div class="col-md-4">
                            <input type="number" min='1' class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="input quantity" name="quantity" value="{{$cart_detail->quantity}}">

                            @error('quantity')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update cart</button>
                </form>
                <form method="post" action="/cart/{{$shoe->id}}" class="d-inline ml-3">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection