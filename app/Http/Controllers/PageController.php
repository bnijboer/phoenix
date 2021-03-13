<?php

namespace App\Http\Controllers;

use Inertia\Response;

class PageController extends Controller
{
    public function landing(): Response
    {
        return inertia('Landing');
    }
    
    public function about(): Response
    {
        return inertia('About');
    }
}
