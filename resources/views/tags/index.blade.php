@extends('layouts.app')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>           
            <th scope="col">Posts</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($tags as $tag)              
        <tr>
            <td>{{ $tag->id }}</td>
            <td>{{ $tag->name }}</td>
            <td>
                <form action="{{route('tags.show', $tag->id)}}">
                    <input class="btn btn-success"   type="submit" value="Maggiori dettagli" />
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection