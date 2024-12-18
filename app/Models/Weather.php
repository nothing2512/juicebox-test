<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_updated_epoch',
        'last_updated',
        'temp_c',
        'temp_f',
        'is_day',
        'wind_mph',
        'wind_kph',
        'wind_degree',
        'wind_dir',
        'pressure_mb',
        'pressure_in',
        'precip_mm',
        'precip_in',
        'humidity',
        'cloud',
        'feelslike_c',
        'feelslike_f',
        'windchill_c',
        'windchill_f',
        'heatindex_c',
        'heatindex_f',
        'dewpoint_c',
        'dewpoint_f',
        'vis_km',
        'vis_miles',
        'uv',
        'gust_mph',
        'gust_kph',
    ];

    protected $table = "weathers";
}
