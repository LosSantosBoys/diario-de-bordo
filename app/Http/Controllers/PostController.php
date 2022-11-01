<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Session;

require_once __DIR__ . '/../../helpers.php';

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $posts = Post::query();

            if ($request->query('titulo')) {
                $posts->where('titulo', 'LIKE', '%' . $request->query('titulo') . '%');
            }

            if ($request->query('slug')) {
                $posts->where('slug', 'LIKE', '%' . $request->query('slug') . '%');
            }

            $posts->where('dataDePublicacao', '<', now())
                ->where('visivel', '=', 1)
                ->orderBy('dataDePublicacao', 'DESC');

            if ($request->is('api/*')) {
                return new PostCollection($posts->get()->paginate(15));
            }

            if (Auth::user()) {
                return view('admin.posts', [
                    'posts' =>  new PostCollection($posts->get()->paginate(15))
                ]);
            } else {
                return view('home', [
                    'posts' =>  new PostCollection($posts->get()->paginate(15))
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show(Request $request, $slug)
    {
        try {
            $post = Post::where('slug', $slug)->first();

            if ($post == null) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Post não encontrado.'
                ], 400);
            }


            if ($request->is('api/*')) {
                return new PostResource($post);
            } else {
                return view('posts.index', [
                    'post' =>  new PostResource($post)
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            if ($request->is('api/*')) {
                $rules = [
                    'titulo' => 'required|min:3|max:70|unique:posts',
                    'conteudo' => 'required|min: 5',
                    'dataDePublicacao' => 'required|date',
                ];

                $feedback = [
                    'required' => 'O campo :attribute deve ser preenchido.',
                    'titulo.unique' => 'Um post com esse título já existe.',
                    'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
                    'titulo.max' => 'O campo titulo deve ter no máximo 70 caracteres.',
                    'conteudo.min' => 'O campo conteudo deve ter no mínimo 5 caracteres.',
                    'dataDePublicacao.date' => 'O campo dataDePublicacao precisa ser uma data.',
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
                $post->categoriaId = $request->categoriaId;
                $post->visivel = true;
                $post->dataDePublicacao = $request->dataDePublicacao;

                $post->save();

                Session::flash('msg', 'Post cadastrado com sucesso!');
                return redirect('/admin/posts');
            }

            if (Auth::user()) {
                $post = new Post();

                return view('admin.post', compact('post'));
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $post = Post::where('slug', $slug)->first();

            if (!$post) {
                Session::flash('msg', 'Post não encontrado!');
                return redirect('/admin/posts');
            }

            if ($request->is('api/*')) {
                $rules = [
                    'titulo' => 'required|min:3|max:70',
                    'conteudo' => 'required|min: 5',
                    'dataDePublicacao' => 'required|date',
                ];
    
                $feedback = [
                    'required' => 'O campo :attribute deve ser preenchido.',
                    'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
                    'titulo.max' => 'O campo titulo deve ter no máximo 70 caracteres.',
                    'conteudo.min' => 'O campo conteudo deve ter no mínimo 5 caracteres.',
                    'dataDePublicacao.date' => 'O campo dataDePublicacao precisa ser uma data.',
                ];
    
                $this->validate($request, $rules, $feedback);

                $post->slug = clean($request->titulo);
                $post->titulo = trim($request->titulo);
                $post->conteudo = trim($request->conteudo);
                $post->categoriaId = $request->categoriaId;
                $post->visivel = true;
                $post->dataDePublicacao = $request->dataDePublicacao;
    
                $post->save();

                Session::flash('msg', 'Post editado com sucesso!');
                return redirect('/admin/posts');
            }

            if (Auth::user()) {
                return view('admin.post', compact('post'));
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete($slug)
    {
        try {
            $post = Post::where('slug', $slug)->first();

            if ($post) {
                $post->delete();
                return response()->json(null, 204);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Post não encontrado.'
            ], 400);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->query('q');

            $posts = DB::table('posts')
                ->where('titulo', 'LIKE', "%{$query}%")
                ->orWhere('slug', 'LIKE', "%{$query}%")
                ->get();

            if ($request->is('api/*')) {
                return new PostCollection($posts);
            } else {
                return view('home', [
                    'posts' =>  new PostCollection($posts)
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
