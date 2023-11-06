<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AdminChampionshipController;
// use App\Http\Controllers\AthleteDashboardController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/torneios', [HomeController::class, 'championships'])->name('home.championships');
Route::get('/torneios/{championship}', [HomeController::class, 'showChampionship'])->name('home.championships.show');
Route::get('/torneios/{championship}/listagem', [HomeController::class, 'showChampionshipPhases'])->name('home.championships.phases');
Route::get('/torneios/{championship}/listagem/{belt}/{weight}/{gender}', [HomeController::class, 'showChampionshipPhasesDetails'])->name('home.championships.view');
Route::get('/torneios/{championship}/registrar', [HomeController::class, 'registerChampionship'])->name('home.championships.create');
Route::post('/torneios/{championship}/registrar', [HomeController::class, 'storeChampionship'])->name('home.championships.store');

Route::resource('home', HomeController::class)->names('home');

Route::middleware('auth')->prefix('admin')->group(function ($routes) {
    Route::get('/', [AdminUserController::class, 'index'])->name('admin.index');

    Route::resource('users', AdminUserController::class)->except(['show',])->names('admin.users');
    Route::resource('championships', AdminChampionshipController::class)->names('admin.championship')
        ->where([
            'championship' => '[0-9]+'
        ]);

    Route::prefix('championships/features')->group(function ($route) {
        Route::get('/', [AdminChampionshipController::class, 'listFeatures'])->name('admin.championship.features.index');
        Route::put('/{championship}', [AdminChampionshipController::class, 'updateFeatures'])->name('admin.championship.features.update');
    });

    Route::prefix('championships/event')->group(function ($route) {
        Route::put('/{championship}', [AdminChampionshipController::class, 'markAsGroupPhase'])->name('admin.championship.events.group');
        Route::put('/{championship}/finish', [AdminChampionshipController::class, 'markAsFinished'])->name('admin.championship.events.finish');
        Route::put('/{championship}/winner/{athlete_id}', [AdminChampionshipController::class, 'markWinner'])->name('admin.championship.event.mark-winner');
    });

    Route::get('/logout', [AdminUserController::class, 'logout'])->name('logout');
    Route::get('/profile', [AdminUserController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminUserController::class, 'postProfile'])->name('profile.save');
});

Route::get('/login', [AdminUserController::class, 'login'])->name('login');
Route::post('/auth', [AdminUserController::class, 'authenticate'])->name('authenticate');


Route::get('/reset-password', [AdminUserController::class, 'resetPassword'])->name('reset-password');
Route::post('/request-password', [AdminUserController::class, 'requestPassword'])->name('request-new-password');
Route::get('/reset-password/{token}', [AdminUserController::class, 'getResetPassword'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AdminUserController::class, 'postResetPassord'])->name('update.reset-password');

Route::prefix('/athletes')->group(function ($route) {
    Route::get('/login', [AthleteDashboardController::class, 'login'])->name('athlete.login');
});
Route::get('/download-csv/{championship_id}', [AdminChampionshipController::class, 'downloadCsv'])->name('download.csv');
