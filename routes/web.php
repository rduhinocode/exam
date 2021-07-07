<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\CountryCityController;
use App\Http\Controllers\EntryController;

Route::get('/', [EntryController::class, "index"]);
Route::post('/weather', [EntryController::class, "getWeather"])->name("weather");
Route::get('country/{country}/city', [CountryCityController::class, "getCity"])->name("countries");
