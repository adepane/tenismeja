<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Core\Core;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::any('logout', [AuthController::class, 'logout']);
    // Route::get('user', function(Request $request) {
    //     return $request->user();
    // });
});
Route::middleware('auth:sanctum')->get('/getmenu', [Core::class, 'getLeftMenu'])->name('menu');
Route::middleware('auth:sanctum')->any('/{slug}/{action}', [AdminController::class, 'getModuleController']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
