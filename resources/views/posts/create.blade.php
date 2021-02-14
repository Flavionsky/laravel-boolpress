@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Crea nuovo Post</h1>
    </div>
    <div class="col-12">
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="form-group">
            <label>{{__('Titolo')}}</label>
            <input class="form-control  @error('title') is-invalid @enderror" name="title" placeholder="Inserisci un Titolo" type="text" value="{{old('title')}}" >
            @error('title')

            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                
            @enderror
        </div>

        <div class="form-group">
            <label>{{__('Backdate')}}</label>
            <input class="form-control  @error('backdate') is-invalid @enderror" name="backdate" placeholder="Inserisci una data" type="date">
            @error('backdate')

            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                
            @enderror
        </div>
        
        <div class="form-group">
            <label>{{__('Immagine')}}</label>
            <input class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Inserisci un Immagine" type="file">
            @error('image')

            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                
            @enderror
        </div>

        <div class="form-group">
            <label>{{__('Categoria')}}</label>
            <input class="form-control @error('category') is-invalid @enderror" name="category" placeholder="Inserisci una Categoria" type="text">
            @error('category')

            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                
            @enderror
        </div>
        
        <h3>Post Information Data</h3>
        
        <div class="form-group">
            <label>Descrizione</label>
            <textarea name="description" class="form-control" type="text" placeholder="Inserisci una descrizione"></textarea>
        </div>
        
        <div class="form-group">
            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>

                <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags') }}" required autocomplete="tags" autofocus>

                @error('tags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Crea"/>
        </div>
        </form>
    </div>
</div>
@endsection