<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ProdukCrud;
use App\Livewire\KategoriCrud;
use App\Livewire\SupplierCrud;
use App\Livewire\LaporanPenjualan;
use App\Livewire\PenjualanCrud;
use App\Livewire\PenjualanDanLaporan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function() {
    Route::get('/produk', \App\Livewire\ProdukCrud::class)->name('produk');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/kategori', KategoriCrud::class)->name('kategori');
    Route::get('/supplier', SupplierCrud::class)->name('supplier');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/penjualan-laporan', PenjualanDanLaporan::class)->name('penjualan-laporan');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
