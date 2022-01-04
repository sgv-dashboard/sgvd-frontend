<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SunsetProxy;

class SunsetController extends Controller
{
    /**
     * Get sunset
     * 
     * @param Date $date
     * @param float $lat
     * @param float $lon
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSunset($date, $lat, $lon)
    {
        $sunset = (new SunsetProxy())->getSunset($date, $lat, $lon);
        return $sunset;
    }

    /**
     * Get sunrise
     * 
     * @param Date $date
     * @param float $lat
     * @param float $lon
     * 
     * @return \Illuminate\Http\Response
     */
    public function getSunrise($date, $lat, $lon)
    {
        $sunrise = (new SunsetProxy())->getSunrise($date, $lat, $lon);
        return $sunrise;
    }
}
