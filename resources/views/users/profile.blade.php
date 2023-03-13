@extends('layouts.login')

@section('content')

<img src="storage/images/{{Auth::user()->images}}">


<p>UserName</p>
{!! Form::open(['url' => 'user/update','files' => true]) !!}
      {!! Form::text('username', Auth::user()->username, ['required', 'class' => 'form-control']) !!}
  <p>MailAdress</p>
      {!! Form::text('mail',Auth::user()->mail, ['required', 'class' => 'form-control']) !!}
  <p>Password</p>
      {!! Form::text('password', Auth::user()->password, ['required', 'class' => 'form-control','readonly']) !!}
  <p>new Password</p>
      {!! Form::password('newPassword',['class' => 'form-control']) !!}
  <p>Bio</p>
      {!! Form::input('text', 'bio', Auth::user()->bio, [ 'class' => 'form-control']) !!}
  <p>Icon Image</p>
      {!! Form::file('image',['class' => 'form-control']) !!}

<br>

  <button type="submit" class="btn btn-success pull-right">更新</button>

{!! Form::close() !!}

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

@endsection
