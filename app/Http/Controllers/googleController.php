<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Auth;
use Hash;
use Str;

class googleController extends controller{
    
    public function loginWithGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function redirectFromGoogle(){
        try {
            $user = Socialite::driver('google')->user();

            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }

            Auth::loginUsingId($saveUser->id);

            //dd($saveUser); 

            return redirect('/start');

        } catch (\Throuwable $th) {
            throw $th;
        }
    }
}
