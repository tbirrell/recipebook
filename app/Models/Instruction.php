<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;

class Instruction extends Model
{
  use Sluggable;

    protected $guarded = ['id'];

    //=== RELATIONSHIPS ===//
    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }

}
