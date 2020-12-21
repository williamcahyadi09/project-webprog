@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="card flex-row flex-wrap">
                        <div class="card-header">
                            <img style="height: 300px; width:300px;" src="{{asset('/images/'.$shoe['image'])}}">
                        </div>
                        <div class="card-block p-3 d-flex flex-column justify-content-between">
                            <div>
                                <h4 class="card-title">{{$shoe->name}}</h4>
                                <div class="card-text my-3">
                                    <div><strong>Price:</strong> Rp. {{number_format($shoe->price,0,",",".")}}</div>
                                    <strong>Description:</strong>
                                    <div>{{$shoe->description}}</div>
                                </div>
                            </div>
                            <div>
                                <form method="post" action='/cart/{{$shoe->id}}' class="d-inline">
                                    @method('put')
                                    @csrf
                                    <div class="form-group row">
                                        <label for="quantity" class="col-md-2 col-form-label">Quantity</label>
                                        <div class="col-md-4">
                                            <input type="number" class="form-control" id="quantity" placeholder="Number" name="quantity" value="{{$cart_detail->quantity}}">
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
                        <div class="w-100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection