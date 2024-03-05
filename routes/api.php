<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BuatLombaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PemenangLomba;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemenangJadwal;
use App\Http\Controllers\PemenangsController;







/*
|--------------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------------
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
Route::middleware([isLogin::class])->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:api')->get('/user', function(Request $request){
//     return $request->user();
// });

/**
 * route "/logout"
 * @method "POST"
 */


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', \App\Http\Controllers\Api\LogoutController::class)->name('logout');
});

// Route::middleware(['auth:api', 'role:admin'])->group(function () {
    
// });

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'showId']);
Route::delete('/users/destroy/{id}', [UserController::class, 'destroy']);

// Route::post('/pemenangjadwal',[PemenangJadwal::class,'store']);
Route::post('/pemenangsjadwal',[PemenangsController::class,'create']);

// // Route untuk lomba
// Route::post('/lomba/create', [LombaController::class, 'create'])->name('lomba.create');
// Route::get('/lomba/show', [LombaController::class, 'showAll'])->name('lomba.show');
// Route::get('/lomba/{id}', [LombaController::class, 'showId'])->name('lomba.showId');
// Route::put('/lomba/update/{id}', [LombaController::class, 'update']);
// Route::delete('/lomba/destroy/{id}', [LombaController::class, 'destroy']);



// Route untuk lomba
Route::post('/lomba/create', [LombaController::class, 'create'])->name('lomba.create');
Route::get('/lomba/show', [LombaController::class, 'showAll'])->name('lomba.show');
Route::get('/lomba/{id}', [LombaController::class, 'showId'])->name('lomba.showId');
Route::put('/lomba/update/{id}', [LombaController::class, 'update']);
Route::delete('/lomba/destroy/{id}', [LombaController::class, 'destroy']);

// Route untuk buat lomba
Route::post('/buat-lomba', [BuatLombaController::class, 'imageUpload']);
Route::get('/buat-lomba/show', [BuatLombaController::class, 'show'])->name('buatlomba.show');
Route::get('/buat-lomba/{id}', [BuatLombaController::class, 'showId'])->name('buatlomba.showId');


// Route untuk jadwal
Route::post('/jadwal/create', [JadwalController::class, 'create'])->name('lomba.create');
Route::get('/jadwal/show', [JadwalController::class, 'show'])->name('lomba.show');
Route::get('/jadwal/{id}', [JadwalController::class, 'showId'])->name('lomba.showId');
Route::put('/jadwal/update/{id}', [JadwalController::class, 'update']);
Route::delete('/jadwal/destroy/{id}', [JadwalController::class, 'destroy']);


//Profile
Route::post('/profile/create',[ProfileController::class,'store']);
Route::get('/profiles/{id}', [ProfileController::class,'show']);
Route::put('/profiles/{id}', [ProfileController::class,'update']);

// Route untuk menyimpan chat baru
Route::post('/chats', [ChatController::class, 'store']);
Route::get('/chats/message', [ChatController::class, 'getMessage']);
// Route untuk menghapus chat berdasarkan ID
Route::delete('/chats/{id}', [ChatController::class, 'delete']);

//Riiwayat 
// Route::get('/riwayat-daftar', [RiwayatDaftarController::class, 'index']);

//pemenang lomba 
Route::post('/pemenang-lomba', [PemenangLomba::class, 'emailUpload']);
Route::get('/lomba', [LombaController::class, 'getNamaLomba']);

