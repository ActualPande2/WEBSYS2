<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('threads')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $threads = $category->threads()
            ->with(['user', 'category'])
            ->withCount(['replies', 'votes'])
            ->latest()
            ->paginate(15);

        return view('categories.show', compact('category', 'threads'));
    }
}
