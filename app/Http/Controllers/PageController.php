<?php

namespace App\Http\Controllers;

use Inertia\Response;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return Response The HTML server response.
     */
    public function landing(): Response
    {
        return inertia('Landing');
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
