<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class PostCommentController extends Controller
{
    public function store(Post $post, CommentRequest $request)
    {
        $this->authorize('create', Comment::class);
        
        $post->comments()->create($request->all());
        
        return redirect()->route('posts.show', $post);
    }
}
