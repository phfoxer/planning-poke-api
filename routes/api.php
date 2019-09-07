<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['cors']], function () {
    Route::get("matchcode",function(){
        return rand(10000,99999);
    });
    /**
    * Module Match
    */
    Route::apiResource("match","\App\Modules\General\Match\Controllers\MatchController");
    /**
    * Module MatchPlayer
    */
    Route::apiResource("match_player","\App\Modules\General\MatchPlayer\Controllers\MatchPlayerController");
});