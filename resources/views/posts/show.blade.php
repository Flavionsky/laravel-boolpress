@extends('layouts.app')

@section('content')
<h1>{{$post->title}}</h1>
<ul>
    <li><h4>Category:</h4> {{ $post->category->title }}</li>
    <li><h4>Description:</h4> {{ $post->postInfo->description }}</li>
</ul>
<h1>Post Tags</h1>
<ul>
    @foreach($post->tags as $tag)
    <li>
        {{ $tag->name }}
    </li>
@endforeach
</ul>
@endsection