<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use App\Traits\Sluggable;

class Food extends Model
{
	use Userstamps;
  use Sluggable;

    protected $guarded = ['id'];
    protected $table = 'food';


    //=== SCOPES ===//
    public function scopeRetrieve($query, $key)
    {
        return $query->where('id', $key)
              ->orWhere('slug', $key)
              ->orWhere('name', $key)
              ->first();
    }
    
    public function scopeRetrieveOrCreate($query, $value)
    {
      $food = $query->retrieve($value)->first();
      if ($food !== null && $food->exists) {
        return $food;
      } else {
        return (new self)->create(['name' => $value]);
      }
    }
}
