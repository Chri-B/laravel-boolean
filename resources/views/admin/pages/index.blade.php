@php
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
                <h2 class="float-right"><a href="#">Crea una pagina</a></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
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
                            <td>{{$page['category']}}</td>
                            <td>
                                @foreach ($page['tags'] as $key => $tag)
                                    @if(!$loop->last)
                                        {{$tag}},
                                    @else
                                        {{$tag}}
                                    @endif
                                @endforeach
                            </td>
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
