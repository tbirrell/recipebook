<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use App\Traits\Sluggable;

class Instruction extends Model
{
	use Userstamps;
  use Sluggable;

    protected $guarded = ['id'];

    //=== RELATIONSHIPS ===//
    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }

}
