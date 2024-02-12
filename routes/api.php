<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\JadwalController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});

/**
 * route "/logout"
 * @method "POST"
 */

Route::group(['middleware' => 'auth:api'],function(){
    Route::post('/logout', \App\Http\Controllers\Api\LogoutController::class)->name('logout');

});

//route lomba
Route::post('/lomba/create', [LombaController::class, 'create'])->name('lomba.create');
Route::get('/lomba/show',[LombaController::class, 'show'])->name('lomba.show');
Route::get('/lomba/{id}', [LombaController::class, 'showId'])->name('lomba.showId');
Route::put('/lomba/update/{id}', [LombaController::class, 'update']);
Route::delete('/lomba/destroy/{id}', [LombaController::class, 'destroy']);


//route jadwal
Route::post('/jadwal/create', [JadwalController::class, 'create'])->name('lomba.create');
Route::get('/jadwal/show',[JadwalController::class, 'show'])->name('lomba.show');
Route::get('/jadwal/{id}', [LombaController::class, 'showId'])->name('lomba.showId');
Route::put('/jadwal/update/{id}', [LombaController::class, 'update']);
Route::delete('/jadwal/destroy/{id}', [LombaController::class, 'destroy']);