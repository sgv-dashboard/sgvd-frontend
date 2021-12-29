<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\main;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\SOAP\GetLyricRequest;

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
}
