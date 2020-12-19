@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Shoe
                </div>
                <div class="card-body">
                    <form method="post" action='/shoe/create' class="d-inline" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label">Shoe Name</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Input shoe name" name="name" value="{{old('name')}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-3 col-form-label">Price</label>
                            <div class="col-md-7">
                                <input type="number" min='100' class="form-control @error('price') is-invalid @enderror" placeholder="Input price" name="price" value="{{old('price')}}">
                                @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label">Shoe Description</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Input shoe description" name="description" value="{{old('description')}}">
                                @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-md-3 col-form-label">Upload image</label>
                            <div class="custom-file col-md-6 ml-3">
                                <input type="file" class="form-control custom-file-input @error('file') is-invalid @enderror" id="chooseFile" onchange="getFileName()" name="file">
                                @error('file')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <label class="custom-file-label" for="chooseFile" id="fileLabel">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add shoe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getFileName() {
        var fileName = document.getElementById('chooseFile').files[0].name;
        var label = document.getElementById('fileLabel').innerHTML = fileName;
    }
</script>

@endsection