<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Auth;
use Hash;
use Str;

class facebookController extends controller{
    
    /*
    * Get SSO to login with Facebook
    */
    public function loginWithFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    /*
    * Handle the redirection from Facebook
    */
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
                    'verified' => '0',
                    'admin' => '0',
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);

                return redirect('/start');                
            }
            else{
                if($is_user->isVerified()){
                    $saveUser = User::where('email',  $user->getEmail())->update([
                        'facebook_id' => $user->getId(),
                    ]);
                    $saveUser = User::where('email', $user->getEmail())->first();
                
                    Auth::loginUsingId($saveUser->id);

                    return redirect('/start');
                }
                else {
                    return redirect('/start');
                }
            }

        } catch (\Throuwable $th) {
            throw $th;
        }
    }

    /*
    * Logout
    */
    public function logOut(){
        Auth::logout();
        return redirect('/start');
    }
}