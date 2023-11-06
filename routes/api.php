<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/states/{state}', function (int $state) {
    $cities =  \App\Models\City::where('state_id', $state)
        ->orderBy('name', 'asc')->get([
            'id',
            'name',
        ]);
    return response()->json($cities);
})->name('api.list-cities-from-state');
