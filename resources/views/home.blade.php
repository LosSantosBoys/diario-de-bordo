@extends('layouts.app')

@section('content')
<main class="container col-8">
    @if(isset($posts))
        @foreach ($posts as $post)
        <div class="row mb-5">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex">
                <div class="d-none d-sm-block">
                    <img src="" width="200" height="200" alt="" />
                </div>
                <div class="post-card">
                    <div class="post-title">
                        <h3>{{ new \Moment\Moment($post->dataDePublicacao).format() }} - {{ $post->titulo }}</h3>
                    </div>
                    <div class="post-content">
                        {{ $post->conteudo }}
                    </div>
                    <div class="post-more">
                        <a
                            class="text-decoration-none text-lg text-lg-hover"
                            href="./pages/post.html">
                                Leia mais
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</main>
@endsection
