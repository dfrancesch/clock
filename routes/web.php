<?php

use App\Http\Api\TimeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/list', [TimeController::class, 'getList'])->name('time_list');
Route::get('/hour/{hr}', [TimeController::class, 'getHour'])->name('hour_list');

/*
// Rutas públicas antiguas que redirigen a /admin
Route::get('/minute/{hr}/{mi}', function ($hr, $mi) {
    return redirect()->route('admin.minute', ['hr' => $hr, 'mi' => $mi]);
});

Route::get('/album', function () {
    return redirect()->route('admin.album');
});

// Redirección del endpoint público de mapa hacia la versión protegida en /admin
Route::get('/map', function () {
    return redirect()->route('admin.map');
})->name('map');
*/

// Sección de administración
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('/album', [TimeController::class, 'getAlbum'])->name('admin.album');
        Route::get('/hour/{hr}', [TimeController::class, 'getHour'])->name('admin.hour');
        Route::get('/minute/{hr}/{mi}', [TimeController::class, 'getMinute'])->name('admin.minute');
        Route::get('/map', [TimeController::class, 'getMap'])->name('admin.map');
    });
});

Route::get('/{tm?}', [TimeController::class, 'home'])->name('home');
