<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\Api\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin',function(){
return "<h1>admin</h1>";
})->middleware(['auth','verified','role|admin']);
