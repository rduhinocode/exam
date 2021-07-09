<?php
namespace App\WeatherData;

use App\Models\City;

class OpenWeather extends Weather {

    // Construct set api queries and url
    public function __construct(City $city) {

        parent::__construct($city);
    }

    /*
     * Set Api Queries, url and some data sources
     *
     * @return void
     */
    protected function setApiResource() {
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

    /*
     * Set data mapping from api data to your needed data
     *
     * @return void
     */
    protected function setDataMapping() {
        $this->dataMapping = [
            "longitude" => "lon",
            "latitude" => "lat",
            "temperature" => "temp",
            "pressure" => "pressure",
            "humidity" => "humidity",
            "sea_level" => "sea_level"
        ];
    }
}
