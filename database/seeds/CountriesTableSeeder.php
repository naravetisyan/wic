<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
			[
        		'name' => 'Germany',
        		'code' => 'DE'
        	],
        	[
        		'name' => 'Argentina',
        		'code' => 'AR'
        	],
			[
				'name' => 'Russia',
				'code' => 'RU'
			],
			[
				'name' => 'Portugal',
				'code' => 'PT'
			],
        	[
        		'name' => 'United States',
        		'code' => 'US'
        	],
        	[
        		'name' => 'Japan',
        		'code' => 'JP'
        	],
        	[
        		'name' => 'Italy',
        		'code' => 'IT'
        	],
        	[
        		'name' => 'Great Britain',
        		'code' => 'GB'
        	],
        	[
        		'name' => 'France',
        		'code' => 'FR'
        	],
        	[
        		'name' => 'Belgium',
        		'code' => 'BE'
        	]
        ];
        for($i = 0; $i < count($data); $i++) {
        	if(!Country::where('name', $data[$i]['name'])->exists()){
        		Country::create($data[$i]);
        	}
        }
    }
}
