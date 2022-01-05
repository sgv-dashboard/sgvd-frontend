<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\googleController;
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
Route::get('/over', [mainController::class, 'over']);
Route::get('/contact', [mainController::class, 'contact']);
Route::get('/thankyou', [mainController::class, 'thankyou']);

Route::get('/googleLogin', [googleController::class, 'loginWithGoogle']);
Route::get('/googleLogin/redirect', [googleController::class, 'redirectFromGoogle']);