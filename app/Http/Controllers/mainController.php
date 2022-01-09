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

class mainController extends controller{
 
    
    public function start(){
        if(Auth::check()){
            $current_user = auth()->user();
            return view('main')->with("user", $current_user);
        }
        else {
            $fakeUser = new user();
            $fakeUser->name = "niet ingelogd";
            return view('main')->with("user", $fakeUser);
        }
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

    public function contact(){
        return view('contact');
    }

    public function thankyou(){
        return view('thankyou');
    }

    public function admin(){
        if(Auth::check() && auth()->user()->admin == "1"){
            return view('admin');
        }
        else {
            return redirect('start');
        }
    }
}
