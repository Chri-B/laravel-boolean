{{-- @php
    $pages = [
        [
            "id" => 1,
            "title" => 'lorem Ipsum',
            "category" => 1,
            "tags" => [
                1,
                3,
                4
            ]
        ],
        [
            "id" => 2,
            "title" => 'Dolor Sit',
            "category" => 2,
            "tags" => [
                5,
                3,
                4
            ]
        ],
        [
            "id" => 3,
            "title" => 'mollit anim id est laborum.',
            "category" => 2,
            "tags" => [
                1,
                2
            ]
        ]
    ];
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
@endphp --}}

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.pages.index')}}">Pages</a></li>
                    <li class="breadcrumb-item active">Create</li>
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Inserisci una nuova pagina</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="{{route('admin.pages.store')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Lorem ipsum" value="{{old('title')}}">
                        @error('title')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summary">Summary</label>
                        <input type="text" class="form-control" id="summary" name="summary" placeholder="Lorem ipsum dolor sit amet" value="{{old('summary')}}">
                        @error('summary')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category_id" class="custom-select">
                            <option selected>Open this select menu</option>
                            @foreach ($categories as $category)
                                {{-- @dd(old('category_id')) --}}
                                <option value="{{$category['id']}}" {{(!empty(old('category_id'))) && (old('category_id') == $category['id']) ? 'selected' : ''}}>{{$category['name']}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control" rows="12">{{old('body')}}</textarea>
                        @error('body')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tags">Tags</label>
                        <div class="form-group">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tags[]" id="tag{{$tag['id']}}" value="{{$tag['id']}}" {{(is_array(old('tag')) && in_array($tag->id, old('tag'))) ? 'checked' : ''}}>
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
                                    <input type="checkbox" class="form-check-input" name="photos[]" id="photo{{$photo['id']}}" value="{{$photo['id']}}" {{(is_array(old('photo')) && in_array($photo->id, old('photo'))) ? 'checked' : ''}}>
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
