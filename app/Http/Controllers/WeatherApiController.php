<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeatherProxy;

class WeatherApiController extends Controller
{
    /**
     * Get weather
     * 
     * @param float $lat
     * @param float $lon
     * 
     * @return \Illuminate\Http\Response
     */
    public function getWeather($lat, $lon)
    {
        $weather = (new WeatherProxy())->getWeather($lat, $lon);
        return $weather;
    }

    public function getInfo($temperature, $rainChance)
    {
        $info = (new WeatherProxy())->getWeatherInfo($temperature, $rainChance);
        return $info;
    }
}
