<?php

namespace App\Http\Controller;

use App\Request;
use App\Response;
use App\View;

final class MainController
{
    public function index(): Response
    {
        return new Response(View::make('home'));
    }
}