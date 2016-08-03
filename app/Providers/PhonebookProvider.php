<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class PhonebookProvider extends ServiceProvider
{
    public function register() {
        $this->app->bind("App\Repositories\PhonebooksRepositoryInterface", "App\Repositories\PhonebooksRepository");
    }
}