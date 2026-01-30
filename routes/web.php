<?php

use App\Http\Controllers\Api\Auth\FirebaseAuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/dashboard')->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::inertia('test_login', 'TestLogin');

Route::post('/auth/firebase', FirebaseAuthController::class);

require __DIR__.'/settings.php';
