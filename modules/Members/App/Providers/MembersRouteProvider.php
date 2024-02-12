<?php

namespace Motorola\Members\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class MembersRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::middleware([
            'api',
        ])->prefix('api')->group(__DIR__. '/../Routes/web.php');
    }
}
