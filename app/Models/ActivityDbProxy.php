<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SoapClient;

class ActivityDbProxy extends Model
{
    // SOURCE: https://stackoverflow.com/questions/11593623/how-to-make-a-php-soap-call-using-the-soapclient-class
    use HasFactory;

    /**
     * Get the data of an activity from id
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getActivityFromId($id)
    {
        $client = $this->getSoapClient();
        $params = array("id" => $id,);
        $response = $client->__soapcall('getActivityFromId', array($params));

        return $this->soapResponseToActivity($response, 'getActivityFromId');
    }

    /**
     * Convert response to activity array
     * 
     * @return array
     */
    private function soapResponseToActivity($response, $soapMethod)
    {
        $dateTime = strtotime($response->{$soapMethod . 'Result'}->dateTime);
        $activity = array([
            "id" => $response->{$soapMethod . 'Result'}->id,
            "title" => $response->{$soapMethod . 'Result'}->title,
            "date" => date('d/m/Y', $dateTime),
            "time" => date('H\ui', $dateTime),
            "group" => $response->{$soapMethod . 'Result'}->group,
            "description" => $response->{$soapMethod . 'Result'}->description,
        ]);
        return $activity;
    }

    /**
     * Get the soap client
     * 
     * @return SoapClient
     */
    private function getSoapClient()
    {
        return new SoapClient(config('soap.url'));
    }
}
