<?php
namespace App\WeatherData;

use App\Models\City;

class OpenWeather extends Weather {
    private $city;

    // Define data mapping
    protected $dataMapping = [
        "longitude" => "lon",
        "latitude" => "lat",
        "temperature" => "temp",
        "pressure" => "pressure",
        "humidity" => "humidity",
        "sea_level" => "sea_level"
    ];

    // Construct set api queries and url
    public function __construct(City $city) {
        $this->city = $city;

        $this->cleanData = $this->cleanData + [
                "city" => $this->city->name
            ];

        $query = [
            "lat" => $this->city->latitude,
            "lon" => $this->city->longitude,
            "units" => "metric",
            "appid" => env("OPEN_WEATHER_API_KEY")
        ];

        $this->url = env("OPEN_WEATHER_API_URL") ."?". http_build_query($query);
    }
}
