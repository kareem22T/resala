<?php

use App\Http\Controllers\ActivitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\DonationsByRepresentativeController;
use App\Http\Controllers\VolunteeringDestinationsController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BloodDonateController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\PageController;

Route::middleware(['admin_guest'])->group(function () {
    Route::get('/login', [RegisterController::class, 'getLoginIndex']);
    Route::post('/login', [RegisterController::class, 'login'])->name('admin.login');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/export-donations-by-representative', [DonationsByRepresentativeController::class, 'export']);
    Route::get('/export-Volunteer', [VolunteeringDestinationsController::class, 'export']);
    Route::get('/export-blood-donations', [BloodDonateController::class, 'export']);

    Route::get('/', [AdminHomeController::class, 'getIndex'])->name('admin.home');
    Route::post('/add-img-slider', [AdminHomeController::class, 'addImageToSlider'])->name('home.slider.add');
    Route::post('/add-img-events', [AdminHomeController::class, 'addImageToEvents'])->name('home.events.add');
    Route::post('/delete-img-slider', [AdminHomeController::class, 'deleteImgFromSlider'])->name('home.slider.delete');
    Route::post('/delete-img-events', [AdminHomeController::class, 'deleteImgFromEvents'])->name('home.events.delete');
    Route::post('/chang-img-slider-sort', [AdminHomeController::class, 'changeSlideSort'])->name('home.slider.change.sort');
    Route::post('/chang-img-events-sort', [AdminHomeController::class, 'changeEventsSort'])->name('home.events.change.sort');
    Route::post('/get-slider-imgs', [AdminHomeController::class, 'getSliderImages'])->name('admin_home.get.slider');
    Route::post('/get-events-imgs', [AdminHomeController::class, 'getEventsImages'])->name('admin_home.get.events');

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

    // branches
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

    // volunteering destinations
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
    // activites
    Route::prefix('/activites')->group(function () {
        Route::get('/', [ActivitiesController::class, 'index'])->name('activites.prev');
        Route::post('/', [ActivitiesController::class, 'get'])->name('activites.get');
        Route::post('/search', [ActivitiesController::class, 'search'])->name('activites.search');
        Route::post('/delete', [ActivitiesController::class, 'delete'])->name('activites.delete');
        Route::get('/add', [ActivitiesController::class, 'addIndex'])->name('activites.add');
        Route::post('/add', [ActivitiesController::class, 'add'])->name('activites.put');
        Route::get('/edit/{id}', [ActivitiesController::class, 'editIndex'])->name('activites.edit');
        Route::post('/edit', [ActivitiesController::class, 'edit'])->name('activites.update');
    });

    // volunteers
    Route::prefix('/volunteers')->group(function () {
        Route::get('/', [VolunteersController::class, 'dashboardIndex'])->name('volunteers.prev');
        Route::post('/', [VolunteersController::class, 'get'])->name('volunteers.get');
        Route::get('/get-unseen', [VolunteersController::class, 'getUnseen'])->name('volunteers.getunseen');
        Route::post('/see', [VolunteersController::class, 'see'])->name('volunteers.see');
        Route::post('/search', [VolunteersController::class, 'search'])->name('volunteers.search');
        Route::post('/delete', [VolunteersController::class, 'delete'])->name('volunteers.delete');
    });

    // site.blood_donations
    Route::prefix('/blood-donations')->group(function () {
        Route::get('/', [BloodDonateController::class, 'dashboardIndex'])->name('blood_donations.prev');
        Route::post('/', [BloodDonateController::class, 'get'])->name('blood_donations.get');
        Route::get('/get-unseen', [BloodDonateController::class, 'getUnseen'])->name('blood_donations.getunseen');
        Route::post('/see', [BloodDonateController::class, 'see'])->name('blood_donations.see');
        Route::post('/search', [BloodDonateController::class, 'search'])->name('blood_donations.search');
        Route::post('/delete', [BloodDonateController::class, 'delete'])->name('blood_donations.delete');
    });

    // images
    Route::prefix('/images')->group(function () {
        Route::post('/upload', [ImagesController::class, 'uploadeImg'])->name('lib.image.uploade');
        Route::get('/get_images', [ImagesController::class, 'getImages'])->name('lib.getImages');
        Route::post('/search', [ImagesController::class, 'search'])->name('lib.images.search');
    });

    // articles
    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticlesController::class, "index"])->name('article.prev');
        Route::get('/add', [ArticlesController::class, "addIndex"])->name('articles.add');
        Route::get('/edit/{id}', [ArticlesController::class, "edit"])->name('article.edit');
        Route::post('/update', [ArticlesController::class, "update"])->name('article.update');
        Route::post('/get', [ArticlesController::class, "getArticles"])->name('articles.get');
        Route::post('/search', [ArticlesController::class, "search"])->name('articles.search');
        Route::post('/delete', [ArticlesController::class, "delete"])->name('articles.delete');
        Route::post('/add', [ArticlesController::class, "put"])->name('article.put');
    });

    // events
    Route::prefix('events')->group(function () {
        Route::get('/', [EventsController::class, "index"])->name('event.prev');
        Route::get('/add', [EventsController::class, "addIndex"])->name('events.add');
        Route::get('/edit/{id}', [EventsController::class, "edit"])->name('event.edit');
        Route::post('/update', [EventsController::class, "update"])->name('event.update');
        Route::post('/get', [EventsController::class, "getEvents"])->name('events.get');
        Route::post('/search', [EventsController::class, "search"])->name('events.search');
        Route::post('/delete', [EventsController::class, "delete"])->name('events.delete');
        Route::post('/add', [EventsController::class, "put"])->name('event.put');
    });

    // pages
    Route::prefix('pages')->group(function () {
        Route::get('/', [PageController::class, "index"])->name('pages.prev');
        Route::get('/add', [PageController::class, "addIndex"])->name('pages.add');
        Route::get('/edit/{id}', [PageController::class, "edit"])->name('pages.edit');
        Route::post('/update', [PageController::class, "update"])->name('pages.update');
        Route::post('/get', [PageController::class, "getPages"])->name('pages.get');
        Route::post('/search', [PageController::class, "search"])->name('pages.search');
        Route::post('/delete', [PageController::class, "delete"])->name('pages.delete');
        Route::post('/add', [PageController::class, "put"])->name('pages.put');
    });

    //logout
    Route::get('/logout', [RegisterController::class, 'logout'])->name('admin.logout');
});
