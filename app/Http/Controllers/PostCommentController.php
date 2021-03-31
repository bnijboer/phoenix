<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;

class PostCommentController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param Post $post
     * @param CommentRequest $request
     * @return string
     * @throws AuthorizationException
     */
    public function store(Post $post, CommentRequest $request): string
    {
        $this->authorize('create', Comment::class);

        $comment = $post->comments()->make($request->validated());
        $comment->user_id = $request->user()->id;
        $comment->save();

        $comment->user = $request->user();

        return $comment->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @param Comment $comment
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
    }
}
