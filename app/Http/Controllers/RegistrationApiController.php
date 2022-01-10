<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

    public function registerForActivity($activityId, $status)
    {
        if (Auth::check()) {
            $userId = auth()->user()->id;
            if ($status) {
                DB::table('registrations')->insert([
                    'userId' => $userId,
                    'activityId' => $activityId,
                ]);
                return array(
                    'registration' => [
                        'activityId' => $activityId,
                        'userId' => $userId,
                    ],
                    'action' => 'created',
                );
            } else {
                $registrations = DB::table('registrations')->get()->where('userId', $userId)->where('activityId', $activityId);
                foreach ($registrations as $reg) {
                    DB::table('registrations')->delete($reg->id);
                }
                return array(
                    'registration' => [
                        'activityId' => $activityId,
                        'userId' => $userId,
                    ],
                    'action' => 'removed',
                );
            }
        } else {
            return Response(array(
                'Error' => 'Not authorized',
            ), 403);
        }
    }

    public function isRegisteredForActivity($activityId)
    {
        if (Auth::check()) {
            $userId = auth()->user()->id;
            $registrations = DB::table('registrations')->get()->where('userId', $userId)->where('activityId', $activityId);
            //var_dump($registrations);
            if ($registrations->isEmpty()) {
                return array(
                    'registered' => false,
                );
            } else {
                return array(
                    'registered' => true,
                );
            }
        } else {
            return Response(array(
                'Error' => 'Not authorized',
            ), 403);
        }
    }
}
