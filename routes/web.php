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



Route::get('/', [MainController::class,'index'])->name('index');
Route::get('/get-prayers',[PrayerController::class,'getPrayers'])->name('get-prayers');


Route::group(['middleware' => ['auth']], function () {  
    Route::post('/add-lead-pray',[PrayerController::class,'addLeadPray'])->name('add-lead-pray');
    Route::post('/add-lead-pray-by-imam',[PrayerController::class,'addLeadPrayByImam'])->name('add-lead-pray-by-imam'); 
    Route::post('/remove-lead-pray',[PrayerController::class,'removeLeadPray'])->name('remove-lead-pray');
    Route::get('/profile',[MainController::class,'profile'])->name('profile');
    Route::post('/save-profile',[MainController::class,'saveProfile'])->name('save-profile');
 });


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'isadmin']], function () {  
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('imam', App\Http\Controllers\Admin\UserController::class);
    Route::resource('admin', App\Http\Controllers\Admin\AdminController::class);
 });
