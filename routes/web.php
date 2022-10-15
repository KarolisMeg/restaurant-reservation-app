<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantController;
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
Route::get('/', [ReservationController::class, 'index'])->name('reservation');
Route::post('/reservation', [ReservationController::class, 'store'])->name('make-reservation');
Route::get('/reservation-success/{uuid}', [ReservationController::class, 'success'])->name('reservation-success');
Route::get('/admin', [RestaurantController::class, 'index'])->name('admin');
Route::get('/admin/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurant');
