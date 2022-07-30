<?php

use App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function () {
    return view('index');
})->name('top');

// 予約関連ルーティング
Route::group(['prefix' => 'reservation'], function () {
    Route::get('/', [ReserveController::class, 'index'])->name('reservation');
    Route::post('/', [ReserveController::class, 'selectDate']);
    Route::get('confirm', function() {
        return view('room');
    });
    Route::post('confirm', [ReserveController::class, 'confirm'])->name('reservation.confirm');
    Route::get('room/{room_id}', [ReserveController::class, 'selectRoom']);
    Route::post('room/{room_id}', [ReserveController::class, 'selectRoom']);
    Route::post('store', [ReserveController::class, 'store'])->name('reservation.store')->middleware('throttle:3, 1');
    Route::post('complete', [ReserveController::class, 'complete'])->name('reservation.complete');
});

// 管理者関連ルーティング
Route::resource('admin', AdminController::class)
->middleware('auth')->except(['show']);

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::post('setting', [SettingController::class, 'update'])->name('admin.update');
    Route::get('calendar', [SettingController::class, 'show'])->name('admin.calendar');
    Route::get('checkreserves', [SettingController::class, 'checkreserves'])->name('admin.checkreserves');
});

Route::get('user', function () {
    return view('user');
})->name('user');

require __DIR__ . '/auth.php';
