<?php

namespace Motorola\Members\Interfaces\Web\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController
{
    public function index(): Response
    {
        return Inertia::render('Home');
    }
}
