<h1>Show user detail</h1>
<p>User ID : {!! $user['id'] !!}</p>
<p>User ID : {!! $user->id !!}</p>
<p>User Name 1 : {!! $user['name'] !!}</p>
<p>User Name 2 : {{ $user['name'] }}</p>
<p>User Age : {{ $user['age'] }}</p>
<p>User Avatar : <img src="{{ asset($user->avatar) }}"/></p>
