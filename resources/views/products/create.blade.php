@extends('layouts.master')
@section('title', 'Create Product')
@section('content')
<h1>Create Product</h1>
@if(session()->has('error'))
<p style="color:red;">{{ session()->get('error') }}</p>
@endif
<form method="post" action="{{ route('products.store') }}" style="width: 600px" autocomplete="off">
    @csrf
    <div class="form-group" style="margin-bottom : 10px">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Input product name" value="{{old('name')}}" autocomplete="off">
        @if($errors->has('name'))
        <p style="color:red;">{{ $errors->first('name') }}</p>
        @endif
    </div>
    <div class="form-group" style="margin-bottom : 10px">
        <label for="quantity">Quantity</label>
        <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Input quantity" value="{{old('quantity')}}" autocomplete="off">
        @if($errors->has('quantity'))
        <p style="color:red;">{{ $errors->first('quantity') }}</p>
        @endif
    </div>
    <div class="form-group" style="margin-bottom : 10px">
        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="Input product price" value="{{old('price')}}" autocomplete="off">
        @if($errors->has('price'))
        <p style="color:red;">{{ $errors->first('price') }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary" id="save" >Submit</button>
</form>
@endsection