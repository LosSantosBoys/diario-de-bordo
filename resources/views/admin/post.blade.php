@extends('layouts.app')

@section('content')
<main class="container">
    <div class="row">
        <div class="col-12 title">
            @if(is_null($post->id))
                Criar post
            @else
                Editar post
            @endif
        </div>
    </div>

    <form method="POST" action="/api/v1/posts/{{ $post->slug }}">
        @csrf

        @if(!is_null($post->id))
            @method('PUT')
        @endif

        <div class="form-group mt-3">
            <label for="post-title">Título</label>
            <input
                class="form-control mt-2"
                id="post-title"
                placeholder="Título"
                name="titulo"
                value="{{ $post->titulo }}"
                required
            />
        </div>
        <div class="form-group row mt-3">
            <div class="form-group col-md-8">
                <label for="post-category">Categoria</label>
                <select id="post-category" class="form-control mt-2">
                    <option selected>Escolha...</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option>{{ $category->titulo }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Tem de ser a partir de hoje agora -->
            <div class="form-group col-md-4">
                <label for="post-data">Data da publicação</label>
                <input
                    type="date"
                    class="form-control mt-2"
                    id="post-data"
                    min="31-10-2022"
                    name="dataDePublicacao"
                    value="{{ \Carbon\Carbon::parse($post->dataDePublicacao)->format('d-m-Y') }}"
                    required
                />
            </div>
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" value="true" id="checkbox" name="visivel" checked>
            <label class="form-check-label" for="checkbox">
                Visível para todos
            </label>
        </div>
        <!-- Trocar por editor de texto rico -->
        <div class="form-group mt-3">
            <label for="post-content">Conteúdo</label>
            <textarea
                class="form-control mt-2"
                id="post-content"
                name="conteudo"
                required
            >
{!! $post->conteudo !!}
        </textarea>
        </div>
        <button type="submit" class="btn btn-dark mt-3 btn-lg">
            @if(is_null($post->id))
                Criar post
            @else
                Editar post
            @endif
        </button>
    </form>
</main>

<script>
    $('#post-content').summernote({
        height: 400
    });
</script>

@endsection

