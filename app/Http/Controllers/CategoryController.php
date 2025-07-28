<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('audios')->firstOrFail();
        $relatedCategories = Category::whereNot('id', $category->id)->get();
        return view('category.show', compact('category', 'relatedCategories'));
    }
}
