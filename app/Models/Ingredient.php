<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class Ingredient extends Model
{
  use Sluggable;

    protected $guarded = ['id'];

    //=== RELATIONSHIPS ===//
    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }

    public function food()
    {
      return $this->belongsTo(Food::class);
    }

}
