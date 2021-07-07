<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class EntryController extends Controller {
    public function index() {
        return view('home', [
            'countries' => Country::all(),
         ]);
    }

    public function getWeather(Request $request) {

    }
}
