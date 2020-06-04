@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.photos.index')}}">photos</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('failure'))
                    <div class="alert alert-warning">
                        {{ session('failure') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Inserisci una nuova foto</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="{{route('admin.photos.update', $photo->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Lorem ipsum" value="{{old('name') ?? $photo['name']}}">
                        @error('name')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="12">{{old('description') ?? $photo['description']}}</textarea>
                        @error('description')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="path" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        @error('path')
                            <small class="alert alert-danger form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Salva">
                    </div>
                </form>
            </div>
            <div class="col-6">
                <img class="img-thumbnail" src="{{asset('storage/' . $photo->path)}}" alt="{{$photo->name}}">
                <small class="float-right font-italic">Old foto</small>
            </div>
        </div>
    </div>
@endsection
