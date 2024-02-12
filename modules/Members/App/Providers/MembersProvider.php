<?php

namespace Motorola\Members\App\Providers;

use Illuminate\Support\ServiceProvider;
use Motorola\Members\MembersManager;

class MembersProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('members', fn () => new MembersManager());
        $this->app->register(MembersRouteProvider::class);
    }
}
