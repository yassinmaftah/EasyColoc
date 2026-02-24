<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-dashboard', function () {
    return view('test-dashboard');
})->middleware(['auth'])->name('test.dashboard');

Route::get('/colocations', function () {
    return view('colocations');
})->middleware(['auth'])->name('colocations.index');

Route::get('/colocations/create', function () {
    return view('colocations-create');
})->middleware(['auth'])->name('colocations.create');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return view('admin-dashboard');
    })->name('dashboard');

});

require __DIR__.'/auth.php';
