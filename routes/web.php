<?php

use App\Http\Api\TimeController;
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

Route::get('/list', [TimeController::class, 'getList'] )->name('time_list');
Route::get('/hour/{hr}', [TimeController::class, 'getHour'] )->name('hour_list');
Route::get('/minute/{hr}/{mi}', [TimeController::class, 'getMinute'] )->name('minute_list');

Route::get('/album', [TimeController::class, 'getAlbum'] )->name('time_list');


Route::get('/{tm?}', [TimeController::class, 'home'])->name('home');
