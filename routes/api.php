<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{LoginController, ArchiveController, RestitusiController, DashboardController};
use App\Http\Controllers\DokumenController;

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
    
    Route::get('/dokumen', [DokumenController::class, 'index']);
    Route::post('/dokumen', [DokumenController::class, 'store']);
    Route::get('/dokumen/{id}', [DokumenController::class, 'show']);
    Route::delete('/dokumen/{id}', [DokumenController::class, 'destroy']);
    Route::patch('/dokumen/{id}', [DokumenController::class, 'update']);
});


Route::fallback(function (){
    return response()->json([
        "message" => "API resource not found.",
        "status" => "access denied | Forbidden.",
        "code" => 403
    ],403);
});