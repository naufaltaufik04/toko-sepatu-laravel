<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index']);
Route::get('/login', [PageController::class, 'index']);
Route::post('/login', [PageController::class, 'login']);
Route::get('/register', [PageController::class, 'register']);
Route::view('forgot_password', 'reset_password');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [PageController::class, 'home']);
    Route::get('/logout', [PageController::class, 'logout']);
    Route::get('/details/{type}', [PageController::class, 'details']);
});
