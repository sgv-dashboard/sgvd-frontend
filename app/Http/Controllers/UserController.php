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

    public function updateUser(Request $request)
    {
        User::where("id", $request->id)->update(['admin' => $request->admin]);
        User::where("id", $request->id)->update(['verified' => $request->verified]);
    }
}
