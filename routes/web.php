<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDataRatingController;
use App\Http\Controllers\RatingController;

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

Route::get('/', [UsersController::class, 'landing']);

Route::get('/admin/login', [AdminController::class, 'loginIndex']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::post('/admin/login/process', [AdminController::class, 'loginProcess']);

Route::get('/admin/logout', [AdminController::class, 'logout']);

Route::get('/datahotel', function () {
    return view('admin.data_hotel');
});

//Admin Data Hotel
Route::get('/datahotel',[HotelController::class, 'index']);
Route::get('/datahotel/tambah',[HotelController::class, 'tambah']);
Route::post('/datahotel/store',[HotelController::class, 'store']);
Route::get('/datahotel/edit/{id_hotel}',[HotelController::class, 'edit']);
Route::get('/datahotel/hapus/{id_hotel}',[HotelController::class, 'hapus']);
Route::get('/datahotel/search',[HotelController::class, 'search']);
Route::post('/datahotel/update',[HotelController::class, 'update']);
//Admin Data User
Route::get('/datauser',[UsersController::class, 'index']);
Route::get('/datauser/search',[UsersController::class, 'search']);
Route::get('/login', [UsersController::class, 'loginIndex']);
// Route::post('/algoritma/test', [RatingController::class, 'recArroundHotel']);
//Admin Data Rating
Route::get('/datarating',[AdminDataRatingController::class, 'index']);
Route::get('/datarating/search',[AdminDataRatingController::class, 'search']);

//USER
Route::get('/user/login', [UsersController::class, 'loginIndex']);
Route::post('/user/login/process', [UsersController::class, 'loginProcess']);
Route::get('/user/logout', [UsersController::class, 'logout']);
Route::get('/user/home', [UsersController::class, 'home']);
Route::get('/user/registrasi', [UsersController::class, 'regisIndex']);
Route::post('/user/simpanregistrasi', [UsersController::class, 'regisSave']);


Route::get('/user/rating', [UsersController::class, 'rating']);
Route::get('/user/hotel/{idHotel}', [UsersController::class, 'detailHotel']);
Route::get('/user/riwayat', [UsersController::class, 'riwayatRating']);
Route::post('/user/rating/add', [UsersController::class, 'addRating']);
