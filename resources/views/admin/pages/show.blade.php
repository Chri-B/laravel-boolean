@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.pages.index')}}">Pages</a></li>
                    <li class="breadcrumb-item active">Show</li>
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <h2>ID: {{$page['id']}}</h2>
                <h1>{{$page['title']}}</h1>
                <h3>{{$page['category_id']}}</h3>
                @foreach ($page['photos'] as $photo)
                    <div>
                        {{-- @dd($page) --}}
                        {{-- <img src="{{asset('storage/'  . $photo->path)}}" alt="photo"> --}}
                        <img src="{{$photo->path}}" alt="photo">
                    </div>
                @endforeach
                <h4>{{$page['summary']}}</h4>
                <p>{{$page['body']}}</p>
                @foreach ($page['tags'] as $tag)
                    <small>{{$tag->name}}</small>
                @endforeach
            </div>
        </div>
    </div>
@endsection
