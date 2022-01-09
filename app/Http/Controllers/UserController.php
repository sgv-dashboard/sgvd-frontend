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
     
    public function updateDb($id, $new_admin, $new_verified)
    {
        User::where("id", $id)->update(['admin' => $new_admin]);
        User::where("id", $id)->update(['verified' => $new_verified]);  

        return "Done";
    }
}

