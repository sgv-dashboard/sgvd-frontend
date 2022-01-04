<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SunsetProxy;
use DateTime;

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

    /**
     * Determine if it is day at a certain location & time
     * 
     * @return bool day
     */
    public function isDay($dateTime, $lat, $lon)
    {
        $dateTime = strtotime($dateTime);
        $date = date('Y-m-d', $dateTime);
        $sunrise = strtotime((new SunsetProxy())->getSunrise($date, $lat, $lon)->datetime);
        $sunset = strtotime((new SunsetProxy())->getSunset($date, $lat, $lon)->datetime);
        if ($sunrise <= $dateTime && $dateTime <= $sunset) {
            return array("day" => true);
        } else {
            return array("day" => false);
        }
    }
}
