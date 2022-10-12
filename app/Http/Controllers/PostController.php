<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;

require_once __DIR__ . '/../../helpers.php';

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return new PostCollection($posts);
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();
    
        if ($post == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post não encontrado.'
            ], 400);
        }

        return new PostResource($post);
    }

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

        $slug = clean($request->titulo);
        $checkPost = Post::where('slug', $slug)->first();
    
        if ($checkPost != null) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post já existe.'
            ], 400);
        }

        $post = new Post();

        $post->slug = $slug;
        $post->titulo = trim($request->titulo);
        $post->conteudo = trim($request->conteudo);
        $post->categoria_id = $request->categoria_id;
        
        $post->save();
        return new PostResource($post);
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
    
        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post não encontrado.'
            ], 400);
        }

        $newSlug = clean($request->slug);
        $post->slug = $newSlug;
        $post->titulo = trim($request->titulo);
        $post->conteudo = trim($request->conteudo);
        $post->categoria_id = $request->categoria_id;

        $post->save();
        return new PostResource($post);
    }

    public function delete($slug) {
        $post = Post::where('slug', $slug)->first();
        
        if ($post) {
            $post->delete();
            return response()->json(null, 204);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Post não encontrado.'
        ], 400);
    }

    public function search(Request $request) {
        $query = $request->query('q');

        $posts = DB::table('posts')
            ->where('titulo', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->get();

        return new PostCollection($posts);
    }
}
