<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return [
            'tags' => Tag::all(),
        ];
    }
    
    public function show(Tag $tag)
    {
        return inertia('Posts/Index', [
            'posts' => $tag->posts,
        ]);
    }
}
