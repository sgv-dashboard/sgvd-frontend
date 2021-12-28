<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\main;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\SOAP\GetLyricRequest;

class activiteitenController extends controller{
 
    public function activiteiten(){
        return view('activiteiten');
    }
}