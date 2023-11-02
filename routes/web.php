<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AdminChampionshipController;

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
    return redirect()->route('login');
});


Route::middleware('auth')->prefix('admin')->group(function ($routes) {
    Route::get('/', [AdminUserController::class, 'index'])->name('admin.index');

    Route::resource('users', AdminUserController::class)->except(['show',])->names('admin.users');
    Route::resource('championships', AdminChampionshipController::class)->names('admin.championship');
});

Route::get('/login', [AdminUserController::class, 'login'])->name('login');
Route::post('/auth', [AdminUserController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AdminUserController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/reset-password', [AdminUserController::class, 'resetPassword'])->name('reset-password');
Route::post('/request-password', [AdminUserController::class, 'requestPassword'])->name('request-new-password');
Route::get('/reset-password/{token}', [AdminUserController::class, 'getResetPassword'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AdminUserController::class, 'postResetPassord'])->name('update.reset-password');
