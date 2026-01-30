<?php

use App\Http\Controllers\Api\Auth\FirebaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/firebase', FirebaseAuthController::class);