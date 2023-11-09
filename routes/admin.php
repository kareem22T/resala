<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\DonationsByRepresentativeController;
use App\Http\Controllers\BranchController;

Route::middleware(['admin_guest'])->group(function () {
    Route::get('/login', [RegisterController::class, 'getLoginIndex']);
    Route::post('/login', [RegisterController::class, 'login'])->name('admin.login');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'getIndex'])->name('admin.home');

    // donations
    Route::prefix('/donate')->group(function () {
        Route::get('/by-representative', [DonationsByRepresentativeController::class, 'dashboardIndex'])->name('dashboard.by.representative');
        Route::post('/by-representative', [DonationsByRepresentativeController::class, 'get'])->name('donations.by_representativ.get');
        Route::get('/by-representative/get-unseen', [DonationsByRepresentativeController::class, 'getUnseen'])->name('dashboard.by.representative.getunseen');
        Route::post('/by-representative/see', [DonationsByRepresentativeController::class, 'see'])->name('donations.by_representativ.see');
        Route::post('/by-representative/search', [DonationsByRepresentativeController::class, 'search'])->name('donations.by_representativ.search');
        Route::post('/by-representative/delete', [DonationsByRepresentativeController::class, 'delete'])->name('donations.by_representativ.delete');
    });

    // volunteering
    Route::prefix('/volunteering')->group(function () {
        // routes
    });

    // volunteering
    Route::prefix('/branches')->group(function () {
        Route::get('/', [BranchController::class, 'index'])->name('branches.prev');
        Route::post('/', [BranchController::class, 'get'])->name('branchs.get');
        Route::post('/delete', [BranchController::class, 'delete'])->name('branchs.delete');
        Route::get('/add', [BranchController::class, 'addIndex'])->name('branches.add');
    });

    //logout
    Route::get('/logout', [RegisterController::class, 'logout'])->name('admin.logout');
});