<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return view('Auth/Homepage');
});
Route::controller(LoginController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::get('/login', 'login')->name('login');
    Route::get('/save', 'save')->name('save');
 

    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/fetch-states/{id}',[LoginController::class,'fetchStates']);
    Route::post('/fetch-cities/{id}',[LoginController::class,'fetchCities']);

});
