<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = ['id'];

    public function ingredients()
    {
    	return $this->belongsToMany(Ingredient::class);
    }

}
