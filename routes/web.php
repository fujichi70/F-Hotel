<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReserveController;
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

Route::get('/', function() {
    return view('index');
})->name('top');

Route::group(['prefix' => 'reservation'], function() {
    Route::get('/', [ReserveController::class, 'index'])->name('reservation');
    Route::get('standard', [ReserveController::class, 'standard'])->name('standard');
    Route::get('double', [ReserveController::class, 'double'])->name('double');
    Route::get('singledelux', [ReserveController::class, 'singledelux'])->name('singledelux');
    Route::get('semidoubledelux', [ReserveController::class, 'semidoubledelux'])->name('semidoubledelux');
    Route::get('doubledelux', [ReserveController::class, 'doubledelux'])->name('doubledelux');
    Route::get('highfloor', [ReserveController::class, 'highfloor'])->name('highfloor');
    Route::post('confirm', [ReserveController::class, 'confirm'])->name('reservation.confirm');
    Route::post('store', [ReserveController::class, 'store'])->name('reservation.store')->middleware('throttle:3, 1');
    Route::post('complete', [ReserveController::class, 'complete'])->name('reservation.complete');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/user', function () {
    return view('user');
});

require __DIR__.'/auth.php';
