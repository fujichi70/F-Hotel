<?php

use App\Http\Controllers\Admin\SettingController;
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

// 予約関連ルーティング
Route::group(['prefix' => 'reservation'], function() {
    Route::get('/', [ReserveController::class, 'index'])->name('reservation');
    Route::post('/', [ReserveController::class, 'selectDate']);
    // Route::post('show', [ReserveController::class, 'show'])->name('reservation.show');
    Route::get('room/{room_id}', [ReserveController::class, 'room']);
    Route::post('room/{room_id}', [ReserveController::class, 'selectDayRoom']);
    Route::post('confirm', [ReserveController::class, 'confirm'])->name('reservation.confirm');
    Route::post('store', [ReserveController::class, 'store'])->name('reservation.store')->middleware('throttle:3, 1');
    Route::post('complete', [ReserveController::class, 'complete'])->name('reservation.complete');
});

// 管理者関連ルーティング
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('admin.calendar', [SettingController::class, 'index'])->middleware(['auth'])->name('admin.calendar');
Route::post('admin.calendar', [SettingController::class, 'index'])->middleware(['auth']);
Route::post('admin.setting', [SettingController::class, 'update'])->middleware(['auth'])->name('admin.update');

Route::get('user', function () {
    return view('user');
})->name('user');

require __DIR__.'/auth.php';
