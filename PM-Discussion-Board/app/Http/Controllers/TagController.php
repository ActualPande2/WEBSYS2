<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::withCount('threads')->orderBy('name')->get();

        return view('tags.index', compact('tags'));
    }

    public function show(Tag $tag): View
    {
        $threads = $tag->threads()
            ->with(['user', 'category'])
            ->withCount(['replies', 'votes'])
            ->latest()
            ->paginate(15);

        return view('tags.show', compact('tag', 'threads'));
    }
}
