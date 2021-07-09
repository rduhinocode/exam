<?php

namespace App\WeatherData;

abstract class Weather {
    /*
     * Api data will be save in this variable
     */
    protected $url;
    protected $data = [];
    protected $header;
    protected $method = "GET";
    protected $body = [];
    protected $city;
    protected $dataMapping = [];

    /*
     * Predefine weather clean data array
     */
    protected $cleanData = [
        "longitude" => 0,
        "latitude" => 0,
        "temperature" => 0,
        "pressure" => 0,
        "humidity" => 0,
        "sea_level" => 0
    ];

    /*
     * Set Api Queries, url and some data sources
     *
     * @return void
     */
    abstract protected function setApiResource();

    /*
    * Set data mapping from api data to your needed data
    *
    * @return void
    */
    abstract protected function setDataMapping();


    public function __construct($city) {
        $this->city = $city;
        $this->setApiResource();
        $this->setDataMapping();
    }

    /*
     * Raw Data from Api
     *
     * @return array
     */
    public function getApiData() {
        if (empty($this->data)) {
            $this->data = $this->requestApiData();
        }

        return $this->data;
    }

    /*
     * Clean Api Data
     *
     * @return array
     */
    public function getCleanApidata() {
        if (empty($this->data)) {
            $this->data = $this->requestApiData();
        }
        $this->associateData();

        return $this->cleanData;
    }

    /*
     * Handles compare data, calculate values to average. Current $cleanData will be the base of which fields to compare.
     *
     * @param Weather $dataToCompare
     * @return array
     */
    public function compareData(Weather $dataToCompare) {
        $myData = $this->getCleanApidata();
        $theirData = $dataToCompare->getCleanApidata();

        return collect($myData)->map(function($item, $key) use($theirData) {
            if (!empty($theirData[$key]) && is_numeric($theirData[$key])) {
                return ($item + $theirData[$key]) / 2;
            }

            return $item;
        });
    }

    /*
     * Handles sending of request to weather api.
     *
     * @return array
     */
    protected function requestApiData() {
        $opt = [];
        if (!empty($this->header)) {
            $opt = [
                "headers" => $this->header
            ];
        }
        $client = new \GuzzleHttp\Client($opt);

        $body = [];
        if (!empty($this->body)) {
            $body = [
                "body" => $body
            ];
        }

        $request = $client->request($this->method, $this->url, $body);

        return json_decode($request->getBody()->getContents(), true);
    }

    /*
     * Handles cleaning the data and associate to appropriate fields by the mapping.
     *
     * @return array
     */
    protected function associateData() {
        $tmpData = $this->cleanData;
        $fields = collect($this->dataMapping)->flatten()->toArray();
        $flipDataMap =  collect($this->dataMapping)->flip();
        $dataCollection = $this->data;

        array_walk_recursive( $dataCollection , function($value, $key) use (&$tmpData, $fields, $flipDataMap) {
            if (!is_numeric($key) && in_array($key, $fields)) {
                $tmpData[$flipDataMap[$key]] = $value;
            }
        });

        $this->cleanData = $tmpData;
    }
}
