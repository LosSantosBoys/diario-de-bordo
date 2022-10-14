<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Models\Post;

require_once __DIR__ . '/../../helpers.php';

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::query();

        if ($request->query('titulo')) {
            $posts->where('titulo', 'LIKE', '%' . $request->query('titulo') . '%');
        }

        if ($request->query('slug')) {
            $posts->where('slug', 'LIKE', '%' . $request->query('slug') . '%');
        }

        $posts->where('data_de_publicacao', '<', now())
            ->where('visivel', '=', 1)
            ->orderBy('data_de_publicacao', 'ASC');

        return new PostCollection($posts->get()->paginate(15));
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
            'titulo' => 'required|min:3|max:70|unique:posts',
            'conteudo' => 'required|min: 5',
            'visivel' => 'required',
            'data_de_publicacao' => 'required|date',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'titulo.unique' => 'Um post com esse título já existe.',
            'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
            'titulo.max' => 'O campo titulo deve ter no máximo 70 caracteres.',
            'conteudo.min' => 'O campo conteudo deve ter no mínimo 5 caracteres.',
            'visivel.boolean' => 'O campo visivel precisa ser booleano `true` ou `false`.',
            'data_de_publicacao.date' => 'O campo data_de_publicacao precisa ser uma data.',
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
        $post->visivel = $request->visivel;
        $post->data_de_publicacao = $request->data_de_publicacao;
        
        $post->save();
        return new PostResource($post);
    }

    public function update(Request $request, $slug) {
        $rules = [
            'slug' => 'required|min:3',
            'titulo' => 'required|min:3|max:70',
            'conteudo' => 'required|min: 5',
            'visivel' => 'required',
            'data_de_publicacao' => 'required|date',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'slug.min' => 'O campo slug deve ter no mínimo 3 caracteres.',
            'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
            'titulo.max' => 'O campo titulo deve ter no máximo 70 caracteres.',
            'conteudo.min' => 'O campo conteudo deve ter no mínimo 5 caracteres.',
            'visivel.boolean' => 'O campo visivel precisa ser booleano `true` ou `false`.',
            'data_de_publicacao.date' => 'O campo data_de_publicacao precisa ser uma data.',
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
        $post->visivel = $request->visivel;
        $post->data_de_publicacao = $request->data_de_publicacao;

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
