@php
    $photos = [
      [
        'id' => 1,
        'title' => 'Titolo foto 1',
      ],
      [
        'id' => 2,
        'title' => 'Titolo foto 2',
      ],
      [
        'id' => 3,
        'title' => 'Titolo foto 3',
      ],
      [
        'id' => 4,
        'title' => 'Titolo foto 4',
      ],
    ];
@endphp

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.photos.index')}}">Photos</a></li>
                    {{-- <li class="breadcrumb-item active">Data</li> --}}
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h1>Photos</h1>
            </div>
            <div class="col-6">
                <h2 class="float-right"><a href="{{route('admin.photos.create')}}">Crea una foto</a></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th colspan="3">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($photos as $key => $photo)
                            <tr>
                                <td>{{$photo['id']}}</td>
                                <td>{{$photo['title']}}</td>
                                <td><a href="#" class="btn btn-info text-white">visualizza</a></td>
                                <td><a href="#" class="btn btn-primary">modifica</a></td>
                                <td>
                                    <form>
                                        <input class="btn btn-danger" type="submit" name="elimina" value="elimina">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
