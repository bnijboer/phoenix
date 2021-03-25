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
        
        $comment = $post->comments()->make($request->validated());
        $comment->user_id = $request->user()->id;
        $comment->save();
        
        $comment->user = $request->user();
        
        return $comment->toJson();
    }
    
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $comment->delete();
    }
}
