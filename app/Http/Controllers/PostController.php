<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response The HTML server response.
     */
    public function index(Tag $tag = null): Response
    {
        $posts = Post::latest()->paginate(10);
        
        return inertia('Posts/Index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response The HTML server response.
     */
    public function create(): Response
    {
        $this->authorize('create', Post::class);

        return inertia('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $this->authorize('create', Post::class);

        $post = $request->user()->posts()->create($request->validated());
        
        $post->syncTags($request->tags);

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return Response The HTML server response.
     */
    public function show(Post $post): Response
    {
        $post->load(['comments', 'tags']);
        
        return inertia('Posts/Show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response The HTML server response.
     * @throws AuthorizationException
     */
    public function edit(Post $post): Response
    {
        $this->authorize('update', $post);
        
        $post->load(['comments', 'tags']);

        return inertia('Posts/Edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);

        $post->update($request->validated());
        
        $post->syncTags($request->tags);

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
