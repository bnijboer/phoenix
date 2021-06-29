<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Inertia\Response;

class TagController extends Controller
{
    /**
     * @param Tag $tag
     * @return Response
     */
    public function __invoke(Tag $tag): Response
    {
        $posts = $tag->posts()->latest()->paginate(10);

        return inertia('Posts/Index', compact('posts'));
    }
}
