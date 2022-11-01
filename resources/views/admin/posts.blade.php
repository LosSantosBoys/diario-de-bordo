@extends('layouts.app')
    
@section('content')
<main class="container">
    <div class="row">
        <div class="col-12 title">Lista de posts ({{ count($posts) }})</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Slug</th>
                <th scope="col">Título</th>
                <th scope="col">Categoria</th>
                <th scope="col">Data publicada</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->titulo }}</td>
                <td>{{ $post->categoriaId }}</td>
                <td>{{ $post->dataDePublicacao }}</td>
                <td>
                    <a href="/admin/posts/{{ $post->slug }}">
                        <i class="mx-2 fa-solid fa-pen-to-square"></i>
                    </a>
                    <i class="fa-solid fa-trash"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
