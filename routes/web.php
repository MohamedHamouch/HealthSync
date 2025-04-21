<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard-client', function () {
    return view('client.dashboard');
})->name('client.dashboard');

Route::get('/dashboard-doctor', function () {
    return view('doctor.dashboard');
})->name('doctor.dashboard');

Route::get('/dashboard-admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
