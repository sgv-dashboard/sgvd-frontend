<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class UserController extends Controller
{
    /*
    * Get all the users from the database
    */
    public function getUsers()
    {
        $users = User::all();

        return $users;
    }
     
    /*
    * Update user rights
    */
    public function updateDb($id, $new_admin, $new_verified)
    {
        User::where("id", $id)->update(['admin' => $new_admin]);
        User::where("id", $id)->update(['verified' => $new_verified]);  

        return "Done";
    }
}

