<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;

Route::get('/', [WebsiteController::class, 'index'])->name('index');
Route::get('/former-governor', [WebsiteController::class, 'formerGovernor'])->name('former-governor');
Route::get('/organogram', [WebsiteController::class, 'organogram'])->name('organogram');
Route::get('/principal-secretaries', [WebsiteController::class, 'formerSecretory'])->name('former-secretory');
Route::get('/military-secretary', [WebsiteController::class, 'militarySecretary'])->name('military-secretary');
Route::get('/officers', [WebsiteController::class, 'officers'])->name('officers');
Route::get('/governor-house-visitors', [WebsiteController::class, 'visitors'])->name('visitors');
Route::get('/history', [WebsiteController::class, 'history'])->name('history');
Route::get('/news', [WebsiteController::class, 'news'])->name('news');
Route::get('/news-detail/{slug}', [WebsiteController::class, 'newsDetail'])->name('news-detail');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::post('/contact', [WebsiteController::class, 'contactStore'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('sliders', \App\Http\Controllers\SliderController::class);
    Route::patch('/sliders/{slider}/toggle-active', [\App\Http\Controllers\SliderController::class, 'toggleActive'])->name('sliders.toggle-active');
    Route::resource('global-impacts', \App\Http\Controllers\GlobalImpactController::class);
    Route::patch('/global-impacts/{global_impact}/toggle-active', [\App\Http\Controllers\GlobalImpactController::class, 'toggleActive'])->name('global-impacts.toggle-active');
    Route::resource('key-initiatives', \App\Http\Controllers\KeyInitiativeController::class);
    Route::patch('/key-initiatives/{key_initiative}/toggle-active', [\App\Http\Controllers\KeyInitiativeController::class, 'toggleActive'])->name('key-initiatives.toggle-active');
    
    // Governor Message Admin Route
    Route::resource('governor-messages', \App\Http\Controllers\GovernorMessageController::class);
    Route::patch('/governor-messages/{governor_message}/toggle-active', [\App\Http\Controllers\GovernorMessageController::class, 'toggleActive'])->name('governor-messages.toggle-active');

    // Talk to Governor Admin Route
    Route::resource('talk-to-governors', \App\Http\Controllers\TalkToGovernorController::class)->only(['index', 'destroy']);

    // Contact Us Messages Admin Route
    Route::resource('contact-us', \App\Http\Controllers\ContactUsController::class)->only(['index', 'destroy']);

    // News and Events Admin Route
    Route::resource('new-and-events', \App\Http\Controllers\NewAndEventController::class);

    // Governors and Secretaries Admin Routes
    Route::resource('governors', \App\Http\Controllers\GovernorController::class);
    Route::resource('secretaries', \App\Http\Controllers\SecretaryController::class);

    // Newsletters Admin Route
    Route::resource('news-letters', \App\Http\Controllers\NewsLetterController::class);

    // Visitors Admin Route
    Route::resource('visitors', \App\Http\Controllers\VisitorController::class);
});

// Talk to Governor Frontend Submission
Route::post('/talk-to-governor', [\App\Http\Controllers\TalkToGovernorController::class, 'store'])->name('talk-to-governor.store');
Route::get('/news-letter-detail/{slug}', [\App\Http\Controllers\WebsiteController::class, 'newsLetterDetail'])->name('news-letter-detail');

require __DIR__.'/auth.php';
