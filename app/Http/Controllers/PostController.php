<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
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
        return Inertia::render('Posts/Index', [
            'posts' => Post::all()->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    // 'body' => Str::words($post->body, 10, '...'),
                    'image' => $post->image,
                    'created_at' => $post->created_at,
                ];
            }),
        ]);
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

        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        Post::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return Response The HTML server response.
     */
    public function show(Post $post): Response
    {
        return Inertia::render('Posts/Show', compact('post'));
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

        return Inertia::render('Posts/Edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @throws AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());
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
    }
}
