<?php
namespace App\Traits;


use App\Models\City;
use App\Models\CityWeather;
use App\WeatherData\OpenWeather;
use App\WeatherData\WeatherBit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait WeatherApiTrait {

    /**
     * Get weather report from two api.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function getWeather(Request $request) {
        $request->validate([
            "city" => "required|integer|exists:cities,id"
        ]);

        $city = City::findOrFail($request->input("city"));
        $cacheName = "weather-city-{$city->id}";
        $expiresAt = Carbon::now()->addMinutes(30);
        
        $weatherData = Cache::remember($cacheName, $expiresAt, function() use($city) {
            $openWeather = new OpenWeather($city);
            $weatherData = $openWeather->compareData(new WeatherBit($city));

            CityWeather::create([
                "city_id" => $city->id
            ], ["weather" => json_encode($weatherData->toArray())]);

            return $weatherData;
        });

        return $weatherData;
    }

}
