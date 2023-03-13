@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
{!! Form::open(['url' => 'post/create']) !!}
      {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
  <button type="submit" class="btn btn-success pull-right"><img src="images/post.png"></button>
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
<table class='table table-hover'>
  <tr>
    <th>投稿No</th>
    <th>投稿内容</th>
    <th>投稿日時</th>
  </tr>
  @foreach ($posts as $post)
    <tr>
      <td>
        <img style="width:50px;" src="storage/images/{{$post->images}}">
      </td>
      <td>{{ $post->username }}</td>
      <td>{{ $post->posts }}</td>
      <td>{{ $post->created_at }}</td>
      @if($post->user_id == Auth::id())
        <td>
          <div class="edit-btn" data-target="modal{{$post->id}}">
            <img src="images/edit.png">
          </div>
          <div class="post-edit" id="modal{{$post->id}}">
            <div class="edit-inner">
              <div class="edit-form">
                {!! Form::open(['url' => 'post/update']) !!}
                      {{Form::textarea('upPost', $post->posts, ['class' => 'form-control', 'rows' => '3'])}}
                      {!! Form::hidden('id', $post->id) !!}
                    <br>
                    <div class="edit-upload">
                      <button type="submit" class="btn btn-success pull-right"><img src="images/edit.png"></button>
                    </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </td>
        <td><a class="btn btn-danger" href="/post/{{ $post->id }}/delete"><img src="images/trash.png"></a></td>
      @endif
    </tr>
  @endforeach



</table>

@endsection
