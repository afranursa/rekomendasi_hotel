<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HotelController;


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
    return view('admin.dashboard');
});
Route::get('/datahotel', function () {
    return view('admin.data_hotel');
});
Route::get('/user', function () {
    return view('user.master');
});
//Admin Data Hotel
Route::get('/datahotel',[HotelController::class, 'index']);
Route::get('/datahotel/tambah',[HotelController::class, 'tambah']);
Route::post('/datahotel/store',[HotelController::class, 'store']);
Route::get('/datahotel/edit/{id_hotel}',[HotelController::class, 'edit']);
Route::get('/datahotel/hapus/{id_hotel}',[HotelController::class, 'hapus']);
Route::post('/datahotel/update',[HotelController::class, 'update']);



Route::get('/login', [UsersController::class, 'loginIndex']);
