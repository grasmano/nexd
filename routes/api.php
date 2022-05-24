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

Route::resource('campaigns',App\Http\Controllers\CampaignController::class)->only(['index','store']);
