<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/register');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register.form');

    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});
