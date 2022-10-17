<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

require_once __DIR__ . '/../../helpers.php';

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return new CategoryCollection($categories);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($slug)
    {
        try {
            $category = Category::where('slug', $slug)->first();
            return new CategoryResource($category);
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
            $rules = [
                'titulo' => 'required|min:3|max:40'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
                'titulo.max' => 'O campo titulo deve ter no máximo 40 caracteres.',
            ];

            $this->validate($request, $rules, $feedback);

            $category = new Category();
            $category->slug = clean($request->titulo);
            $category->titulo = trim($request->titulo);

            $category->save();
            return response()->json($category);
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
            $rules = [
                'slug' => 'required|min:3',
                'titulo' => 'required|min:3|max:40'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'slug.min' => 'O campo slug deve ter no mínimo 3 caracteres.',
                'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
                'titulo.max' => 'O campo titulo deve ter no máximo 40 caracteres.',
            ];

            $this->validate($request, $rules, $feedback);

            $category = Category::where('slug', $slug)->first();
            $category->slug = clean($request->slug);
            $category->titulo = trim($request->titulo);

            $category->save();
            return response()->json($category);
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
            $category = Category::where('slug', $slug)->first();

            if ($category) {
                $category->delete();
                return response()->json(null, 204);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Categoria não encontrada.'
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

            $categories = DB::table('categories')
                ->where('slug', 'LIKE', "%{$query}%")
                ->orWhere('titulo', 'LIKE', "%{$query}%")
                ->get();

            return response()->json($categories);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
