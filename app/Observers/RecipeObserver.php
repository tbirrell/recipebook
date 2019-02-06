<?php

namespace App\Observers;

use App\Models\Recipe;

class RecipeObserver
{
    public function retrieved (Recipe $recipe){}
    public function creating (Recipe $recipe)
    {
    	//slugit
    	$recipe->slugify()->uniquely();

        //make sure owner is set
        $recipe->user_id = auth()->id();
    }
    public function created (Recipe $recipe){}
    public function updating (Recipe $recipe){}
    public function updated (Recipe $recipe){}
    public function saving (Recipe $recipe){}
    public function saved (Recipe $recipe){}
    public function deleting (Recipe $recipe){}
    public function deleted (Recipe $recipe){}
    public function restoring (Recipe $recipe){}
    public function restored (Recipe $recipe){}
}
