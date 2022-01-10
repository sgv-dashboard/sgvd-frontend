<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;

class RegistrationApiController extends Controller
{
    public function getUsersForActivity($activityId)
    {
        // get registered user id's for activity
        $users = [];
        $registrations = Registration::all()->where('activityId', $activityId);
        foreach ($registrations as $registration) {
            $user = User::all()->where('id', $registration->userId)->first();
            array_push($users, $user);
        }
        return $users;
    }
}
