<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationsByRepresentativeController;
use App\Http\Controllers\VolunteersController;

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

Route::get('/sample', function () {
    return view('site.sample');
});

Route::prefix("/donate")->group(function () {
    Route::get('/', function () {
        return view('site.donate.donate');
    })->name('donate.main');
    
    // by representative
    Route::get('/by-representative', [DonationsByRepresentativeController::class, 'index'])->name('donate.representative');
    Route::post('/by-representative', [DonationsByRepresentativeController::class, 'send'])->name('donate.representative.back');
});

Route::prefix("/volunteering")->group(function () {
    Route::get('/', [VolunteersController::class, 'index'])->name('site.volunteering');
});
