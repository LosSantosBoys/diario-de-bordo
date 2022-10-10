<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

require_once __DIR__ . '/../../helpers.php';

class PostController extends Controller {
    public function index() {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();
        return response()->json($post);
    }

    // TODO: Adicionar categoria
    public function create(Request $request) {
        $rules = [
            'titulo' => 'required|min:3|max:70',
            'conteudo' => 'required|min: 5'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
            'titulo.max' => 'O campo titulo deve ter no máximo 70 caracteres.',
            'conteudo.min' => 'O campo conteudo deve ter no mínimo 5 caracteres.',
        ];

        $this->validate($request, $rules, $feedback);

        $post = new Post();

        $titulo = $request->titulo;
        $slug = remove_accents(strtolower(str_replace(' ', '-', $titulo)));

        $post->slug = $slug;
        $post->titulo = $titulo;
        $post->conteudo = $request->conteudo;
        
        $post->save();
        return response()->json($post);
    }

    public function update(Request $request, $slug) {
        $rules = [
            'slug' => 'required|min:3',
            'titulo' => 'required|min:3|max:70',
            'conteudo' => 'required|min: 5'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'slug.min' => 'O campo slug deve ter no mínimo 3 caracteres.',
            'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
            'titulo.max' => 'O campo titulo deve ter no máximo 70 caracteres.',
            'conteudo.min' => 'O campo conteudo deve ter no mínimo 5 caracteres.',
        ];

        $this->validate($request, $rules, $feedback);

        $post = Post::where('slug', $slug)->first();

        $post->slug = $request->slug;
        $post->titulo = $request->titulo;
        $post->conteudo = $request->conteudo;

        $post->save();
        return response()->json($post);
    }

    public function delete($slug) {
        $post = Post::where('slug', $slug)->first();
        $post->delete();

        return response()->json('Post deletado com sucesso.');
    }
}

?>