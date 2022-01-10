<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherProxy extends Model
{
    /**
     * Get weather data
     * 
     * @param float $lat
     * @param float $lon
     * 
     * @return weather data
     */
    public function getWeather($lat, $lon)
    {
        $key = config('weather_url.weatherkey');
        $baseUrl = config('weather_url.weather');

        $response = file_get_contents(sprintf('%skey=%s&locatie=%s,%s`', $baseUrl, $key, $lat, $lon));
        
        return json_decode($response);
    }
}
