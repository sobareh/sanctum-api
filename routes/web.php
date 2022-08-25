<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::fallback(function () {
    return response()->json([
        "meta" => [
            "message" => "API resource not found.",
            "status" => "access denied | Forbidden.",
            "code" => 403
        ],
        "data" => []
    ],403);
});
