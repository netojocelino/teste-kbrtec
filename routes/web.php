<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminUserController;

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
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::resource('users', AdminUserController::class)->except([
        'show',
    ]);
});

Route::get('/login', [AdminUserController::class, 'login'])->name('login');
Route::post('/auth', [AdminUserController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AdminUserController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/reset-password', [AdminUserController::class, 'resetPassword'])->name('reset-password');
