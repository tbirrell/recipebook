<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//todo add userstamps here

class Food extends Model
{
	use Userstamps;

    protected $guarded = ['id'];
    protected $table = 'food';

    public function scopeRetrieve($query, $key)
    {
        return $query->where('id', $key)
              ->orWhere('slug', $key)
              ->orWhere('name', $key)
              ->first();
    }
}
