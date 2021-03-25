<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        return inertia('Posts/Index', ['posts' => $tag->posts]);
    }
}
