<?php

use App\Http\Controllers\Api\Auth\FirebaseAuthController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\RobotsAndSitemapController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/**
 * AUTH ROUTES
 */
Route::redirect('/', '/dashboard')->name('home');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::name('dashboard.')->group(function() {
        Route::get('profile', [UserController::class, 'show'])->name('profile');
    });
});

/**
 * GUEST ROUTES
 */
Route::post('/auth/firebase', FirebaseAuthController::class)->name('auth.firebase');


/**
 * PUBLIC ROUTES
 */
Route::inertia('/privacy-policy', 'PrivacyPolicy')->name('privacy-policy');
Route::inertia('/terms-and-conditions', 'TermsAndConditions')->name('terms-and-conditions');

Route::get('/robots.txt', [RobotsAndSitemapController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [RobotsAndSitemapController::class, 'sitemap'])->name('sitemap');