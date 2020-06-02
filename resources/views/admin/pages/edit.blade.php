@php
    $categories = [
        [
            'id' => 1,
            'name' => 'miscellanea',
            'description' => 'Lorem sit'
        ],
        [
            'id' => 2,
            'name' => 'category-2',
            'description' => 'dolor lorem'
        ],
        [
            'id' => 3,
            'name' => 'category-3',
            'description' => 'ipsum amet'
        ],
    ];
    $tags = [
        [
            'id' => 1,
            'name' => 'tag-1',
            'description' => 'esempio tag-1'
        ],
        [
            'id' => 2,
            'name' => 'tag-2',
            'description' => 'esempio tag-2'
        ],
        [
            'id' => 3,
            'name' => 'tag-3',
            'description' => 'esempio tag-3'
        ],
        [
            'id' => 4,
            'name' => 'tag-4',
            'description' => 'esempio tag-4'
        ],
        [
            'id' => 5,
            'name' => 'tag-5',
            'description' => 'esempio tag-5'
        ]
    ];
    $photos = [
        [
            'id' => 1,
            'title' => 'Lorem',
            'path' => 'images/lorem.jpg'
        ],
        [
            'id' => 2,
            'title' => 'Ipsum',
            'path' => 'images/ipsum.jpg'
        ],
        [
            'id' => 3,
            'title' => 'Dolor',
            'path' => 'images/dolor.jpg'
        ],
    ];
    $page = [
        'id' => 1,
        'title' => 'lorem Ipsum',
        'summary' => 'Lorem ipsum dolor sit',
        'body' => 'Questo è un testo',
        'category_id' => 3,
        'tags' => [
          1 ,
          3 ,
          5
        ],
        'photos' => [
          3, 2
        ]
    ];
    // prova per eventuali oldtags
    $oldtags = [
        1,
        2,
        3
    ];
    // $oldtags = null;
    $oldphotos = [
        1
    ];
    // $oldphotos = null;
@endphp

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
                <form action="" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Lorem ipsum" value="{{$page['title']}}">
                        @error('title')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <input type="text" class="form-control" id="summary" placeholder="Lorem ipsum dolor sit amet" value="{{$page['summary']}}">
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
                                <option value="{{$category['id']}}" {{$page['category_id'] == $category['id'] ? 'selected' : ''}}>{{$category['name']}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control" rows="12">{{$page['body']}}</textarea>
                        @error('body')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tags">Tags</label>
                        <div class="form-group">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    @if (is_array($oldtags))
                                        <input type="checkbox" class="form-check-input" name="tag[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}" {{in_array($tag['id'], $oldtags) ? 'checked' : ''}}>
                                    @else
                                        <input type="checkbox" class="form-check-input" name="tag[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}">
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
                                    @if (is_array($oldphotos))
                                        <input type="checkbox" class="form-check-input" name="photo[]" id="photo{{$photo['id']}}" value="{{$photo['id']}}"  {{in_array($photo['id'], $oldphotos) ? 'checked' : ''}}>
                                    @else
                                        <input type="checkbox" class="form-check-input" name="photo[]" id="photo{{$photo['id']}}" value="{{$photo['id']}}">
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
