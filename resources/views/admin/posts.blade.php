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
                    <button class="btn btn-primary px-3 waves-effect waves-light" onclick="navegar('{{ $post->slug }}')" type="button">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="btn btn-danger px-3 waves-effect waves-light" onclick="deletar('{{ $post->slug }}')" type="button">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>

<script>
    function navegar(slug) {
        window.location.href = '/admin/posts/' + slug
    }

    function deletar(slug) {
        fetch('/api/v1/posts/' + slug, { method: 'DELETE' },).then(() => location.reload())
    }
</script>

@endsection
