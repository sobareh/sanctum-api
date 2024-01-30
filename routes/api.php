<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController, ArchiveController, RestitusiController, DashboardController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    Route::get('/restitusi', [RestitusiController::class, 'index']);
    Route::post('/restitusi', [RestitusiController::class, 'store']);
    Route::get('/restitusi/{id}', [RestitusiController::class, 'show']);
    Route::delete('/restitusi/{id}', [RestitusiController::class, 'destroy']);
    Route::patch('/restitusi/{id}', [RestitusiController::class, 'update']);

    Route::post('/restitusi/{id}/archive', [ArchiveController::class, 'store']);
    Route::delete('/archive/{id}', [ArchiveController::class, 'destroy']);
});


Route::fallback(function (){
    return response()->json([
        "message" => "API resource not found.",
        "status" => "access denied | Forbidden.",
        "code" => 403
    ],403);
});