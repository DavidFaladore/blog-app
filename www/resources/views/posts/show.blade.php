@extends('layouts.app')

@section('content')
 @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
            
            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
            <hr>
        @endif
    @endif
    <h1>{{$post->title}}</h1>
    <img src="/storage/cover_images/{{$cover_image->path}}" class="img-fluid" alt="">
    <div class="mt-3">
        {!!$post->body!!}
    </div>
    <hr>
    <div>
        <a href="/posts" class="btn btn-primary mb-3">Go back</a>
        <span class="float-right"><small>Written on {{$post->created_at}} by {{$post->user->name}}</small></span>
    </div>
@endsection