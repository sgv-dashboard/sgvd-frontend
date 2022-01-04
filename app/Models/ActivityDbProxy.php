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
        $params = array("id" => $id);
        $response = $client->__soapcall('getActivityFromId', array($params));

        return array("activity" => $response->getActivityFromIdResult);
    }

    /**
     * Get a list of activities
     * 
     * @return array
     */
    public function getActivities()
    {
        $client = $this->getSoapClient();
        $params = array();
        $response = $client->__soapcall('getActivities', $params);

        return array("activities" => $response->getActivitiesResult->Activity);
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
