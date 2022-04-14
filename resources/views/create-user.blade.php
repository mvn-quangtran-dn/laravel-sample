@extends('layouts.master')
@section('title', 'Create User Page')
@section('content')
<h1>Create users</h1>
<form action="{{ route('users.store') }}" method="post" style="width: 600px">
    @csrf
    <div class="form-group">
      <label for="name">UserName</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Input your name">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Input your email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Input your password">
    </div>
    <div class="form-group">
      <label for="country">Select your country</label>
      <select class="form-control" name="country_id" id="country">
        @foreach($countries as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
      </select>
    </div>
    <button class="btn btn-primary" style="margin-top: 10px;">Create user</button>
  </form>
@endsection