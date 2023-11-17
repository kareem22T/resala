<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\DonationsByRepresentativeController;
use App\Http\Controllers\VolunteeringDestinationsController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\ImagesController;

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
        Route::post('/search', [BranchController::class, 'search'])->name('branchs.search');
        Route::post('/delete', [BranchController::class, 'delete'])->name('branchs.delete');
        Route::get('/add', [BranchController::class, 'addIndex'])->name('branches.add');
        Route::post('/add', [BranchController::class, 'add'])->name('branches.put');
        Route::get('/edit/{id}', [BranchController::class, 'editIndex'])->name('branches.edit');
        Route::post('/edit', [BranchController::class, 'edit'])->name('branches.update');
    });

    Route::prefix('/volunteering-destinations')->group(function () {
        Route::get('/', [VolunteeringDestinationsController::class, 'index'])->name('destinations.prev');
        Route::post('/', [VolunteeringDestinationsController::class, 'get'])->name('destinations.get');
        Route::post('/search', [VolunteeringDestinationsController::class, 'search'])->name('destinations.search');
        Route::post('/delete', [VolunteeringDestinationsController::class, 'delete'])->name('destinations.delete');
        Route::get('/add', [VolunteeringDestinationsController::class, 'addIndex'])->name('destinations.add');
        Route::post('/add', [VolunteeringDestinationsController::class, 'add'])->name('destinations.put');
        Route::get('/edit/{id}', [VolunteeringDestinationsController::class, 'editIndex'])->name('destinations.edit');
        Route::post('/edit', [VolunteeringDestinationsController::class, 'edit'])->name('destination.update');
    });

    Route::prefix('/volunteers')->group(function () {
        Route::get('/', [VolunteersController::class, 'dashboardIndex'])->name('volunteers.prev');
        Route::post('/', [VolunteersController::class, 'get'])->name('volunteers.get');
        Route::get('/get-unseen', [VolunteersController::class, 'getUnseen'])->name('volunteers.getunseen');
        Route::post('/see', [VolunteersController::class, 'see'])->name('volunteers.see');
        Route::post('/search', [VolunteersController::class, 'search'])->name('volunteers.search');
        Route::post('/delete', [VolunteersController::class, 'delete'])->name('volunteers.delete');
    });

    // images
    Route::prefix('/images')->group(function () {
        Route::post('/upload', [ImagesController::class, 'uploadeImg'])->name('lib.image.uploade');
        Route::get('/get_images', [ImagesController::class, 'getImages'])->name('lib.getImages');
        Route::post('/search', [ImagesController::class, 'search'])->name('lib.images.search');
    });

    //logout
    Route::get('/logout', [RegisterController::class, 'logout'])->name('admin.logout');
});