<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SunsetProxy extends Model
{
    /**
     * Get sunset
     * 
     * @param Date $date
     * @param float $lat
     * @param float $lon
     * 
     * @return dateTime
     */
    public function getSunset($date, $lat, $lon)
    {
        $key = config('url.sunkey');
        $baseUrl = config('url.sun');
        $response = file_get_contents(sprintf('%s/sunset?key=%s&lat=%s&lon=%s&date=%s', $baseUrl, $key, $lat, $lon, $date));
        return json_decode($response);
    }

    /**
     * Get sunrise
     * 
     * @param Date $date
     * @param float $lat
     * @param float $lon
     * 
     * @return dateTime
     */
    public function getSunrise($date, $lat, $lon)
    {
        $key = config('url.sunkey');
        $baseUrl = config('url.sun');
        $response = file_get_contents(sprintf('%s/sunrise?key=%s&lat=%s&lon=%s&date=%s', $baseUrl, $key, $lat, $lon, $date));
        return json_decode($response);
    }
}
