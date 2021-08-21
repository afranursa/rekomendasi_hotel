<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;

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
Route::post('/hotel-in-city', [RatingController::class, 'hotelInCity']);
Route::post('/own-rated-hotel', [RatingController::class, 'ownRatedHotel']);
Route::post('/showother', [RatingController::class, 'showOther']);
Route::post('/hotel-rec', [RatingController::class, 'newAlgorithm']);
Route::post('/search-hotel', [RatingController::class, 'searchHotel']);
