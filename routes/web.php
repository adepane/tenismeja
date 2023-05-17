<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('/loginasuser', [AdminController::class, 'loginasuser']);
Route::get('/switchback', [AdminController::class, 'returnBackUser']);
Route::middleware(['auth', 'auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dash');
    Route::get('/{slug}', [AdminController::class, 'identify']);
    Route::get('/{slug}/{subslug}', [AdminController::class, 'identify']);
    Route::get('/{slug}/{subslug}/{data}', [AdminController::class, 'identify']);
});

Route::group(['prefix' => 'validate'], function () {
    Route::get('/userinfo', [AdminController::class, 'getusersinfo']);
    Route::get('/usercheck', [AdminController::class, 'userInfoEdit']);
});

require __DIR__.'/auth.php';
