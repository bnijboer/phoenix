<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;

class PostTagController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store the specified resource in storage.
     *
     * @param TagRequest $request
     * @param Post $post
     * @throws AuthorizationException
     */
    public function store(TagRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        
        $tag = Tag::firstOrCreate([
            'name' => $request->name,
        ]);
        
        if (! $post->tags->containsStrict('name', $tag->name)) {
            $post->tags()->attach($tag);
        }
        
        return redirect()->route('posts.show', $post);
    }
}
