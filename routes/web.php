<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer routes
Route::middleware(['customer.auth'])->group(function () {
    Route::get('/customer/dashboard', [DashboardController::class, 'customerDashboard'])->name('customer.dashboard');
    Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('/customer/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::get('/customer/plans', [PlanController::class, 'customerPlans'])->name('customer.plans');
    Route::get('/customer/transactions', [TransactionController::class, 'customerTransactions'])->name('customer.transactions');
    Route::get('/customer/vouchers', [VoucherController::class, 'customerVouchers'])->name('customer.vouchers');
    Route::post('/customer/voucher/activate', [VoucherController::class, 'activateVoucher'])->name('customer.voucher.activate');

    Route::get('/customer/tickets', [TicketController::class, 'customerIndex'])->name('customer.tickets.index');
    Route::get('/customer/tickets/create', [TicketController::class, 'create'])->name('customer.tickets.create');
    Route::post('/customer/tickets', [TicketController::class, 'store'])->name('customer.tickets.store');
});

// Admin routes
Route::prefix('admin')->middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    
    // Customer management
    Route::prefix('customers')->name('admin.customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('destroy');
    });
    
    // Plan management
    Route::prefix('plans')->name('admin.plans.')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('index');
        Route::get('/create', [PlanController::class, 'create'])->name('create');
        Route::post('/', [PlanController::class, 'store'])->name('store');
        Route::get('/{id}', [PlanController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PlanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PlanController::class, 'update'])->name('update');
        Route::delete('/{id}', [PlanController::class, 'destroy'])->name('destroy');
    });
    
    // Router management
    Route::prefix('routers')->name('admin.routers.')->group(function () {
        Route::get('/', [RouterController::class, 'index'])->name('index');
        Route::get('/create', [RouterController::class, 'create'])->name('create');
        Route::post('/', [RouterController::class, 'store'])->name('store');
        Route::get('/{id}', [RouterController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RouterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RouterController::class, 'update'])->name('update');
        Route::delete('/{id}', [RouterController::class, 'destroy'])->name('destroy');
    });
    
    // Transaction management
    Route::prefix('transactions')->name('admin.transactions.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/{id}', [TransactionController::class, 'show'])->name('show');
        Route::post('/create', [TransactionController::class, 'store'])->name('store');
    });
    
    // Voucher management
    Route::prefix('vouchers')->name('admin.vouchers.')->group(function () {
        Route::get('/', [VoucherController::class, 'index'])->name('index');
        Route::get('/create', [VoucherController::class, 'create'])->name('create');
        Route::post('/', [VoucherController::class, 'store'])->name('store');
        Route::get('/{id}', [VoucherController::class, 'show'])->name('show');
        Route::delete('/{id}', [VoucherController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tickets')->name('admin.tickets.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::post('/{id}/status', [TicketController::class, 'updateStatus'])->name('updateStatus');
    });
    
    // Payment management
    Route::prefix('payments')->name('admin.payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/{id}', [PaymentController::class, 'show'])->name('show');
        Route::post('/process', [PaymentController::class, 'process'])->name('process');
    });
    
    // Reports
    Route::prefix('reports')->name('admin.reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/customers', [ReportController::class, 'customers'])->name('customers');
        Route::get('/revenue', [ReportController::class, 'revenue'])->name('revenue');
        Route::get('/usage', [ReportController::class, 'usage'])->name('usage');
    });
    
    // Settings
    Route::prefix('settings')->name('admin.settings.')->group(function () {
        Route::get('/', [AdminController::class, 'settings'])->name('index');
        Route::post('/', [AdminController::class, 'updateSettings'])->name('update');
    });
});

// API routes for payment callbacks
Route::prefix('api')->group(function () {
    Route::post('/payment/callback/{gateway}', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('/payment/success/{id}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel/{id}', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Hotspot routes (for Mikrotik integration)
Route::prefix('hotspot')->group(function () {
    Route::get('/login', [AuthController::class, 'hotspotLogin'])->name('hotspot.login');
    Route::post('/login', [AuthController::class, 'hotspotLoginPost'])->name('hotspot.login.post');
    Route::get('/status', [AuthController::class, 'hotspotStatus'])->name('hotspot.status');
    Route::get('/logout', [AuthController::class, 'hotspotLogout'])->name('hotspot.logout');
});

