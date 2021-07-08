<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Traits\WeatherApiTrait;

class EntryController extends Controller {
    use WeatherApiTrait;

    public function index() {
        return view('home', [
            'countries' => Country::all(),
         ]);
    }
}
