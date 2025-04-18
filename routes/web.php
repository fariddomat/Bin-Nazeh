<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\BlogCategoryController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\UserController;
use App\Livewire\UserForm;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::view('/', 'welcome');

Route::middleware(['web'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
});

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['auth', 'role:superadministrator|blogger|admin'])
    ->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('/blog_categories', \App\Http\Controllers\Dashboard\BlogCategoryController::class);
        Route::post('/blog_categories/{id}/restore', [\App\Http\Controllers\Dashboard\BlogCategoryController::class, 'restore'])->name('blog_categories.restore');

        Route::resource('/blogs', \App\Http\Controllers\Dashboard\BlogController::class);
        Route::post('/blogs/{id}/restore', [\App\Http\Controllers\Dashboard\BlogController::class, 'restore'])->name('blogs.restore');

        Route::resource('/services', \App\Http\Controllers\Dashboard\ServiceController::class);
        Route::post('/services/{id}/restore', [\App\Http\Controllers\Dashboard\ServiceController::class, 'restore'])->name('services.restore');

        Route::resource('/project_categories', \App\Http\Controllers\Dashboard\ProjectCategoryController::class);
        Route::post('/project_categories/{id}/restore', [\App\Http\Controllers\Dashboard\ProjectCategoryController::class, 'restore'])->name('project_categories.restore');

        Route::resource('/projects', \App\Http\Controllers\Dashboard\ProjectController::class);
        Route::post('/projects/{id}/restore', [\App\Http\Controllers\Dashboard\ProjectController::class, 'restore'])->name('projects.restore');

        Route::resource('/counters', \App\Http\Controllers\Dashboard\CounterController::class);
        Route::post('/counters/{id}/restore', [\App\Http\Controllers\Dashboard\CounterController::class, 'restore'])->name('counters.restore');

        Route::resource('/partners', \App\Http\Controllers\Dashboard\PartnerController::class);
        Route::post('/partners/{id}/restore', [\App\Http\Controllers\Dashboard\PartnerController::class, 'restore'])->name('partners.restore');

        Route::resource('/whies', \App\Http\Controllers\Dashboard\WhyController::class);
        Route::post('/whies/{id}/restore', [\App\Http\Controllers\Dashboard\WhyController::class, 'restore'])->name('whies.restore');

        Route::resource('/certificates', \App\Http\Controllers\Dashboard\CertificateController::class);
        Route::post('/certificates/{id}/restore', [\App\Http\Controllers\Dashboard\CertificateController::class, 'restore'])->name('certificates.restore');

        Route::resource('/reviews', \App\Http\Controllers\Dashboard\ReviewController::class);
        Route::post('/reviews/{id}/restore', [\App\Http\Controllers\Dashboard\ReviewController::class, 'restore'])->name('reviews.restore');

        Route::resource('/news_letters', \App\Http\Controllers\Dashboard\NewsLetterController::class);
        Route::post('/news_letters/{id}/restore', [\App\Http\Controllers\Dashboard\NewsLetterController::class, 'restore'])->name('news_letters.restore');

        Route::resource('/meta_tags', \App\Http\Controllers\Dashboard\MetaTagController::class);
        Route::post('/meta_tags/{id}/restore', [\App\Http\Controllers\Dashboard\MetaTagController::class, 'restore'])->name('meta_tags.restore');

        Route::resource('/redirects', \App\Http\Controllers\Dashboard\RedirectController::class);
        Route::post('/redirects/{id}/restore', [\App\Http\Controllers\Dashboard\RedirectController::class, 'restore'])->name('redirects.restore');

        Route::resource('/terms', \App\Http\Controllers\Dashboard\TermController::class);
        Route::post('/terms/{id}/restore', [\App\Http\Controllers\Dashboard\TermController::class, 'restore'])->name('terms.restore');

        Route::resource('/careers', \App\Http\Controllers\Dashboard\CareerController::class);
        Route::post('/careers/{id}/restore', [\App\Http\Controllers\Dashboard\CareerController::class, 'restore'])->name('careers.restore');

        Route::resource('/contact_uses', \App\Http\Controllers\Dashboard\ContactUsController::class);
        Route::post('/contact_uses/{id}/restore', [\App\Http\Controllers\Dashboard\ContactUsController::class, 'restore'])->name('contact_uses.restore');

        Route::resource('/sliders', \App\Http\Controllers\Dashboard\SliderController::class);
        Route::post('/sliders/{id}/restore', [\App\Http\Controllers\Dashboard\SliderController::class, 'restore'])->name('sliders.restore');

        Route::resource('/abouts', \App\Http\Controllers\Dashboard\AboutController::class);
        Route::post('/abouts/{id}/restore', [\App\Http\Controllers\Dashboard\AboutController::class, 'restore'])->name('abouts.restore');
    });

require __DIR__ . '/auth.php';