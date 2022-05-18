<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CreativeController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('api')->group(function () {
    Route::resource('campaigns', CampaignController::class);
});

Route::middleware('api')->group(function () {
    Route::resource('creatives', CreativeController::class);
});

//Route::resource('campaign',App\Http\Controllers\CampaignController::class)->only(['index','store','show','update','destroy']);
//
//
//Route::get('posts', 'PostController@index');
//Route::group(['prefix' => 'post'], function () {
//    Route::post('add', 'PostController@add');
//    Route::get('edit/{id}', 'PostController@edit');
//    Route::post('update/{id}', 'PostController@update');
//    Route::delete('delete/{id}', 'PostController@delete');
//});