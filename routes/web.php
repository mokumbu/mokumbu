<?php

use App\Http\Controllers\Api\Auth\FirebaseAuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/dashboard')->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/auth/firebase', FirebaseAuthController::class)->name('auth.firebase');

Route::inertia('/privacy-policy', 'PrivacyPolicy')->name('privacy-policy');
Route::inertia('/terms-and-conditions', 'TermsAndConditions')->name('terms-and-conditions');

Route::get('/robots.txt', function () {
    $content = "User-agent: *\n";

    if (app()->environment('production')) {
        $content .= "Allow: /\nSitemap: " . url('/sitemap.xml');
    } else {
        $content .= "Disallow: /";
    }

    return response($content, 200)
        ->header('Content-Type', 'text/plain');
});