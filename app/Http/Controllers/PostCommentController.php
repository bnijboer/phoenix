<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    public function store(Post $post, CommentRequest $request)
    {
        $this->authorize('create', Comment::class);
        
        $comment = $post->comments()->make($request->all());
        $comment->user_id = Auth::id();
        $comment->save();
        
        $comment->user = Auth::user();
        
        return $comment->toJson();
    }
    
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('destroy', $comment);
        
        $comment->delete();
    }
}
