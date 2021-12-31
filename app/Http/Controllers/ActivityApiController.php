<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        // TODO: fetch from soap db

        $dateTime = strtotime("2022-04-12T14:30:00");
        $activity = array([
            "id" => 0,
            "title" => "Zwemmen",
            "date" => date('d/m/Y', $dateTime),
            "time" => date('H\ui', $dateTime),
            "group" => "kapoenen",
            "description" => "Hopelijk is het warm weer",
        ]);
        return $activity;
    }
}
