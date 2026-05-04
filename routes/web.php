<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PublicOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ======================================================================
// 1. RUTE PUBLIK (Guest)
// ======================================================================
Route::get('/', function () {
    $services = \App\Models\Service::all();
    return view('welcome', compact('services'));
})->name('home');

// Tahap 1: Form pemesanan dan proses penyimpanan data awal
Route::get('/pesan', [PublicOrderController::class, 'create'])->name('pesan.form');
Route::post('/pesan', [PublicOrderController::class, 'store'])->name('pesan.store');

// Tahap 2: Halaman konfirmasi total harga dan upload bukti pembayaran
Route::get('/bayar/{resi}', [PublicOrderController::class, 'bayar'])->name('pesan.bayar');
Route::post('/bayar/{resi}', [PublicOrderController::class, 'prosesBayar'])->name('pesan.prosesBayar');

// Callback Midtrans
Route::post('/midtrans-callback', [PublicOrderController::class, 'callback'])->name('midtrans.callback');

// Tahap 3: Halaman Struk akhir setelah pembayaran
Route::get('/struk/{resi}', [PublicOrderController::class, 'struk'])->name('struk.show');


// ======================================================================
// 2. RUTE PEGAWAI (Admin & Kasir - Wajib Login)
// ======================================================================
Route::middleware(['auth'])->group(function () {
    
    // --- PENGATUR ARAH (REDIRECTOR) DASHBOARD ---
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        }
        
        // Pengaman: Jika role tidak dikenali
        return redirect('/');
    })->name('dashboard');


    // --- RUTE KHUSUS ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        // Dashboard Admin
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/dashboard/pdf', [AdminController::class, 'downloadPDF'])->name('admin.dashboard.pdf');
        
        // Hapus Pesanan
        Route::delete('/admin/order/{id}', [AdminController::class, 'destroy'])->name('admin.order.destroy');

        // CRUD Kelola Jasa Cetak
        Route::resource('admin/services', ServiceController::class)->names([
            'index' => 'admin.services.index',
            'store' => 'admin.services.store',
            'edit' => 'admin.services.edit',
            'update' => 'admin.services.update',
            'destroy' => 'admin.services.destroy',
        ]);
    });


    // --- RUTE KHUSUS KASIR ---
    Route::middleware(['role:kasir'])->group(function () {
        // Dashboard Kasir
        Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');
        
        // Buat Pesanan Langsung (Walk-in)
        Route::get('/kasir/order/create', [KasirController::class, 'create'])->name('kasir.order.create');
        Route::post('/kasir/order/store', [KasirController::class, 'store'])->name('kasir.order.store');
    });


    // --- RUTE BERSAMA (Admin & Kasir) ---
    // Update Status Pesanan
    Route::patch('/order/{id}/status', [OrderController::class, 'updateStatus'])->name('order.status');


    // --- RUTE PROFILE BREEZE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autentikasi Breeze
require __DIR__.'/auth.php';