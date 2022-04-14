@extends('layouts.master')
@section('title', 'Create User')
@section('content')

<h1>Create user</h1>
@include('partials.login-button', ['text' => 'Login'])
<form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" style="width: 600px">
    @csrf
    <div class="form-group">
        <label for="name">UserName</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Input your name" value="{{old('name')}}">
        @if($errors->has('name'))
        <p style="color:red;">{{ $errors->first('name') }}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Input your email" value="{{old('email')}}">
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
          <option value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
        </select>
        @if($errors->has('country_id'))
        <p style="color:red;">{{ $errors->first('country_id') }}</p>
        @endif
    </div>
    <div class="form-group">
        <lable>Avatar</lable>
        <input type="file" name="avatar"/>
    </div>
    <button type="submit" id="save" >Submit</button>
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