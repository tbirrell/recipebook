<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class Recipe extends Model
{
		use Sluggable;


    protected $guarded = ['id'];

		//=== RELATIONSHIPS ===//
    public function ingredients()
    {
    	return $this->hasMany(Ingredient::class);
    }

    public function instructions()
    {
    	return $this->hasMany(Instruction::class);
    }

		//=== SCOPES ===//
    public function scopeRetrieve($query, $key)
    {
        return $query->where('id', $key)
              ->orWhere('slug', $key)
              ->orWhere('name', $key)
              ->first();
    }
}
