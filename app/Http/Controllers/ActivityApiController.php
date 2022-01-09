<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\ActivityDbProxy;
use DateTime;

class ActivityApiController extends Controller
{
    /**
     * Get the data of an activity from id
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function getActivityFromId($id)
    {
        // Fetch from soap db
        $db = new ActivityDbProxy();
        $activity = $db->getActivityFromId($id);

        return $activity;
    }

    /**
     * Get a list of activities
     * 
     * @return \Illuminate\Http\Response
     */
    public function getActivities()
    {
        $db = new ActivityDbProxy();
        $activities = $db->getActivities();

        return $activities;
    }

    /**
     * Get a list of upcoming activities
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUpcomingActivities()
    {
        $db = new ActivityDbProxy();
        $activities = $db->getActivitiesSince(date("Y-m-d"));
        return $activities;
    }

    /**
     * Handle POST of new activity
     */
    public function createActivity(Request $request)
    {
        /*
        $activity = array(
            "title" => "Bosspel",
            "location" => "51.03751N, 5.29919E",
            "group" => "kawellen",
            "description" => "Bosspel aan de dikke beuk",
            "dateTime" => "2022-01-14T14:00:00",
            "id" => null,
        );*/
        $activity = array(
            'title' => $request->title,
            'location' => $request->location,
            'group' => $request->group,
            'description' => $request->description,
            'dateTime' => $request->dateTime,
        );
        $db = new ActivityDbProxy();
        $response = $db->addActivity($activity);

        return $response;
    }
}
