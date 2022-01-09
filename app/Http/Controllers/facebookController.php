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
                    'verified' => '1',
                    'admin' => '1',
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

            //Zoek de gebruiker in de databank
            $is_user = User::where('email', $user->getEmail())->first();

            //De user bestaat niet in de databank: maak nieuwe maar niet verified
            if(!$is_user){
                $saveUser = User::updateOrCreate([
                    'facebook_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'verified' => '0',
                    'admin' => '0',
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
                
                /*
                * Hier zou nog een popup message moeten komen zodat de user
                * weet dat hij een aanvraag tot verificatie heeft ingediend.
                */

                return redirect('/start');                
            }
            //De user bestaat wel: check verified
            else{
                //User verified
                if($is_user->isVerified()){
                    $saveUser = User::where('email',  $user->getEmail())->update([
                        'facebook_id' => $user->getId(),
                    ]);
                    $saveUser = User::where('email', $user->getEmail())->first();
                
                    Auth::loginUsingId($saveUser->id);

                    return redirect('/start');
                }
                //User nog niet verified
                else {
                    /*
                    * Hier zou nog een popup message moeten komen zodat 
                    * de user weet dat hij nog niet verified is.
                    */
                    return redirect('/start');
                }
            }

        } catch (\Throuwable $th) {
            throw $th;
        }
    }

    public function logOut(){
        Auth::logout();
        return redirect('/start');
    }
}
