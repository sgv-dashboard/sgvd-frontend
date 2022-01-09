<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Activity db
Route::get('/activity', [ActivityApiController::class, "getActivities"]);
Route::get('/activity/upcoming', [ActivityApiController::class, "getUpcomingActivities"]);
Route::get('/activity/{id}', [ActivityApiController::class, "getActivityFromId"]);
Route::post('/activity', [ActivityApiController::class, "createActivity"]);

// Sunset api
Route::get('/sun/sunset/{date}/{lat}/{lon}', [SunsetController::class, "getSunset"]);
Route::get('/sun/sunrise/{date}/{lat}/{lon}', [SunsetController::class, "getSunrise"]);
Route::get('/sun/day/{date}/{lat}/{lon}', [SunsetController::class, "isDay"]);

// Users api
Route::get('/admin/users', [UserController::class, "getUsers"]);
