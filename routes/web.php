<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::redirect('/', '/login');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('pages.Login');
});

Route::post('/login/check', [AuthController::class, 'authentication'])->name('loginAuth');
