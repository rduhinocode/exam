<?php
namespace App\WeatherData;

use App\Models\City;


class WeatherBit extends Weather {
    private $city;

    // Define data mapping
    protected $dataMapping = [
        "longitude" => "lon",
        "latitude" => "lat",
        "temperature" => "temp",
        "pressure" => "pres",
        "humidity" => "rh",
        "sea_level" => "slp"
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
            "key" => env("WEATHER_BIT_API_KEY")
        ];

        $this->url = env("WEATHER_BIT_API_URL") ."?". http_build_query($query);
    }
}
