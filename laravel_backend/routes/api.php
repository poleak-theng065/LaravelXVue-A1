<?php

use App\Http\Controllers\MembersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthorController;


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
    Route::get('/', [MembersController::class, 'index']);
    Route::get('/{id}', [MembersController::class, 'show']);
    Route::post('/', [MembersController::class, 'create']);
    Route::put('/edit/{id}', [MembersController::class, 'edit']);
    Route::delete('/delete/{id}', [MembersController::class, 'destroy']);
});

Route::prefix('/authors')->group(function(){
    Route::get('/', [AuthorController::class, 'index']);
    Route::get('/{id}', [AuthorController::class, 'show']);
    Route::post('/', [AuthorController::class, 'create']);
    Route::put('/edit/{id}', [AuthorController::class, 'edit']);
    Route::delete('/delete/{id}', [AuthorController::class, 'destroy']);
});