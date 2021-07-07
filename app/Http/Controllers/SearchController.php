<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Response;

class SearchController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return Response
     */
    public function __invoke(SearchRequest $request): Response
    {
        $searchTerm = $request->query('query');

        $posts = Post::where('title', 'like', "%$searchTerm%")
                     ->orWhere('body', 'like', "%$searchTerm%")
                     ->orWhereHas('tags', function (Builder $query) use ($searchTerm) {
                        $query->where('keyword', 'like', "%$searchTerm%");
                    })
                    ->latest('published_at')
                    ->paginate(10);

        return inertia('Posts/Index', compact('posts'));
    }
}
