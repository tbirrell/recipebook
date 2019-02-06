<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Recipe;
use App\Models\Food;
use App\Observers\RecipeObserver;
use App\Observers\FoodObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Recipe::observe(RecipeObserver::class);
        Food::observe(FoodObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
