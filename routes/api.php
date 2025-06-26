<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\Admin\AdminIssueController;
use App\Http\Controllers\Api\V1\ReportedIssueController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:sanctum')->group(function () {
    // Rotas para cidadãos
    Route::apiResource('issues', ReportedIssueController::class);
    Route::post('issues/{issue}/rate', [ReportedIssueController::class, 'rate']);
    
    // Rotas para administradores
    Route::prefix('admin')->middleware('is_admin')->group(function () {
        Route::apiResource('issues', AdminIssueController::class)->except(['store']);
        Route::post('issues/{issue}/update-status', [AdminIssueController::class, 'updateStatus']);
    });
    
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Route::get('/invoices', [InvoiceController::class, 'index']);
// Route::get('/invoices/{invoice}', [InvoiceController::class, 'show']);

// Route::post('/invoices', [InvoiceController::class, 'store']);
// Route::put('/invoices/{invoice}', [InvoiceController::class, 'update']);
// Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy']);
