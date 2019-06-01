@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card my-3">
                <div class="card-body">
                    <h5 class="card-title"><h3>{{$post->title}}</h3></h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$post->created_at}}</h6>
                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>--}}
                    <a href="/posts/{{$post->id}}"  class="card-link">View post</a>
                    {{-- <a href="#" class="card-link">Another link</a>--}}
                </div>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection