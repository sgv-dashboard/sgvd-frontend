<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\main;
use App\Models\User;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\SOAP\GetLyricRequest;

use Auth;
use Hash;
use Socialite;
use Str;
use App\Users;

class mainController extends controller{
 
    
    public function start(){
        return view('main');
    }

    public function login(){
        return view('login');
    }

    public function activiteiten(){
        return view('activiteiten');
    }

    public function over(){
        return view('over');
    }

    public function contact(){
        return view('contact');
    }

    public function thankyou(){
        return view('thankyou');
    }

    public function github(){
        //Send the users request to Github

        return Socialite::driver('github')-> redirect();
    }

    public function githubRedirect(){
        //Get OAth requst back from Github

        $user = Socialite::driver('github') -> user();

        // If the user doesn't exist, create a new one
        // If the user exist, get their model
        // Authenticate the user into the application

        $user = User::firstOrCreate([
            'email' => $user -> email
        ], [
            'name' => $user -> name,
            'password' => Hash::make(Str::random(24))
        ]);

        Auth::login($user, true);

        return redirect('/start');
    }
}
