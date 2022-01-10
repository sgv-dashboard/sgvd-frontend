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
        $response = $client->__soapcall('getActivities', array($params));

        return array("activities" => $response->getActivitiesResult->Activity);
    }

    /**
     * Get a list of activities since a specified date
     * 
     * @return array
     */
    public function getActivitiesSince($date)
    {
        $client = $this->getSoapClient();
        $params = array("date" => $date);
        $response = $client->__soapcall('getActivitiesFromDate', array($params));

        return array("activities" => $response->getActivitiesFromDateResult->Activity);
    }

    /**
     * Add activity
     */
    public function addActivity($activity)
    {
        $client = $this->getSoapClient();

        $params = array("a" => $activity);
        $response = $client->__soapcall('addActivity', array($params));

        return array("activity" => $response->addActivityResult);
    }

    /**
     * Delete activity
     */

    public function deleteActivity($id)
    {
        $client = $this->getSoapClient();

        $params = array("id" => $id);
        $response = $client->__soapcall('deleteActivityFromId', array($params));

        return array("activity" => $response->deleteActivityFromIdResult);
    }

    /**
     * Get the soap client
     * 
     * @return SoapClient
     */
    private function getSoapClient()
    {
        return new SoapClient(config('url.soap'), array('cache_wsdl' => WSDL_CACHE_NONE));
    }
}
