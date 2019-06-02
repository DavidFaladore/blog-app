@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-primary mb-3">Go back</a>
    <h1>{{$post->title}}</h1>
    <img src="/storage/cover_images/{{$post->cover_image}}" class="img-fluid" alt="">
    <div class="mt-3">
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    
    @if (!Auth::guest())
        @if (Auth::user()->id == $post->user_id)
            <hr>
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary mb-3">Edit</a>
            
            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endif
@endsection