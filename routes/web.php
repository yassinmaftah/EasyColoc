<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'is_banned'])->name('dashboard');

Route::middleware('auth', 'is_banned')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user.dashboard', function () {
    return view('user-dashboard');
})->middleware(['auth', 'is_banned'])->name('user.dashboard');

Route::get('/colocations', function () {
    return view('colocations');
})->middleware(['auth', 'is_banned'])->name('colocations.index');

Route::get('/colocations/create', function () {
    return view('colocations-create');
})->middleware(['auth', 'is_banned'])->name('colocations.create');

// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

//     Route::get('/', function () {
//         return view('admin-dashboard');
//     })->name('dashboard');

// });

Route::middleware(['auth','is_banned', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');
    Route::patch('/users/{id}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::patch('/users/{id}/unban', [UserController::class, 'unban'])->name('users.unban');
});


require __DIR__.'/auth.php';
