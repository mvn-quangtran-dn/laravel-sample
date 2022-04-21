@extends('layouts.master')
@section('title', 'Edit User')
@section('content')
<h1>Edit user info</h1>
<form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" style="width: 600px">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">UserName</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Input your name" value="{{old('name') ? old('name'): $user->name}}">
        @if($errors->has('name'))
        <p style="color:red;">{{ $errors->first('name') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Input your email" value="{{old('email') ? old('email') : $user->email}}">
        @if($errors->has('email'))
        <p style="color:red;">{{ $errors->first('email') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Input your password" value="{{old('password')}}">
        @if($errors->has('password'))
        <p style="color:red;">{{ $errors->first('password') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="country">Select your country</label>
        <select class="form-control" name="country_id" id="country">
          @foreach($countries as $country)
          <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
          @endforeach
        </select>
        @if($errors->has('country_id'))
        <p style="color:red;">{{ $errors->first('country_id') }}</p>
        @endif
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-primary" id="save" >Update</button>
    </div>
</form>
@endsection