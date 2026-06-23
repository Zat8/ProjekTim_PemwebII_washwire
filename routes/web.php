<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\PaketIndex;
use App\Livewire\PaketForm;
use App\Livewire\TransaksiForm;
use App\Livewire\TransaksiTracking;
use App\Livewire\Dashboard;
use App\Livewire\PelangganDashboard;
use App\Livewire\PelangganTracking;
use App\Http\Controllers\StrukController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'pelanggan') {
        return redirect()->route('pelanggan.dashboard');
    }
    return redirect()->route('staff.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/staff/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified', 'role:admin,kasir'])
    ->name('staff.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,kasir'])->group(function () {
    Route::get('/kasir', TransaksiForm::class)->name('kasir.index');
    Route::get('/tracking', TransaksiTracking::class)->name('tracking.index');
    Route::get('/struk/{transaksi}', [StrukController::class, 'cetak'])->name('struk.cetak');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/paket', PaketIndex::class)->name('paket.index');
    Route::get('/paket/buat', PaketForm::class)->name('paket.buat');
    Route::get('/paket/{paket}/edit', PaketForm::class)->name('paket.edit');
});

Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', PelangganDashboard::class)->name('dashboard');
    Route::get('/tracking', PelangganTracking::class)->name('tracking');
});

require __DIR__ . '/auth.php';
