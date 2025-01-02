<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\TodosContoller;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/register', [AuthController::class, 'register']);

// Route::controller(AuthController::class)->group(function () {
//     Route::post('/register', 'register');
//     Route::post('/login', 'login');
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

// Route::get('/todos', [TodosContoller::class, 'index']);
// Route::post('/todo', [TodosContoller::class, 'store']);


Route::middleware('jwt.auth')->group(function () {
    Route::get('/todos', [TodosContoller::class, 'index']);
    Route::post('/todo', [TodosContoller::class, 'store']);
    Route::get('/todo/{id}', [TodosContoller::class, 'show']);
    Route::put('/todo/{id}', [TodosContoller::class, 'update']);
    Route::delete('/todo/{id}', [TodosContoller::class, 'destroy']);
    Route::post('/chatAI', [ChatController::class, 'chatAI']);
});
