@extends('layouts.login')

@section('content')
<p>Follow list</p>

@foreach ($users as $user)
  <td><img src="{{ asset('images/' . $user->images) }}"></td>
@endforeach
  <br>
  <br>
@foreach ($users as $user)
  <a href="/otherProfile/{{$user->id}}"><img src="{{ asset('images/' . $user->images) }}"></a >
  {{ $user->username }}
  {!! Form::hidden('id', $user->id) !!}
  <br>

@endforeach

@endsection
