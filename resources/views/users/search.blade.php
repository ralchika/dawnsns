@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'users/search']) !!}
    {!! Form::input('text', 'search', null, ['class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
  <button type="submit" class="btn btn-success pull-right">検索</button>
{!! Form::close() !!}

@if(!empty($keyword))
検索ワード{{$keyword}}
@endif

<br>

@foreach ($users as $user)
  <br>
   {{ $user->username }}

@if($followings->contains('follow',$user->id))
 {!! Form::open(['url' => 'search/dele-follow']) !!}
{!! Form::hidden('follower_id', $user->id) !!}
  <button type="submit" class="btn btn-success pull-right">フォローをはずす</button>
{!! Form::close() !!}
@else
{!! Form::open(['url' => 'search/add-follow']) !!}
  {!! Form::hidden('follow_id', $user->id) !!}
  <button type="submit" class="btn btn-success pull-right">フォローする</button>
{!! Form::close() !!}

@endif





@endforeach

@endsection
