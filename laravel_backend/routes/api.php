<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;

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

Route::prefix('/books')->group(function(){
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::post('/', [BookController::class, 'create']);
    Route::put('/edit/{id}', [BookController::class, 'edit']);
    Route::delete('/delete/{id}', [BookController::class, 'destroy']);
});

Route::prefix('/members')->group(function(){
    Route::get('/', [MemberController::class, 'index']);
    Route::get('/{id}', [MemberController::class, 'show']);
    Route::post('/', [MemberController::class, 'create']);
    Route::put('/edit/{id}', [MemberController::class, 'edit']);
    Route::delete('/delete/{id}', [MemberController::class, 'destroy']);
});

