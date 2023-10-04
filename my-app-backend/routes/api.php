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

Route::post('/create', [\App\Http\Controllers\TodoController::class, 'create']);
Route::get('/todoLists', [\App\Http\Controllers\TodoController::class, 'getTodoList']);
Route::get('/complete/{id}', [\App\Http\Controllers\TodoController::class, 'complete']);
Route::get('/remove/{id}', [\App\Http\Controllers\TodoController::class, 'remove']);
