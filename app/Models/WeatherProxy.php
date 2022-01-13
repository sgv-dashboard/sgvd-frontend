<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SoapClient;

class WeatherProxy extends Model
{
    use HasFactory;

    /**
     * Get the soap client
     * 
     * @return SoapClient
     */
    private function getSoapClient()
    {
        return new SoapClient(config('url.soapWeather'), array('cache_wsdl' => WSDL_CACHE_NONE));
    }

    /**
     * Get weather info
     * 
     * @param float $temperature
     * @param int $rainChance
     * 
     * @return weather info
     */
    public function getWeatherInfo($temperature, $rainChance){
        $client = $this->getSoapClient();

        $params = array("temperature" => $temperature, "rainChance" => $rainChance);
        $response = $client->__soapcall('getInfo', array($params));

        return $response;
    }

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
        $key = config('url.weatherkey');
        $baseUrl = config('url.weather');

        $response = file_get_contents(sprintf('%skey=%s&locatie=%s,%s`', $baseUrl, $key, $lat, $lon));
        
        return json_decode($response);
    }
}
