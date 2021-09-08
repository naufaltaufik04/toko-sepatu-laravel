<?php

use App\Http\Controllers\ShoeController;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/password/email', [AuthController::class, 'forgot']);
Route::post('/password/reset', [AuthController::class, 'reset']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/shoes', [ShoeController::class, 'index']);
    Route::post('/shoes', [ShoeController::class, 'store']);
    Route::get('/shoes/{type}', [ShoeController::class, 'show']);
    Route::put('/shoes/{type}', [ShoeController::class, 'update']);
    Route::delete('/shoes/{type}', [ShoeController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
