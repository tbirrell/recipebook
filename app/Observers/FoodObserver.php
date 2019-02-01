<?php

namespace App\Observers;

use App\Models\Food;

class FoodObserver
{
    public function retrieved (Food $food){}
    public function creating (Food $food)
    {
    	if (empty($food->slug)) {
	    	$food->slugify();
    	}
    {
    	if (empty($food->name)) {
	    	$food->unslugify();
    	}
    }
    public function created (Food $food){}
    public function updating (Food $food){}
    public function updated (Food $food){}
    public function saving (Food $food){}
    public function saved (Food $food){}
    public function deleting (Food $food){}
    public function deleted (Food $food){}
    public function restoring (Food $food){}
    public function restored (Food $food){}
}
