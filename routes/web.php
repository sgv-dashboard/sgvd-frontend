<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\googleController;
use App\Http\Controllers\facebookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeatherApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/start', [mainController::class, 'start']);
Route::get('/login', [mainController::class, 'login']);
Route::get('/activiteiten', [mainController::class, 'activiteiten']);
Route::get('/admin', [mainController::class, 'admin']);
Route::get('/registrations', [mainController::class, 'registrations']);
Route::get('/contact', [mainController::class, 'contact']);
Route::get('/thankyou', [mainController::class, 'thankyou']);

Route::get('/googleLogin', [googleController::class, 'loginWithGoogle']);
Route::get('/googleLogin/redirect', [googleController::class, 'redirectFromGoogle']);
Route::get('/googleLogOut', [googleController::class, 'logOut']);

Route::get('/facebookLogin', [facebookController::class, 'loginWithFacebook']);
Route::get('/facebookLogin/redirect', [facebookController::class, 'redirectFromFacebook']);
Route::get('/facebookLogOut', [facebookController::class, 'logOut']);