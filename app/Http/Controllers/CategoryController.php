<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // vue qui liste les articles d'une catégorie
    public function show(Category $category) {
        $articles = $category->articles()->withCount('comments')->latest()->paginate(5);

        $data = [
            'title' => $category->name,
            'description' => 'Les articles de la catégorie '.$category->name,
            'category' => $category,
            'articles' => $articles,
        ];
        return view('category.show', $data);
    }
}
