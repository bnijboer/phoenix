<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return RedirectResponse
     */
    public function home(): RedirectResponse
    {
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @return Response The HTML server response.
     */
    public function about(): Response
    {
        return inertia('About');
    }

    /**
     * Display the specified resource.
     *
     * @return Response The HTML server response.
     */
    public function admin(): Response
    {
        return inertia('Admin');
    }
}
