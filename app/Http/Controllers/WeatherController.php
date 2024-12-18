<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    function show() {
        $weather = Weather::query()->first();
        return response()->json($weather);
    }
}
