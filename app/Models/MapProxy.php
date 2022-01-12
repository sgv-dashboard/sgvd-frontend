<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapProxy extends Model
{
    /**
     * Get map
     * 
     * @param float $latS
     * @param float $lonS
     * @param float $latE
     * @param float $lonE
     * 
     * @return map
     */
    public function getMap($latS, $lonS, $latE, $lonE)
    {
        $key = config('url.mapkey');
        $baseUrl = config('url.map');

        $response = file_get_contents(sprintf('%s/map?key=%s&latS=%s&lonS=%s&latE=%s&lonE=%s', $baseUrl, $key, $latS, $lonS, $latE, $lonE));
        
        return json_decode($response);
    }
}
