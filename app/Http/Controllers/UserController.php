<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers()
    {
        // Fetch from phpmyadmin
        $users = User::all();

        return $users;
    }

    public function updateUser($user){
        dd($user);
    }





    public function ajaxRequest()
    {
        console.log("Dit werkt!! (ajaxRequest)");
        return view('ajaxRequest');
    }
     
    public function ajaxRequestPost(Request $request)
    {
        console.log("Dit werkt ook!! (ajaxRequestPost)");
        $input = $request->all();
          
        Log::info($input);
     
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
