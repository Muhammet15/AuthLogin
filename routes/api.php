<?php

use App\Http\Controllers\LoginController;
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
Route::post('/register',[LoginController::class, 'register']);
Route::post('/login',[LoginController::class, 'login']);

Route::group(['middleware'=>'auth:api'],function(){
    Route::post('profile-details',[LoginController::class, 'userDetails']);
    Route::post('/logout',[LoginController::class, 'logout']);
});
Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user()->all();
});

