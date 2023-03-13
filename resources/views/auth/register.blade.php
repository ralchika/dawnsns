@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

<br>
<p>UserName</p>
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

<br>
<p>MailAdress</p>
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

<br>
<p>Password</p>
{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}

<br>
<p>Password confirm</p>
{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}
<br>
{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

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
