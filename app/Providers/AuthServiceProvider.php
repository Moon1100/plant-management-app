<?php

namespace App\Providers;

use App\Models\Farm;
use App\Models\Plant;
use App\Policies\FarmPolicy;
use App\Policies\PlantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Farm::class => FarmPolicy::class,
        Plant::class => PlantPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
