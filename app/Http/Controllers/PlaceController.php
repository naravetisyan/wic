<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\zipCode;
use App\Place;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get();
        return view('welcome', compact('countries'));
    }

    public function isPlaceExists(Request $request) {
        $places = Place::whereHas('zipCode', function ($query) use ($request) {
            $query->where('zip_code', '=', $request->zip_code);
        })->whereHas('country', function ($query) use ($request) {
            $query->where('code', '=', $request->country);
        })->get();
        return $places;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $places = $request->places;
        $zipCode = zipCode::where(['zip_code' => $request->zip_code])->first();
        if($zipCode === null) {
            $zipCode = zipCode::create(['zip_code' => $request->zip_code]);
        }
        $country = Country::where('name', $request->country)->first();
        foreach ($places as $place) {
            $inputs['name'] = $place["place name"];
            $inputs['longitude'] = $place['longitude'];
            $inputs['latitude'] = $place['latitude'];
            $inputs['country_id'] = $country->id;
            $inputs['zip_code_id'] = $zipCode->id;
            Place::create($inputs);   
        }
        return response()->json(['status' => 'success'], 200);
    }
}