<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Place;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code'
    ];

    public function place()
	{
	  return $this->hasMany(Place::class);
	}
}
