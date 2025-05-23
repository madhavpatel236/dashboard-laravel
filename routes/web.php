<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\authMiddleware;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('pages.Login');
})->name('loginPage_route')->middleware(authMiddleware::class);

// Route::post('/login/check', [AuthController::class, 'authentication'])->name('loginAuth')->middleware(authMiddleware::class);
Route::post('/login/check', [AuthController::class, 'authentication'])->name('loginAuth');
// Route::get('/adminHome', [AdminController::class, 'index'])->name('adminHome_route');
// Route::post('/userHome', [UserController::class, 'show'])->name('userHome_route');

// Route::resource('/', AuthController::class);

Route::post('/', [AuthController::class, 'logoutUser'])->name('logout_route');
Route::resource('/userHome', UserController::class);
Route::resource('/admin', AdminController::class);
// Route::post('/check', [AdminController::class, 'check']);
// Route::post('/check', function (AdminController $admin) {
//     $admin->check();
// });
// Route::post('/check', 'AdminController@check');
// Route::get('/check', [AdminController::class, 'check']);

// Route::post('/delete_user' )->name('delete_user_route');


// Route::get('/test', function(){
//     return view('templates.home_template');
// });
