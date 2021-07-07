<?php

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountryCitySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (Storage::exists("public/countries.json")) {
            $countries = json_decode(Storage::get("public/countries.json"), true);

            foreach ($countries as $country) {
                $saveCountry = Country::create([
                    "name" => $country["name"],
                    "code" => $country["iso2"]
                ]);
                $cities = [];
                foreach ($country["states"] as $city) {
                    $cities[] = [
                        "country_id" => $saveCountry->id,
                        "name" => $city["name"],
                        "code" => $city["state_code"]
                    ];
                }

                City::insert($cities);
            }
        }
    }
}
