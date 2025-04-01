<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

// Route::get('/dashboard', function () {
//     return view('resident.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'contactupdate'])->name('profile.contactupdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'ResidentMiddleware'])->group(function () {
    Route::get('/dashboard', [ResidentController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'AdminMiddleware'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin/dashboard');
});

Route::middleware(['auth', 'StaffMiddleware'])->group(function () {
    Route::get('staff/dashboard', [StaffController::class, 'index'])->name('staff/dashboard');
});

Route::middleware(['auth', 'SecurityMiddleware'])->group(function () {
    Route::get('security/dashboard', [SecurityController::class, 'index'])->name('security/dashboard');
});
