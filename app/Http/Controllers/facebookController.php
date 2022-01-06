<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Auth;
use Hash;
use Str;

class facebookController extends controller{
    
    public function loginWithFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    /*
    //Gebruik deze functie als je jezelf wilt toevoegen aan de database
    public function redirectFromFacebook(){
        try {
            $user = Socialite::driver('facebook')->user();

            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'facebook_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'facebook_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }

            Auth::loginUsingId($saveUser->id);

            return redirect('/start');

        } catch (\Throuwable $th) {
            throw $th;
        }
    }
    */

    //Gebruik deze functie als je alleen al eerder ingelogde gebruikers wilt laten inloggen
    public function redirectFromFacebook(){
        try {
            $user = Socialite::driver('facebook')->user();

            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){
                return redirect('/start');                
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'facebook_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }

            Auth::loginUsingId($saveUser->id);

            return redirect('/start');
        } catch (\Throuwable $th) {
            throw $th;
        }
    }

    public function logOut(){
        Auth::logout();
        return redirect('/start');
    }
}
