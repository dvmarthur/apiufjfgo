<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserController;

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
Route::post('/users', [UserController::class, 'create']);
Route::get('/getusers', [UserController::class, 'index']);


Route::post('/ridecreate', [RideController::class, 'create']);
Route::get('/getriders', [RideController::class, 'index']);

Route::post('/ridereservar', [RideController::class, 'reservar']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('rides', RideController::class);
//Route::resource('users', UserController::class);

Route::get('/messages', [MessageController::class, 'index']);
Route::post('/messages', [MessageController::class, 'store']);