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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);

Route::resource('rides', RideController::class)->except([
    'index', 'create', 'store', 'show', 'update', 'destroy'
]);
Route::get('rides', [RideController::class, 'index']);
Route::post('rides', [RideController::class, 'store']);
Route::post('rides/create', [RideController::class, 'create']);
Route::get('rides/{ride}', [RideController::class, 'show']);
Route::put('rides/{ride}', [RideController::class, 'update']);
Route::delete('rides/{ride}', [RideController::class, 'destroy']);
Route::post('/rides/reservar', [RideController::class, 'reservar']);


Route::resource('users', UserController::class)->except([
    'index', 'create', 'store', 'show', 'update', 'destroy'
]);
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::post('users/create', [UserController::class, 'create']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/{id}', [UserController::class, 'edit']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

Route::get('/messages/{senderId}/{receiverId}', [MessageController::class, 'getMessages']);
Route::post('/messages/{senderId}/{receiverId}', [MessageController::class, 'sendMessage']);
Route::get('/conversations', [MessageController::class, 'getConversations']);