@extends('layouts.master')
@section('title', 'List Country')
@section('content')
<h1>List Country </h1>
<div class=".container-md" style="margin: 50px 0 0 0 ; width: 800px;">
  <table class="table table-success table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">People in the country(over 50yrs)</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($countries as $country)
      <tr>
        <th scope="row">{{ $country->id }}</th>
        <td>{{ $country->name }}</td>
        <td>
            @foreach ($country->users as $user )
                <span>{{ $user->name.',' }}</span>
            @endforeach
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection