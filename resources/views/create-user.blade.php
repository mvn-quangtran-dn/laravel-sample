@extends('layouts.master')
@section('title', 'Create User Page')
@section('content')
@can('create-user')
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
    <button class="btn btn-primary" style="margin-top: 10px;" id="save">Create user</button>
  </form>
  <div id="show-user"></div>
@endsection
@section('javascript')
<script type="text/javascript">

    $(document).ready(function(){
        var storeUserRoute = "{{ route('api.user.store') }}";
        var deleteUserRoute = "/api/v1/users/";
        $('#save').on('click', function(e){
            e.preventDefault();
            $.ajax({
            url : storeUserRoute,
            type : 'POST',
            data : {
                'name' : $("input[name='name']").val(),
                'email' : $("input[name='email']").val(),
                'password' : $("input[name='password']").val(),
                'country_id' : $("select[name='country_id']").val(),
            },
            success : function(response){
                console.log(response);
                // html = '';
                // $.each(response, function (index, value){
                //     console.log(value);
                    html = '<table> '+
                                ' <thead>'
                                    + '<td>UserID</td> '
                                    + '<td>UserName</td> '
                                    + '<td>Action</td> '
                                +' <thead>'
                                +'<tbody>'
                                    +'<tr>'
                                        +'<td>'+response.id+'</td> '
                                        +'<td>'+response.name+'</td> '
                                        +'<td><button class="btn btn-danger delete" id='+response.id+'>Delete</button></td> '
                                    +'</tr>'
                                +'</tbody>'
                            +'</table>'


                // })
                $('#show-user').append(html);
            },
            error: function(errorResponse) {
                console.log(errorResponse);
            }
        });
        });
        $(document).on('click','.delete', function(e){
            e.preventDefault();
            console.log($(this).attr('id'));
            $.ajax({
                url : deleteUserRoute+$(this).attr('id'), // /api/users/1
                type : 'DELETE',
                data : {
                },
                success : function(response){
                    console.log(response);
                },
                error: function(errorResponse) {
                    console.log(errorResponse);
                }
            })
        })

    });
</script>
@endsection