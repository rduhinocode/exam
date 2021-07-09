<?php
namespace App\WeatherData;

use App\Models\City;


class WeatherBit extends Weather {
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
            "key" => env("WEATHER_BIT_API_KEY")
        ];

        $this->url = env("WEATHER_BIT_API_URL") ."?". http_build_query($query);
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
            "pressure" => "pres",
            "humidity" => "rh",
            "sea_level" => "slp"
        ];
    }
}
