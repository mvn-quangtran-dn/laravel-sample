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
        <th scope="col">Name</th>
        <th scope="col">Email</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection