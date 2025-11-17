<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// masterfiles
Route::get('/userlevel', [App\Http\Controllers\Admin\MasterfilesController::class, 'userlevel'])->name('Masterfile.userlevel');
Route::post('/createuserlevel', [App\Http\Controllers\Admin\MasterfilesController::class, 'adduserlevel'])->name('Masterfile.adduserlevel');
Route::post('/updateuserlevel', [App\Http\Controllers\Admin\MasterfilesController::class, 'updateuserlevel'])->name('Masterfile.updateuserlevel');
