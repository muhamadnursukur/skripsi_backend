<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PresenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
Route::get('logout',[AuthController::class,'logout'])->middleware('jwtAuth');
Route::post('update',[AuthController::class,'updateUser']);

Route::get('presence',[PresenceController::class,'presence'])->middleware('jwtAuth');
Route::post('presence/create',[PresenceController::class,'create'])->middleware('jwtAuth');