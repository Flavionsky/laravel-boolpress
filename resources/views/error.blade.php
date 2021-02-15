@extends('layouts.app')

@section('content')
<h1>Errore</h1>

<h4>{{$errormessage}}</h4>

<a href="{{route('posts.index')}}">Torna all'indice</a>
@endsection