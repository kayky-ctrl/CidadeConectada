<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    HomeController,
    AuthController,
    IssueController,
    AdminController
};

// Página inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Issues (protegidas por auth)
Route::middleware('auth')->group(function () {
    Route::resource('issues', IssueController::class)->except(['show']);
    
    // Admin routes
    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/issues', [AdminController::class, 'issues'])->name('admin.issues');
        Route::post('/admin/issues/{issue}/update-status', [AdminController::class, 'updateStatus'])->name('admin.issues.update-status');
    });
});