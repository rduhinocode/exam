<?php

namespace App\Http\Controllers;


use App\Models\Country;
use Illuminate\Http\Request;

class CountryCityController extends Controller {

    public function getCountry(Request $request) {
        return Country::all()->toArray();
    }

    public function getCity(Country $country) {
        return $country->cities->toArray();
    }
}
