<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Superadmin\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // SUPERADMIN
    Route::prefix('super-admin')->name('super-admin.')->middleware('role:SUPER_ADMIN')->group(function () {
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/tenants', TenantController::class);

        // Route::resource('branches', BranchController::class);
        // Route::resource('users', UserController::class);
    });

    // OWNER
    Route::prefix('owner')->name('owner.')->middleware('role:OWNER')->group(function () {
        Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');

        // Route::resource('categories', CategoryController::class);
    });

    // CASHIER
    Route::prefix('cashier')->name('cashier.')->middleware('role:CASHIER')->group(function () {
        Route::get('/dashboard', [CashierDashboardController::class, 'index'])->name('dashboard');

        // Route::resource('sales', SaleController::class);
    });
});

require __DIR__ . '/auth.php';
