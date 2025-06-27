<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    HomeController,
    AuthController,
    IssueController,
    AdminController,
    AdminAuthController
};

// Rotas Públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autenticação Pública (Cidadão)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas do Cidadão (Autenticadas)
Route::middleware('auth')->group(function () {
    Route::resource('issues', IssueController::class)->except(['show']);
});

// Rotas da Administração (Prefeitura)
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    // Rotas Públicas
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login']);
    });

    // Rotas Protegidas (Admin)
    Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('issues', [AdminController::class, 'issues'])->name('admin.issues');
        Route::post('issues/{issue}/update-status', [AdminController::class, 'updateStatus'])
             ->name('admin.issues.update-status');
    });
});