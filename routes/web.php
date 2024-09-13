<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizMatchController;
use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/inicio', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('/equipos')->controller(TeamController::class)->group(function () {
    Route::get('/', 'index')->name('teams.index');
    Route::post('/', 'store')->name('teams.store');
    Route::patch('/', 'update')->name('teams.update');
    Route::delete('/', 'delete')->name('teams.delete');
});

Route::middleware('auth')->prefix('/competencias')->controller(QuizMatchController::class)->group(function () {
    Route::get('/', 'index')->name('quizMatches.index');
    Route::get('/download/{matchId}', 'download')->name('quizMatches.download');
    Route::post('/', 'store')->name('quizMatches.store');
    Route::patch('/', 'update')->name('quizMatches.update');
    Route::delete('/', 'delete')->name('quizMatches.delete');
});

/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */

require __DIR__.'/auth.php';
