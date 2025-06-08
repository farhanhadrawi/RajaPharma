<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

// Controllers
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CashierDashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportExportController;
use App\Http\Controllers\ReceiptController;

// ===============================
// ROUTE UTAMA & AUTENTIKASI
// ===============================
Route::get('/', [AppController::class, 'landing'])->name('landing');

// Login page & proses login
Route::get('/login', [AppController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout ()
Route::middleware(['web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Tes route
Route::get('/test', [AppController::class, 'test'])->name('test');


// ===============================
// DASHBOARD (ADMIN & KASIR)
// ===============================

// DASHBOARD ADMIN (AppController)
Route::get('/dashboard/admin', [AppController::class, 'dashboard_admin'])->name('dashboard_admin');
Route::get('/dashboard/admin/report', [AppController::class, 'report_admin'])->name('report_admin');
Route::get('/dashboard/admin/stock-management', [AppController::class, 'stock_management'])->name('stock_management');
Route::get('/dashboard/admin/user-management', [AppController::class, 'user_management'])->name('user_management');

// DASHBOARD KASIR
Route::get('/dashboard/kasir', [CashierDashboardController::class, 'dashboard'])->name('dashboard_kasir');
Route::get('/dashboard/kasir/sales', [AppController::class, 'sales'])->name('sales');

// ===============================
// DASHBOARD ADMIN (DashboardController, akses dgn middleware 'auth')
// ===============================
Route::middleware(['auth'])->prefix('dashboard/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::put('/restock/{id}', [DashboardController::class, 'restock'])->name('medications.restock');
});

// ===============================
// DASHBOARD ADMIN (UserController)
// ===============================
Route::prefix('dashboard/admin')->group(function () {
    Route::get('/user-management', [UserController::class, 'index'])->name('users.index');
    Route::post('/user-management', [UserController::class, 'store'])->name('users.store');
    Route::put('/user-management/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user-management/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// ===============================
// ROUTE KHUSUS MIDDLEWARE & ROLE
// ===============================
// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});
// KASIR
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [CashierDashboardController::class, 'dashboard']);
});

// ===============================
// MEDICATION / OBAT
// ===============================
Route::get('/medications', [MedicationController::class, 'index']);
Route::post('/medications', [MedicationController::class, 'store'])->name('add_medication');
Route::put('/medications/{id}', [MedicationController::class, 'update'])->name('update_medication');
Route::delete('/medications/{id}', [MedicationController::class, 'destroy'])->name('delete_medication');
Route::post('/medications/{id}/restock', [MedicationController::class, 'restock'])->name('medications.restock');

// Tambahan dashboard_admin untuk MedicationController (bila memang ingin tetap)
Route::get('/dashboard/admin', [MedicationController::class, 'dashboard'])->name('dashboard_admin');

// ===============================
// SALES & TRANSACTION (KASIR)
// ===============================
Route::get('/dashboard/kasir/sales', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/dashboard/kasir/sales', [TransactionController::class, 'store'])->name('transactions.store');

// ===============================
// LAPORAN, EKSPOR PDF, KWITANSI
// ===============================
// Laporan (ReportController)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin/report', [ReportController::class, 'index'])->name('admin.report');
});

// Export PDF Laporan
Route::get('/admin/report/pdf', [ReportExportController::class, 'download'])->name('report.download');

// Download Receipt/Kwitansi
Route::get('/admin/receipt/{invoice}', [ReceiptController::class, 'download']);

// ===============================
// STOK DAN KEDALUWARSA (KASIR)
// ===============================
Route::get('stok-obat', [CashierDashboardController::class, 'getLowStockItems']);
Route::get('obat-kedaluwarsa', [CashierDashboardController::class, 'getExpiringItems']);

