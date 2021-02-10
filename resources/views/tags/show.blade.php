@extends('layouts.app')

@section('content')
<h1>{{$tag->name}}</h1>
<ul>
    @foreach($tag->posts as $post)
    <li>
        {{$post->title}}
    </li>
    @endforeach
</ul>
@endsection