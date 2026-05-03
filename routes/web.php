<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Auth;

// 1. Logika Redirect Utama (Root)
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Jika admin ke dashboard, jika user ke daftar pinjaman mereka
    return Auth::user()->role === 'admin'
        ? redirect()->route('dashboard')
        : redirect()->route('peminjaman.index');
});

// 2. Route Profile (Bawaan Laravel Breeze/Starter Kit)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Route Umum (Bisa diakses Admin & User setelah Login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Halaman List (Controller akan otomatis pilih file index atau user_index)
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    
    // Form Tambah Pinjaman (Biasanya hanya User, tapi Admin juga bisa akses tidak masalah)
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
});

// 4. Route Khusus Admin (Hanya Role Admin)
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Kelola Master Barang
    Route::resource('barang', BarangController::class); 
    
    // Approval Peminjaman
    Route::patch('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::patch('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');

    Route::post('/peminjaman/{id}/return', [PeminjamanController::class, 'returnBarang'])->name('peminjaman.return');
    });

require __DIR__.'/auth.php';