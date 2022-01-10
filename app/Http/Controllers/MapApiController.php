<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MapProxy;

class MapApiController extends Controller
{
    /**
     * Get map
     * 
     * @param float $latS
     * @param float $lonS
     * @param float $latE
     * @param float $lonE
     * 
     * @return \Illuminate\Http\Response
     */
    public function getMap($latS, $lonS, $latE, $lonE)
    {
        $map = (new MapProxy())->getMap($latS, $lonS, $latE, $lonE);
        return $map;
    }
}
