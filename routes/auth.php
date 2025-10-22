<?php
// ...existing code or leave empty if you use Laravel Breeze/Fortify/Jetstream/etc. for authentication routes...
// If using Laravel Breeze/Jetstream, this file is usually generated automatically.
// If not using any package, you can define basic auth routes as below:

use Illuminate\Support\Facades\Route;

// If the classic auth controllers exist, register their routes. Many projects use Fortify/Jetstream
// which provide their own routes; guard these definitions so artisan commands don't fail when
// the controllers are not present.
if (
	class_exists(\App\Http\Controllers\Auth\LoginController::class)
	&& class_exists(\App\Http\Controllers\Auth\RegisterController::class)
) {
	// Authentication Routes...
	Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
	Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
	Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

	// Registration Routes...
	Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
	Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

	// Password Reset Routes (guarded individually because they may live in separate controllers)
	if (class_exists(\App\Http\Controllers\Auth\ForgotPasswordController::class)) {
		Route::get('password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
		Route::post('password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
	}

	if (class_exists(\App\Http\Controllers\Auth\ResetPasswordController::class)) {
		Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
		Route::post('password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
	}
}
