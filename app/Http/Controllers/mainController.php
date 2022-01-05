<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\main;
use App\Models\User;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\SOAP\GetLyricRequest;
//use Illuminate\Support\Facades\Auth;

use Auth;
use Hash;
use Socialite;
use Str;

class mainController extends controller{
 
    
    public function start(){
        return view('main');
    }

    public function login(){
        if(Auth::check()){
            return redirect('start');
        }
        else {
            return view('login');
        }
    }

    public function activiteiten(){
        if (Auth::check()) {
            return view('activiteiten');
        }
        else {
            return redirect('login');
        }
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
}
