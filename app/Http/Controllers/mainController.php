<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\main;
use App\Models\User;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\SOAP\GetLyricRequest;
use Session;

use Auth;
use Hash;
use Socialite;
use Str;

class mainController extends controller
{

    /*
    * Return main view and display name when logged in
    */
    public function start()
    {
        if (Auth::check()) {
            $current_user = auth()->user();
            return view('main')->with("user", $current_user);
        } else {
            $fakeUser = new user();
            $fakeUser->name = "niet ingelogd";
            return view('main')->with("user", $fakeUser);
        }
    }

    /*
    * Go to the login page when user is nog logged in yet
    */
    public function login()
    {
        if (Auth::check()) {
            return redirect('start');
        } else {
            return view('login');
        }
    }

    /*
    * Go to the activity page when the user is logged in
    */
    public function activiteiten()
    {
        if (Auth::check()) {
            return view('activiteiten');
        } else {
            return redirect('login');
        }
    }

    /*
    * Go to the contact page
    */
    public function contact()
    {
        return view('contact');
    }

    /*
    * Go to the thank you page
    */
    public function thankyou()
    {
        return view('thankyou');
    }

    /*
    * Go to the admin page when the user is logged in and has admin rights
    */
    public function admin()
    {
        if (Auth::check() && auth()->user()->admin == "1") {
            return view('admin');
        } else {
            return redirect('start');
        }
    }

    /*
    * Go to the registrations page when the user is logged in hand has admin rights
    */
    public function registrations()
    {
        if (Auth::check() && auth()->user()->admin == "1") {
            return view('registrations');
        } else {
            return redirect('start');
        }
    }

    public function registerForActivity($activityId)
    {
        if (Auth::check()) {
            $userId = auth()->user()->id;
            return $userId;
        } else {
            return Response(array(
                'Error' => 'Not authorized',
            ), 403);
        }
    }
}
