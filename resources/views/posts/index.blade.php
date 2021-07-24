@extends('layouts.layouts')

@section('title', 'Simple Board')

@section('content')

    @if (session('message'))
        {{ session('message') }}
    @endif
<h1>Posts</h1>
@foreach($posts as $post) 
<p class="card-text"><a href="./posts/{{ $post->id }}">{{ $post->title }}</a></p>
<p class="card-text"><a href="./posts/{{ $post->id }}">{{ $post->content }}</a></p>
<p class="card-text"><img class="" src="{{ asset('public/storage') }}/{{ $post->id }}/{{ $post->image }}"></p>
 <a href="./posts/{{ $post->id }}/edit">Edit</a>
 <form action="/simpleboard/posts/{{ $post->id }}" method="POST" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };"> 
    <input type="hidden" name="_method" value="DELETE"> 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">           
    <button type="submit">Delete</button> 
 </form> 
@endforeach
<a href="/simpleboard/posts/create">New Post</a>
@endsection