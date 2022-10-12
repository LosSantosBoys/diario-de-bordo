<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

require_once __DIR__ . '/../../helpers.php';

class CategoryController extends Controller {
    public function index() {
        $categories = Category::all();
        return new CategoryCollection($categories);
    }

    public function show($slug) {
        $category = Category::where('slug', $slug)->first();
        return new CategoryResource($category);
    }

    public function create(Request $request) {
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
    }

    public function update(Request $request, $slug) {
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
    }

    public function delete($slug) {
        $category = Category::where('slug', $slug)->first();
        $category->delete();

        return response()->json('Categoria deletada com sucesso.');
    }

    public function search(Request $request) {
        $query = $request->query('q');

        $categories = DB::table('categories')
            ->where('slug', 'LIKE', "%{$query}%")
            ->orWhere('titulo', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($categories);
    }
}

?>