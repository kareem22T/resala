<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationsByRepresentativeController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\VolunteeringDestinationsController;
use App\Http\Controllers\BranchController;

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
Route::get('/about-us', function () {
    return view('site.about');
})->name('resala.about');

Route::get('/sample', function () {
    return view('site.sample');
});

Route::prefix("/donate")->group(function () {
    Route::get('/', function () {
        return view('site.donate.donate');
    })->name('donate.main');
    
    // by representative
    Route::get('/by-representative', [DonationsByRepresentativeController::class, 'index'])->name('donate.representative');
    Route::post('/by-representative', [DonationsByRepresentativeController::class, 'send'])->name('donate.representative.send');
});

Route::prefix("/volunteering")->group(function () {
    Route::get('/', [VolunteersController::class, 'index'])->name('site.volunteering');
    Route::post('/send', [VolunteersController::class, 'send'])->name('volunteering.send');
    Route::get('/destinations/get-all', [VolunteeringDestinationsController::class, 'getAll'])->name('destinations.getAll');
    Route::get('/branches/get-all', [BranchController::class, 'getAll'])->name('branches.getAll');
});
