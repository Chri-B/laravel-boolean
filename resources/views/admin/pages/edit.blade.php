@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.pages.index')}}">Pages</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>{{$page['title']}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="{{route('admin.pages.update', $page->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Lorem ipsum" name="title" value="{{old('title') ?? $page['title']}}">
                        @error('title')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <input type="text" class="form-control" id="summary" name="summary" placeholder="Lorem ipsum dolor sit amet" value="{{old('summary') ?? $page['summary']}}">
                        @error('summary')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="custom-select">
                            <option selected>Open this select menu</option>
                            @foreach ($categories as $category)
                                {{-- confronto ad ogni giro se l'id della categoria ciclata corrisponde con il category_id della pagina da editare: se corrisponde, lo riporto come valore selezionato --}}
                                <option value="{{$category['id']}}" {{(!empty(old('category_id'))) && (old('category_id') == $category['id']) ? 'selected' : ''}}>{{$category['name']}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control" rows="12">{{old('body') ?? $page['body']}}</textarea>
                        @error('body')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tags">Tags</label>
                        <div class="form-group">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    @if ((is_array(old('tags')) && in_array($tag->id, old('tags'))) || $page->tags->contains($tag->id))
                                        <input type="checkbox" class="form-check-input" name="tags[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}" checked>
                                    @else
                                        <input type="checkbox" class="form-check-input" name="tags[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}">
                                    @endif
                                    <label class="form-check-label" for="tag{{$tag['id']}}">{{$tag['name']}}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('tags')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tags">Photos</label>
                        <div class="form-group">
                            @foreach ($photos as $photo)
                                <div class="form-check form-check-inline">
                                    {{-- name="photo[]" è l'array di destinazione (in cui salvo la selezione utente), il value indica il valore da pushare, l'id è per la corrispondenza al for del LABEL, nel LABEL stampo anche il nome per visualizzazione utente assieme a path in IMG --}}
                                    @if ((is_array(old('photos')) && in_array($photo->id, old('photos'))) || $page->photos->contains($photo->id))
                                        <input type="checkbox" class="form-check-input" name="photos[]" id="photo{{$photo['id']}}" value="{{$photo['id']}}" checked>
                                    @else
                                        <input type="checkbox" class="form-check-input" name="photos[]" id="photo{{$photo['id']}}" value="{{$photo['id']}}">
                                    @endif
                                    <label class="form-check-label" for="photo{{$photo['id']}}">{{$photo['title']}}</label>
                                    <img src="{{$photo['path']}}" alt="">
                                </div>
                            @endforeach
                        </div>
                        @error('photos')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Salva">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
