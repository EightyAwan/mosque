<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PrayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();



Route::get('/', [MainController::class,'index']);
Route::get('/get-prayers',[PrayerController::class,'getPrayers'])->name('get-prayers');
Route::post('/add-lead-pray',[PrayerController::class,'addLeadPray'])->name('add-lead-pray');

Route::group(['prefix' => 'admin'], function () {  
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
 });
