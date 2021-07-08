<?php

namespace App\Http\Controllers;


use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CountryCityController extends Controller {

    public function getCountry(Request $request) {
        $cacheName = "countries";
        $expiresAt = Carbon::now()->addMinutes(30);

        return Cache::remember($cacheName, $expiresAt, function() {
            return Country::all()->toArray();
        });

    }

    public function getCity(Country $country) {
        $cacheName = "country-cities-{$country->id}";
        $expiresAt = Carbon::now()->addMinutes(30);

        return Cache::remember($cacheName, $expiresAt, function() use($country) {
            return $country->cities->toArray();
        });
    }
}
