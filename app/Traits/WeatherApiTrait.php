<?php
namespace App\Traits;


use App\Models\City;
use App\WeatherData\OpenWeather;
use App\WeatherData\WeatherBit;
use Illuminate\Http\Request;

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

        $openWeather = new OpenWeather($city);
        $weatherData = $openWeather->compareData(new WeatherBit($city));

        return $weatherData;
    }

}
