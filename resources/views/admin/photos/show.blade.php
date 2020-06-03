@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.photos.index')}}">photos</a></li>
                    <li class="breadcrumb-item active">Show</li>
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('failure'))
                    <div class="alert alert-danger">
                        {{ session('failure') }}
                    </div>
                @endif
                <h2>ID: {{$photo['id']}}</h2>
                <h1>{{$photo['name']}}</h1>
                <p>{{$photo['description']}}</p>
            </div>
            <div class="col-4">
                {{-- @dd($photo->path) --}}
                <img src="{{asset('storage' . $photo->path)}}" alt="{{$photo['name']}}">
            </div>
        </div>
    </div>
@endsection
