<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Traits\WeatherApiTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class EntryController extends Controller {
    use WeatherApiTrait;

    public function index() {
        $cacheName = "index-countries";
        $expiresAt = Carbon::now()->addMinutes(30);

        return view('home', [
            'countries' => Cache::remember($cacheName, $expiresAt, function() {
                return Country::all();
            }),
         ]);
    }
}
