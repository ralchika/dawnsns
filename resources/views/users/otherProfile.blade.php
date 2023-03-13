@extends('layouts.login')

@section('content')
<img src="{{ asset('images/' . $user->images) }}">
<div class="name">
  <h2 class="user-name">Name</h2>
  <p>{{$user->username}}</p>
  <h2 class="bio">Bio</h2>
  <p>{{$user->bio}}</p>
</div>

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


@forelse($posts as $post)
<img src="{{ asset('images/' . $user->images) }}">
{{$post->username}}
{{$post->posts}}
{{$post->created_at}}
<br>
@empty
<p>まだ何も呟いてません</p>
@endforelse

@endsection
