<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RestitusiController;

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
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/restitusi', [RestitusiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/restitusi', [RestitusiController::class, 'store'])->middleware('auth:sanctum');
Route::get('/restitusi/{id}', [RestitusiController::class, 'show'])->middleware('auth:sanctum');
Route::delete('/restitusi/{id}', [RestitusiController::class, 'destroy'])->middleware('auth:sanctum');
Route::patch('/restitusi/{id}', [RestitusiController::class, 'update'])->middleware('auth:sanctum');

Route::fallback(function (){
    return response()->json([
        "meta" => [
            "message" => "API resource not found.",
            "status" => "access denied | Forbidden.",
            "code" => 403
        ],
        "data" => []
    ],403);
});