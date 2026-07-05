<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Cashier\DashboardController as CashierDashboardController;
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\UnitController;
use App\Http\Controllers\superadmin\BranchController;
use App\Http\Controllers\Superadmin\TenantController;
use App\Http\Controllers\superadmin\UserController;
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
        // Tenants
        Route::resource('tenants', TenantController::class)->except('show');
        Route::get('tenants/data', [TenantController::class, 'data'])->name('tenants.data');
        // branches
        Route::resource('branches', BranchController::class)->except('show');
        Route::get('branches/data', [BranchController::class, 'data'])->name('branches.data');
        Route::get('branches/by-tenant/{tenant}', [BranchController::class, 'byTenant'])->name('branches.by-tenant');
        // user
        Route::resource('users', UserController::class)->except('show');
        Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    });

    // OWNER
    Route::prefix('owner')->name('owner.')->middleware('role:OWNER')->group(function () {
        Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
        // category
        Route::resource('categories', CategoryController::class)->except('show');
        Route::get('categories/data', [CategoryController::class, 'data'])->name('categories.data');
        // unit
        Route::resource('units', UnitController::class)->except('show');
        Route::get('units/data', [UnitController::class, 'data'])->name('units.data');
    });

    // CASHIER
    Route::prefix('cashier')->name('cashier.')->middleware('role:CASHIER')->group(function () {
        Route::get('/dashboard', [CashierDashboardController::class, 'index'])->name('dashboard');

        // Route::resource('sales', SaleController::class);
    });
});

require __DIR__ . '/auth.php';
