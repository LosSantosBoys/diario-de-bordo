<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function index() {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function show($titulo) {
        $category = Category::where('titulo', $titulo)->first();
        return response()->json($category);
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
        $category->titulo = $request->titulo;
        
        $category->save();
        return response()->json($category);
    }

    public function update(Request $request, $titulo) {
        $rules = [
            'titulo' => 'required|min:3|max:40'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'titulo.min' => 'O campo titulo deve ter no mínimo 3 caracteres.',
            'titulo.max' => 'O campo titulo deve ter no máximo 40 caracteres.',
        ];

        $this->validate($request, $rules, $feedback);
        
        $category = Category::where('titulo', $titulo)->first();
        $category->titulo = $request->titulo;
        
        $category->save();
        return response()->json($category);
    }

    public function delete($titulo) {
        $category = Category::where('titulo', $titulo)->first();
        $category->delete();

        return response()->json('Categoria deletada com sucesso.');
    }
}

?>