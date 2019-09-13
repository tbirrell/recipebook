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

    //=== RELATIONSHIPS ===//
    public function ingredient()
    {
      return $this->hasMany(Ingredient::class);
    }


    //=== SCOPES ===//
    public static function retrieve($key)
    {
        return self::where('id', $key)
              ->orWhere('slug', $key)
              ->orWhere('name', $key)
              ->first();
    }
    
    public static function retrieveOrCreate($value)
    {
      $food = self::retrieve($value);
      if ($food !== null && $food->exists) {
        return $food;
      } else {
        return (new self)->create(['name' => $value]);
      }
    }
}
