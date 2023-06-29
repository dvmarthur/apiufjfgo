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

Route::resource('rides', RideController::class)->except([
    'index', 'create', 'store', 'show', 'update', 'destroy'
]);
Route::get('rides', [RideController::class, 'index'])->name('rides.index');
Route::post('rides', [RideController::class, 'store'])->name('rides.store');
Route::get('rides/create', [RideController::class, 'create'])->name('rides.create');
Route::get('rides/{ride}', [RideController::class, 'show'])->name('rides.show');
Route::put('rides/{ride}', [RideController::class, 'update'])->name('rides.update');
Route::delete('rides/{ride}', [RideController::class, 'destroy'])->name('rides.destroy');
Route::post('/rides/reservar', [RideController::class, 'reservar'])->name('reservar');


Route::resource('users', UserController::class)->except([
    'index', 'create', 'store', 'show', 'update', 'destroy'
]);
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users', [UserController::class, 'store'])->name('users.store');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/{ride}', [UserController::class, 'show'])->name('users.show');
Route::get('users/{ride}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{ride}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{ride}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/messages/{senderId}/{receiverId}', [MessageController::class, 'getMessages']);
Route::post('/messages/{senderId}/{receiverId}', [MessageController::class, 'sendMessage']);
Route::get('/conversations', [MessageController::class, 'getConversations'])->name('conversations.index');