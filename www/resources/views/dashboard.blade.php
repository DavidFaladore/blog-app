@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary mb-3">Create new post</a>
                    <h3>Your blog posts</h3>
                    @if (count($posts) > 0)
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                               <tr>
                                <td scope="row">{{$post->title}}</td>
                                <td>
                                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm'])}}
                                    {!! Form::close() !!}
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                    @else
                     <p>You have no posts</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
