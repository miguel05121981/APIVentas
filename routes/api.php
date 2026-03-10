<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\UserController;

Route::post('/login', [AuthController::class, 'login']);
// Route::post('/login', function (Request $request) {
//     return '$request->user()';
// });
Route::post('/refresh', [AuthController::class, 'refresh']);

// Route::middleware('auth:sanctum')->group(function () {
Route::middleware(['license', 'auth:sanctum'])->group(function () {
    




    Route::apiResource('user2', UserController::class);
    Route::get('/me', function (Request $request) {
        return response()->json($request->user());
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::apiResource('user', UserController::class);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// });//->middleware('auth:sanctum');
