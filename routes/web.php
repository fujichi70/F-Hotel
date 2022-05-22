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
});

Route::get('/reservation', [ReserveController::class, 'show'])->name('reservation');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/user', function () {
    return view('user');
});

Route::get('/calendar', [CalendarController::class, 'show'])->name('calendar');

// Route::get('/calendar', function() {
//     return view('calendar');
// });

require __DIR__.'/auth.php';
