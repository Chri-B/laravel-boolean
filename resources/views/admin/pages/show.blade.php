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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('failure'))
                    <div class="alert alert-danger">
                        {{ session('failure') }}
                    </div>
                @endif
                <h2>ID: {{$page['id']}}</h2>
                <h1>{{$page['title']}}</h1>
                <h3>{{$page->category->name}}</h3>
                <h4>{{$page['summary']}}</h4>
                @foreach ($page['photos'] as $photo)
                    <div class="text-center">
                        {{-- @dd($page) --}}
                        {{-- <img src="{{asset('storage/'  . $photo->path)}}" alt="photo"> --}}
                        <a href="{{route('admin.photos.show', $page->id)}}"><img class="img-thumbnail" src="{{asset('storage/'. $photo->path)}}" alt="{{$photo->name}}"></a> 
                    </div>
                @endforeach
                <p>{{$page['body']}}</p>
                @foreach ($page['tags'] as $tag)
                    <small>{{$tag->name}}</small>
                @endforeach
            </div>
        </div>
    </div>
@endsection
