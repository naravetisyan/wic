<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\ZipCode;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'latitude', 'longitude', 'zip_code_id', 'country_id'
    ];

    public function country()
	{
	  	return $this->belongsTo(Country::class);
	}

	public function zipCode()
	{
	  	return $this->belongsTo(ZipCode::class);
	}
}
