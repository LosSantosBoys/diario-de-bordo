@extends('layouts.app')

@section('content')
<main class="container col-8">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex">
            <div class="d-none d-sm-block">
                <img class="post-img" src="" alt="" />
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 d-flex">
            <div class="post-card">
                <div class="post-title">
                <h3><span name="data-publicacao">{{ $post->dataDePublicacao }}</span> - {{ $post->titulo }}</h3>
                </div>
                <div class="post-content">
                    {{ $post->conteudo }}
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
    </div>
</main>
@endsection