<?php

use App\Http\Controllers\Api\Auth\FirebaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    
    Route::post('/auth/firebase', FirebaseAuthController::class)->name('auth.firebase');
});