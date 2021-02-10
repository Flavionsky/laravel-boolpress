@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Crea nuovo Post</h1>
    </div>
    <div class="col-12">
        <form action="{{ route('posts.store') }}" method="post">
        @csrf
        @method('post')

        <div class="form-group">
            <label>Titolo</label>
            <input class="form-control" name="title" placeholder="Inserisci un Titolo" type="text">
        </div>
        <div class="form-group">
            <label>Autore</label>
            <input class="form-control" name="author" placeholder="Inserisci un autore" type="text">
        </div>
        
        <div class="form-group">
            <label>Categoria</label>
            <select name="category_id" class="form-control">
                <option selected> - - - - </option>
        
                @foreach ($categories as $category)
        
                    <option value="{{ $category->id }}">
                        {{$category->title}}
                    </option>     
                @endforeach
            </select>
        </div>
        
        <h3>Post Information Data</h3>
        
        <div class="form-group">
            <label>Descrizione</label>
            <textarea name="description" class="form-control" type="text" placeholder="Inserisci una descrizione"></textarea>
        </div>
        
        <h3>Post Tags</h3>
        
        <ul>
                @foreach($tags as $tag)
                <li><input type="checkbox" name="tags[]" value="{{$tag->id}}">{{ $tag->name }}</li>
                @endforeach
        </ul>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Crea"/>
        </div>
        </form>
    </div>
</div>
@endsection