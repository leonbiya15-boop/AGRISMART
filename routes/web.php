<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelleController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\RecolteController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\RotationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IntrantController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth'])->name('dashboard');

      //TEST GEMINI
    Route::get('/test-gemini', [GeminiController::class, 'test']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('parcelles', ParcelleController::class);
    Route::resource('cultures', CultureController::class);
    Route::resource('recoltes', RecolteController::class);
    Route::resource('diagnostics', DiagnosticController::class);
    Route::resource('alertes', \App\Http\Controllers\AlerteController::class)->only(['index', 'update', 'destroy']);
    Route::resource('rotations', RotationController::class);
    Route::resource('intrants', IntrantController::class);
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::resource('rapports', RapportController::class);
    Route::resource('stocks', StockController::class);
});

require __DIR__.'/auth.php';
