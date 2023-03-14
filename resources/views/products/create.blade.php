@extends('layouts.nav')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div style="margin-left:30% ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-12" style="margin-top:20px;">
                <div class="col-md-6">
                    @if (session('status'))
                    <h6 class="alert alert-success">{{session('status')}}</h6>
                    @endif
                    <div class="card">
                         <div class="card-header">
                            <h4>Add Product
                                <a href="{{url('products')}}" class="btn btn-danger btn-sm float-right">Back</a>
                            </h4>
                         </div>
                        <div class="card-body">
                            <form action="{{url('add-product')}}"method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control" value="{{old('name')}}" name="name"> </br>
                            @error('name')
                            <span class="text-danger">{{$message}}</span><br>
                            @enderror  

                            <div class="form-group mb-3">
                            <label for="">Description</label>
                            <input class="form-control" value="{{old('description')}}" name="description"> </br>
                            @error('description')
                            <span class="text-danger">{{$message}}</span><br>
                            @enderror 

                            <div class="form-group mb-3">
                            <label for="">Price</label>
                            <input type="text" class="form-control" value="{{old('price')}}" name="price"> </br>
                            @error('price')
                            <span class="text-danger">{{$message}}</span><br>
                            @enderror 

                            <div class="form-group mb-3">
                            <label for="">Upload Image</label>
                            <input type="file" class="form-control" value="{{old('image')}}" name="image"> </br>
                            @error('image')
                            <span class="text-danger">{{$message}}</span><br>
                            @enderror 

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </div>

                            </form>
                        </div>
                    </div>
  
                </div>
            </div>    
        </div>
    </div>
    </div>
    @endsection
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>