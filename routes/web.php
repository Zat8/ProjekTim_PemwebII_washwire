<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\PaketIndex;
use App\Livewire\PaketForm;
use App\Livewire\TransaksiForm;

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
    Route::get('/kasir', TransaksiForm::class)->name('kasir.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/paket', PaketIndex::class)->name('paket.index');
    Route::get('/paket/buat', PaketForm::class)->name('paket.buat');
    Route::get('/paket/{paket}/edit', PaketForm::class)->name('paket.edit');
});

require __DIR__.'/auth.php';
