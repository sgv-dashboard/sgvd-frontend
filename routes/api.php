<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityApiController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\RegistrationApiController;
use App\Http\Controllers\SunsetController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Activity db
Route::get('/activity', [ActivityApiController::class, "getActivities"]);
Route::get('/activity/upcoming', [ActivityApiController::class, "getUpcomingActivities"]);
Route::get('/activity/{id}', [ActivityApiController::class, "getActivityFromId"]);
Route::post('/activity', [ActivityApiController::class, "createActivity"]);
Route::delete('/activity/{id}', [ActivityApiController::class, "deleteActivity"]);

// Sunset api
Route::get('/sun/sunset/{date}/{lat}/{lon}', [SunsetController::class, "getSunset"]);
Route::get('/sun/sunrise/{date}/{lat}/{lon}', [SunsetController::class, "getSunrise"]);
Route::get('/sun/day/{date}/{lat}/{lon}', [SunsetController::class, "isDay"]);

// Users api
Route::get('/admin/users', [UserController::class, "getUsers"]);
Route::post('/admin/users/update', [UserController::class, 'updateUser']);

// Registrations
Route::get('/registrations/activity/{id}', [RegistrationApiController::class, "getUsersForActivity"]);
//Route::get('/register/activity/{Id}', [RegistrationApiController::class, "registerForActivity"]);
