@extends('layouts.app')

@section('content')
<h3>Page Sitemap:</h3>
<ul>
    <li>
        <a href="/" target="_blank">
            <strong>Home</strong>
        </a>
    </li>   
    <li>
        <a href="/about" target="_blank">
            <strong>About</strong>
        </a>
    </li>
    <li>
        <a href="/blog" target="_blank">
            <strong>Blog</strong>
        </a>
    </li>
    <ul>
        <li>
            <a href="javascript: void(0)">View post (/posts/{id})</a>
        </li>
    </ul>
    <li>
        <a href="/sitemap" target="_blank">
            <strong>Sitemap</strong>
        </a>
    </li>
    
    <li>
        <a href="/dashboard" target="_blank">
            <strong>Dashboard (View created posts)</strong>
        </a>
    </li>
    <ul>
        <li>
            <a href="/posts/create" target="_blank">Create post (/posts/create)</a>
        </li>
        <li>
            <a href="javascript: void(0)">Edit post (/posts/{id}/edit)</a>
        </li>
         <li>
            <a href="javascript: void(0)">Delete post (/posts/{id}/delete)</a>
        </li>
    </ul>
    <li>
        <a href="/login" target="_blank">
            <strong>Login</strong>
        </a>
    </li>
     <li>
        <a href="/register" target="_blank">
            <strong>Register</strong>
        </a>
    </li>
</ul>   
@endsection