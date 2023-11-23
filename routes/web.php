<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationsByRepresentativeController;
use App\Http\Controllers\VolunteersController;
use App\Http\Controllers\VolunteeringDestinationsController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Models\Article;
use Carbon\Carbon;

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

Route::get('/', function (Request $request) {
    $articles = Article::where('title', 'like', '%' . $request->search . '%')->orWhere('content', 'like', '%' . $request->search . '%')->orderBy(\DB::raw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))'))->paginate(10);
    $title = $request->search;
    $active_link = '';
    Carbon::setLocale('ar');
    if ($request->search)
        return view('site.articles')->with(compact(['articles', 'title', 'active_link']));

    return view('welcome');
});
Route::get('/about', function () {
    return view('site.about');
})->name('resala.about');

Route::get('/contact-us', function () {
    return view('site.contact');
})->name('resala.contact');

Route::get('/تحدي-الخير', function () {
    return view('site.challenge_day');
})->name('resala.challange_day');

Route::get('/bank-transfer', function () {
    return view('site.donate.bank-transfer');
})->name('resala.bank_transfer');

Route::get('/others-donation', function () {
    return view('site.donate.other');
})->name('resala.other_donation');

Route::get('/baheya', function () {
    return view('site.bahya');
})->name('resala.baheya');


Route::get('/privacy-policy', function () {
    return view('site.privacy_policy');
})->name('resala.privacy_policy');

Route::get('/faq', function () {
    return view('site.faq');
})->name('resala.faq');

Route::get('/reply-to-rumors', function () {
    return view('site.reply_to_rumors');
})->name('resala.reply_to_rumors');

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

Route::get('/category/news/', [ArticlesController::class, 'getNewsIndex'])->name('news.show');
Route::get('/search/{search}', [ArticlesController::class, 'searchSite'])->name('resala.search');
Route::get('/activities', [VolunteeringDestinationsController::class, 'getActivitiesIndex'])->name('activities.show');
Route::get('/branches', [BranchController::class, 'getBranchesIndex'])->name('branches.show');
Route::get('/category/videos/', [ArticlesController::class, 'getVideosIndex'])->name('videos.show');
Route::get('/category/photos/', [ArticlesController::class, 'getImagesIndex'])->name('photos.show');
Route::get('/{url}', [HomeController::class, 'urlPerIndex'])
    ->where('url', '^(?!admin|donation-main|donate-rep|volunteering|about|contact-us|baheya|activities|branches|reply-to-rumors|faq).*$')->name('article.details');