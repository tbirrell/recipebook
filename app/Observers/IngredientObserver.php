<?php

namespace App\Observers;

use App\Ingredient;

class IngredientObserver
{
    /**
     * Handle the ingredient "created" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function created(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the ingredient "updated" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function updated(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the ingredient "deleted" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function deleted(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the ingredient "restored" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function restored(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the ingredient "force deleted" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function forceDeleted(Ingredient $ingredient)
    {
        //
    }
}
