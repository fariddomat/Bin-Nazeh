<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\BlogCategoryController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\ImageGalleryController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\SiteController;
use App\Livewire\UserForm;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";
});

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/services/{slug}', [SiteController::class, 'serviceShow'])->name('services.show');
Route::get('/project-categories', [SiteController::class, 'projectCategories'])->name('project-categories');
Route::get('/projectsCategory/{category?}', [SiteController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}', [SiteController::class, 'projectShow'])->name('projects.show');
Route::get('/blogs/{categorySlug?}', [SiteController::class, 'blogs'])->name('blogs.index');
Route::get('/blog/{slug}', [SiteController::class, 'blogShow'])->name('blogs.show');
Route::get('/register-interest', [SiteController::class, 'registerInterestCreate'])->name('register-interest');
Route::post('/register-interest', [SiteController::class, 'registerInterestStore'])->name('register-interest.store');
Route::get('/contact-us', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact-us', [SiteController::class, 'contactStore'])->name('contact.store');
Route::get('/search', [SiteController::class, 'search'])->name('search');
Route::post('/newsletter/subscribe', [SiteController::class, 'newsletter'])->name('newsletter.subscribe');
Route::post('/service-request', [SiteController::class, 'serviceRequest']);
Route::get('/terms', [SiteController::class, 'terms'])->name('terms');
Route::get('/privacy', [SiteController::class, 'privacy'])->name('privacy');

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


        Route::get('/imageGallery/browser', [ImageGalleryController::class, 'browser'])->name('imageGallery.browser');
        Route::post('/imageGallery/uploader', [ImageGalleryController::class, 'uploader'])->name('imageGallery.uploader');
    });

require __DIR__ . '/auth.php';
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('/facilities', \App\Http\Controllers\Dashboard\FacilityController::class);
    Route::post('/facilities/{id}/restore', [\App\Http\Controllers\Dashboard\FacilityController::class, 'restore'])->name('facilities.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('/social_media', \App\Http\Controllers\Dashboard\SocialMediaController::class);
    Route::post('/social_media/{id}/restore', [\App\Http\Controllers\Dashboard\SocialMediaController::class, 'restore'])->name('social_media.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('/privacies', \App\Http\Controllers\Dashboard\PrivacyController::class);
    Route::post('/privacies/{id}/restore', [\App\Http\Controllers\Dashboard\PrivacyController::class, 'restore'])->name('privacies.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('/infos', \App\Http\Controllers\Dashboard\InfoController::class);
    Route::post('/infos/{id}/restore', [\App\Http\Controllers\Dashboard\InfoController::class, 'restore'])->name('infos.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('/steps', \App\Http\Controllers\Dashboard\StepController::class);
    Route::post('/steps/{id}/restore', [\App\Http\Controllers\Dashboard\StepController::class, 'restore'])->name('steps.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('/orders', \App\Http\Controllers\Dashboard\OrderController::class);
    Route::post('/orders/{id}/restore', [\App\Http\Controllers\Dashboard\OrderController::class, 'restore'])->name('orders.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('projects.apartments', \App\Http\Controllers\Dashboard\ApartmentController::class)
        ->parameters(['projects' => 'project', 'apartments' => 'apartment']);
    Route::post('projects/{project}/apartments/{apartment}/restore', [\App\Http\Controllers\Dashboard\ApartmentController::class, 'restore'])
        ->name('projects.apartments.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('projects.project_images', \App\Http\Controllers\Dashboard\ProjectImageController::class)
        ->parameters(['projects' => 'project', 'project_images' => 'projectImage']);
    Route::post('projects/{project}/project_images/{projectImage}/restore', [\App\Http\Controllers\Dashboard\ProjectImageController::class, 'restore'])
        ->name('projects.project_images.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('projects.project_pdfs', \App\Http\Controllers\Dashboard\ProjectPdfController::class)
        ->parameters(['projects' => 'project', 'project_pdfs' => 'projectPdf']);
    Route::post('projects/{project}/project_pdfs/{projectPdf}/restore', [\App\Http\Controllers\Dashboard\ProjectPdfController::class, 'restore'])
        ->name('projects.project_pdfs.restore');
});
Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::resource('projects.project_pdf2s', \App\Http\Controllers\Dashboard\ProjectPdf2Controller::class)
        ->parameters(['projects' => 'project', 'project_pdf2s' => 'projectPdf2']);
    Route::post('projects/{project}/project_pdf2s/{projectPdf}/restore', [\App\Http\Controllers\Dashboard\ProjectPdf2Controller::class, 'restore'])
        ->name('projects.project_pdfs.restore');
});
