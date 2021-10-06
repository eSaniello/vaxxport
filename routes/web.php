<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::resource('dashboard', DashboardController::class);
Route::resource('home', HomeController::class);
Route::resource('user', UserController::class);
Route::get('/make_admin/{id}', [UserController::class, 'make_admin'])->name('make_admin');
Route::resource('vaccine', VaccineController::class);
Route::resource('infection', InfectionController::class);
Route::get('/qr_code/{id}', [UserController::class, 'qr_code'])->name('qr_code');
