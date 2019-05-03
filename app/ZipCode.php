<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Place;

class ZipCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'zip_code', 'country_id'
    ];

    public function places()
	{
	  return $this->belongsTo(Place::class);
	}
}
