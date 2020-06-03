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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif (session('failure'))
                    <div class="alert alert-danger">
                        {{ session('failure') }}
                    </div>
                @endif
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
                                <td>{{$photo['name']}}</td>
                                <td><a href="{{route('admin.photos.show', $photo->id)}}" class="btn btn-info text-white">visualizza</a></td>
                                <td>
                                    @if (Auth::id() == $photo['user_id'])
                                        <a href="{{route('admin.photos.edit', $photo->id)}}" class="btn btn-primary">modifica</a>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::id() == $photo['user_id'])
                                        <form action="{{route('admin.photos.destroy', $photo->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" name="elimina" value="elimina">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
