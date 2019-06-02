@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/storage/cover_images/{{$post->cover_image}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-8">
                            <h3 class="card-title">{{$post->title}}</h3>
                            <h6 class="card-subtitle mb-2 text-muted">Written on {{$post->created_at}} by {{$post->user->name}}</h6>
                            <a href="/posts/{{$post->id}}"  class="card-link">View post</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection