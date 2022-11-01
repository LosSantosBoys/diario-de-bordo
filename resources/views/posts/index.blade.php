@extends('layouts.app')

@section('content')
<main class="container col-8">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 d-flex">
        <div>
            <div class="post-title">
            <h3><span name="data-publicacao">{{ $post->dataDePublicacao }}</span> - {{ $post->titulo }}</h3>
            </div>
            <div class="post-conteudo">
{!! $post->conteudo !!}
            </div>
            <div class="post-more">
                <a
                    class="text-decoration-none text-lg text-lg-hover"
                    href="/"
                    >Voltar</a
                >
            </div>
        </div>
    </div>
</main>
@endsection