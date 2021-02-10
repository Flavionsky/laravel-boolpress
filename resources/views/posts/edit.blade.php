@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1>Edit Post: {{ $post->title }}</h1>
        </div>
        <div class="col-12">
            <form action="{{ route('posts.update', $post) }}" method="post">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label>Titolo</label>
                    <input value="{{ $post->title }}" class="form-control" name="title" placeholder="Inserisci un Titolo"
                        type="text">
                </div>

                <div class="form-group">
                    <label>Categoria</label>
                    <select name="category_id" class="form-control">
                        <option> - - - - </option>

                        @foreach ($categories as $category)

                            <option {{ $post->category->id == $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}">
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <h3>Post Information Data</h3>

                <div class="form-group">
                    <label>Descrizione</label>
                    <textarea name="description" class="form-control" type="text"
                        placeholder="Inserisci una descrizione">{{ $post->postInfo->description }}</textarea>
                </div>
                <h3>Post Tags</h3>
                <ul>
                    @foreach ($tags as $tag)

                    <li><input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $post->tags->contains($tag) ? 'checked' : '' }}
                    >
                    {{ $tag->name }}</li>
                    @endforeach
                </ul>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Aggiorna" />
                </div>
            </form>
        </div>
    </div>
@endsection
