@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('admin.pages.index')}}">Pages</a></li>
                    {{-- <li class="breadcrumb-item active">Data</li> --}}
                  </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <h1>Pages</h1>
            </div>
            <div class="col-6">
                <h2 class="float-right"><a href="{{route('admin.pages.create')}}">Crea una pagina</a></h2>
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
                {{$pages->links()}}
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Tags</th>
                      <th colspan="3">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($pages as $key => $page)
                            <tr>
                                <td>{{$page['id']}}</td>
                                <td>{{$page['title']}}</td>
                                <td>{{$page['category']->name}}</td>
                                <td>
                                    @foreach ($page['tags'] as $key => $tag)
                                        @if(!$loop->last)
                                            {{$tag->name}},
                                        @else
                                            {{$tag->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('admin.pages.show', $page['id'])}}" class="btn btn-info text-white">visualizza</a>
                                </td>
                                <td>
                                    @if (Auth::id() == $page['user_id'])
                                        <a href="{{route('admin.pages.edit', $page['id'])}}" class="btn btn-primary">modifica</a>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::id() == $page['user_id'])
                                        <form action="{{route('admin.pages.destroy', $page['id'])}}" method="post">
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
                {{$pages->links()}}
            </div>
        </div>
    </div>
@endsection
