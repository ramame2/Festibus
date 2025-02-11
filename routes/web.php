<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusRouteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LocationController;

Route::resource('locations', LocationController::class);
Route::resource('bus-routes', BusRouteController::class);





Route::middleware(['auth'])->group(function () {
    Route::get('/contacts/all', [ContactController::class, 'allMessages'])->name('contacts.all');
});
Route::middleware(['admin'])->group(function () {
    // Admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::get('admin/feedback', [FeedbackController::class, 'view'])->name('feedback.view');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');




Route::get('/{any?}', [HomeController::class, 'index'])
    ->where('any', 'home') // Match 'home', 'index.php', or ''
    ->name('home');




Route::get('/search/results', [BusRouteController::class, 'search']);
Route::get('/about', [PhotoController::class, 'index'])->name('about');
Route::get('/fetch-news', [NewsController::class, 'fetchNews']);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/festival', [FestivalController::class, 'index'])->name('festival');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/festivals', [FestivalController::class, 'index'])->name('festivals.index');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/test', [App\Http\Controllers\TestController::class, 'index']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/routes/search', [BusRouteController::class, 'search'])->name('routes.search');


Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');



Route::get('/routes', [BusRouteController::class, 'index']);
Route::post('/bus-routes/search', [BusRouteController::class, 'index'])->name('bus-routes.search');


Route::get('/search-route', [BusRouteController::class, 'searchForm']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');


Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::delete('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Auth::routes();


// Admin
/// NEWS



Route::middleware(['auth'])->group(function () {
    Route::get('/admin/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/admin/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/admin/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/admin/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
});



// bookings


Route::middleware(['auth'])->group(function () {
    Route::get('/festivals/{id}/edit', [FestivalController::class, 'edit'])->name('festivals.edit');
    Route::put('/festivals/{id}', [FestivalController::class, 'update'])->name('festivals.update');

    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
});


////////
Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');

// Festivals
Route::post('/festivals', [FestivalController::class, 'store'])->name('festivals.store');
Route::delete('/festivals/{id}', [FestivalController::class, 'destroy'])->name('festivals.destroy');

Route::put('festivals/{id}', [FestivalController::class, 'update'])->name('festivals.update');


///// user manage
Route::middleware(['auth'])->group(function () {

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

});


Route::resource('users', UserController::class);


Route::middleware(['auth'])->group(function () {

    Route::get('/admin/usersall', [UserController::class, 'index'])->name('admin.users.index');

});

// Admin user routes
Route::get('admin/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');





/// about
///

Route::middleware(['auth'])->group(function() {
    Route::get('/about/edit/{id}', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('/about/update/{id}', [AboutController::class, 'update'])->name('about.update');
});

Route::get('/about', [AboutController::class, 'index']);
 //// FAQ


use App\Http\Controllers\FaqController;
Route::prefix('faq')->group(function () {
    // Public route to view FAQs (accessible by everyone)
    Route::get('/', [FaqController::class, 'index'])->name('faq.index');

    // Admin routes to manage FAQs
    Route::middleware(['auth'])->group(function () {
        Route::get('manage', [FaqController::class, 'manage'])->name('admin.faqs.manage');
        Route::post('store', [FaqController::class, 'store'])->name('faq.store');
        Route::get('edit/{faq}', [FaqController::class, 'edit'])->name('faq.edit');
        Route::put('update/{faq}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('delete/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');
        Route::get('search', [FaqController::class, 'search'])->name('faq.search');
        Route::get('create', [FaqController::class, 'create'])->name('faq.create');

    });
});
