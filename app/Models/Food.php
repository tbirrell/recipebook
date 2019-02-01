<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
USe Wildside\Userstamps;
use App\Traits\Sluggable;

class Food extends Model
{
	use Userstamps;
  use Sluggable;

    protected $guarded = ['id'];
    protected $table = 'food';

    public function scopeRetrieve($query, $key)
    {
        return $query->where('id', $key)
              ->orWhere('slug', $key)
              ->orWhere('name', $key)
              ->first();
    }
    public function scopeRetrieveOrCreate($query, $value)
    {
      $food = $query->retrieve($value);
      if ($food->exists) {
        return $food;
      } else {
        return (new self)->create(['name' => $value]);
      }
    }
}
