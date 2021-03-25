<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $searchTerm = $request->get('query');
        
        $posts = Post::where('title', 'like', "%$searchTerm%")
                     ->orWhere('body', 'like', "%$searchTerm%")
                     ->orWhereHas('tags', function (Builder $query) use ($searchTerm) {
                        $query->where('keyword', 'like', "%$searchTerm%");
                    })
                     ->latest()
                     ->get();
        
        return inertia('Posts/Index', compact('posts'));
    }
}
