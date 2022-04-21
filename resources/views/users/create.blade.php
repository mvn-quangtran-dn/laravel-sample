@extends('layouts.master')
@section('title', 'Create User')
@section('content')
<h1>Create user</h1>
@if(session()->has('error'))
<p style="color:red;">{{ session()->get('error') }}</p>
@endif
<form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" style="width: 600px" autocomplete="off">
    @csrf
    <div class="form-group" style="margin-bottom : 10px">
        <label for="name">UserName</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Input your name" value="{{old('name')}}" autocomplete="off">
        @if($errors->has('name'))
        <p style="color:red;">{{ $errors->first('name') }}</p>
        @endif
    </div>
    <div class="form-group" style="margin-bottom : 10px">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Input your email" value="{{old('email')}}" autocomplete="off">
        @if($errors->has('email'))
        <p style="color:red;">{{ $errors->first('email') }}</p>
        @endif
    </div>
    <div class="form-group" style="margin-bottom : 10px">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Input your password" value="{{old('password')}}" autocomplete="off">
        @if($errors->has('password'))
        <p style="color:red;">{{ $errors->first('password') }}</p>
        @endif
    </div>
    <div class="form-group" style="margin-bottom : 10px">
        <label for="country">Select your country</label>
        <select class="form-control" name="country_id" id="country">
          @foreach($countries as $country)
          <option value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
        </select>
        @if($errors->has('country_id'))
        <p style="color:red;">{{ $errors->first('country_id') }}</p>
        @endif
    </div>
    <div class="form-group" style="margin-bottom : 10px">
        <label for="file">Avatar</label>
        <input type="file" class="form-control" name="avatar"/>
        @if($errors->has('avatar'))
        <p style="color:red;">{{ $errors->first('avatar') }}</p>
        @endif
    </div>
    <button type="submit" class="btn btn-primary" id="save" >Submit</button>
</form>
@endsection