<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityWeather extends Model {
    public $timestamps = true;
    protected $fillable = ["city_id", "weather"];

    public function city() : BelongsTo{
        return $this->belongsTo(City::class);
    }
}
