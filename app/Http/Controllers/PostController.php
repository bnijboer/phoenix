<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Str;
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
     */
    public function index(): Response
    {
        $posts = Post::latest()->get();
        
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
     * @throws AuthorizationException
     */
    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
        
        $post = $request->user()->posts()->make($request->except('keywords'));
        $post->slug = Str::of($request->title)->slug('-');
        $post->save();
        
        // Handles (optional) blogpost tags.
        if ($request->filled('keywords')) {
            $keywords = explode(', ', $request->keywords);
            
            foreach ($keywords as $keyword) {
                if (! $post->tags->containsStrict('keyword', strtolower($keyword))) {
                    $tag = Tag::firstOrCreate(['keyword' => strtolower($keyword)]);
                    $post->tags()->attach($tag);
                }
            }
        }
        
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

        return inertia('Posts/Edit', [
            'post' => $post,
            'keywords' => $post->tags->implode('keyword', ', '),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @throws AuthorizationException
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());
        
        // Handles (optional) blogpost tags.
        if ($request->filled('keywords')) {
            $keywords = explode(', ', $request->keywords);
            
            foreach ($keywords as $keyword) {
                if (! $post->tags->containsStrict('keyword', strtolower($keyword))) {
                    $tag = Tag::firstOrCreate(['keyword' => strtolower($keyword)]);
                    $post->tags()->attach($tag);
                }
            }
        }
        
        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();
        
        return redirect()->route('posts.index');
    }
}
