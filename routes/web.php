<?php

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

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('mahasiswas.dashboard');



//route resource
Route::resource('/mahasiswas', \App\Http\Controllers\MahasiswaController::class);
Route::get('/dashboard', 'MahasiswaController@dashboard')->name('mahasiswas.dashboard');


