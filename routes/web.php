<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationsByRepresentativeController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\VolunteeringDestinationsController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('site.about');
})->name('resala.about');

Route::get('/contact-us', function () {
    return view('site.contact');
})->name('resala.contact');

Route::get('/baheya', function () {
    return view('site.bahya');
})->name('resala.baheya');

Route::get('/sample', function () {
    return view('site.sample');
});

Route::prefix("/donation-main")->group(function () {
    Route::get('/', function () {
        return view('site.donate.donate');
    })->name('donate.main');
    // by representative
    Route::post('/by-representative', [DonationsByRepresentativeController::class, 'send'])->name('donate.representative.send');
});

Route::get('/donate-rep', [DonationsByRepresentativeController::class, 'index'])->name('donate.representative');

Route::prefix("/volunteering")->group(function () {
    Route::get('/', [VolunteersController::class, 'index'])->name('site.volunteering');
    Route::post('/send', [VolunteersController::class, 'send'])->name('volunteering.send');
    Route::get('/destinations/get-all', [VolunteeringDestinationsController::class, 'getAll'])->name('destinations.getAll');
    Route::get('/branches/get-all', [BranchController::class, 'getAll'])->name('branches.getAll');
});

Route::get('/activities', [VolunteeringDestinationsController::class, 'getActivitiesIndex'])->name('activities.show');
Route::get('/category/news/', [ArticlesController::class, 'getNewsIndex'])->name('news.show');
Route::get('/category/videos/', [ArticlesController::class, 'getVideosIndex'])->name('videos.show');
Route::get('/category/photos/', [ArticlesController::class, 'getImagesIndex'])->name('photos.show');
Route::get('/{url}', [HomeController::class, 'urlPerIndex'])
    ->where('url', '^(?!admin|donation-main|donate-rep|volunteering|about|contact-us|baheya|activities).*$')->name('article.details');