@extends('layouts.master')
@section('title', 'List User')
@section('content')
<h1>List users </h1>
@include('partials.create-user-button', ['text' => 'Add User'])
<div class=".container-md" style="margin: 50px 0 0 0 ; width: 800px;">
  <table class="table table-success table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Avatar</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Tel</th>
        <th scope="col">Age</th>
        <th scope="col">Gender</th>
        <th scope="col">Country</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td><img src="{{ asset($user->avatar) }}" width="50px"/></td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->profile ? $user->profile->address : '' }}</td>
        <td>{{ $user->profile ? $user->profile->tel : '' }}</td>
        <td>{{ $user->profile ? $user->profile->age : '' }}</td>
        <td>{{ $user->profile ? $user->profile->gender == 1 ? 'male':'female' : '' }}</td>
        <td>{{ $user->country ? $user->country->name : '' }}</td>
        <td>
          <a class="btn btn-primary" style="width : 80px" href="{{ route('users.edit', $user->id) }}">Edit</a>
          <form action="{{ route('users.delete', $user->id) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" style="width : 80px" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection