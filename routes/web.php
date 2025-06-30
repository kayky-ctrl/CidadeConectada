<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    HomeController,
    AuthController,
    IssueController,
    AdminController,
    AdminAuthController,
    RatingController
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
    Route::get('issues/{issue}/rate', [RatingController::class, 'create'])->name('ratings.create');
    Route::post('issues/{issue}/rate', [RatingController::class, 'store'])->name('ratings.store');
});

// Rotas da Administração (Prefeitura)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Rotas Públicas
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login']);
    });

    // Rotas Protegidas (Admin)
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('issues', [AdminController::class, 'issues'])->name('admin.issues');
    Route::post('issues/{issue}/update-status', [AdminController::class, 'updateStatus'])
        ->name('admin.issues.update-status');
});

Route::get('/issuesAdmin', function () {
    $admins = ['admin@example.com'];
    if (!auth()->check() || !in_array(auth()->user()->email, $admins)) {
        abort(403, 'Acesso não autorizado');
    }
    $issues = \App\Models\ReportedIssue::with(['user', 'updates'])->latest()->get();
    return view('issues.issuesAdmin', compact('issues'));
})->middleware('auth')->name('issuesAdmin');

Route::post('/issuesAdmin/{issue}/update-status', function (\Illuminate\Http\Request $request, \App\Models\ReportedIssue $issue) {
    $admins = ['admin@example.com'];
    if (!auth()->check() || !in_array(auth()->user()->email, $admins)) {
        abort(403, 'Acesso não autorizado');
    }
    // Chame o método do controller manualmente:
    return app(\App\Http\Controllers\Web\IssueController::class)->updateStatus($request, $issue);
})->middleware('auth')->name('issuesAdmin.update-status');
