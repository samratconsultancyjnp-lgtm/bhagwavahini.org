<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/team', [FrontendController::class, 'team'])->name('team');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/events', [FrontendController::class, 'events'])->name('events');
Route::get('/events/{id}', [FrontendController::class, 'eventShow'])->name('event.show');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');
Route::get('/join', [FrontendController::class, 'join'])->name('join');
Route::post('/join', [FrontendController::class, 'submitJoin'])->name('join.submit');

Route::post('/join/payment/verify', [FrontendController::class, 'verifyPayment'])->name('join.payment.verify');

// Download ID Card Routes
Route::get('/download-id', [FrontendController::class, 'downloadId'])->name('download.id');
Route::post('/download-id', [FrontendController::class, 'processDownloadId'])->name('download.id.process');

Route::get('/donations', [FrontendController::class, 'donations'])->name('donations');
Route::post('/donations', [FrontendController::class, 'submitDonation'])->name('donations.submit');
Route::get('/donations/status', [FrontendController::class, 'checkDonationStatus'])->name('donations.status');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Sliders
    Route::get('/sliders', [AdminController::class, 'slidersIndex'])->name('sliders.index');
    Route::post('/sliders', [AdminController::class, 'slidersStore'])->name('sliders.store');
    Route::get('/sliders/{id}/edit', [AdminController::class, 'slidersEdit'])->name('sliders.edit');
    Route::put('/sliders/{id}', [AdminController::class, 'slidersUpdate'])->name('sliders.update');
    Route::delete('/sliders/{id}', [AdminController::class, 'slidersDestroy'])->name('sliders.destroy');

    // Team
    Route::get('/team', [AdminController::class, 'teamIndex'])->name('team.index');
    Route::post('/team', [AdminController::class, 'teamStore'])->name('team.store');
    Route::delete('/team/{id}', [AdminController::class, 'teamDestroy'])->name('team.destroy');

    // Gallery
    Route::get('/gallery', [AdminController::class, 'galleryIndex'])->name('gallery.index');
    Route::post('/gallery', [AdminController::class, 'galleryStore'])->name('gallery.store');
    Route::delete('/gallery/{id}', [AdminController::class, 'galleryDestroy'])->name('gallery.destroy');

    // Events
    Route::get('/events', [AdminController::class, 'eventsIndex'])->name('events.index');
    Route::post('/events', [AdminController::class, 'eventsStore'])->name('events.store');
    Route::delete('/events/{id}', [AdminController::class, 'eventsDestroy'])->name('events.destroy');

    // Members
    Route::get('/members', [AdminController::class, 'membersIndex'])->name('members.index');
    Route::get('/members/{id}/idcard', [AdminController::class, 'memberIdCard'])->name('members.idcard');
    Route::post('/members/{id}/approve', [AdminController::class, 'membersApprove'])->name('members.approve');
    Route::delete('/members/{id}', [AdminController::class, 'membersDestroy'])->name('members.destroy');

    // Contacts
    Route::get('/contacts', [AdminController::class, 'contactsIndex'])->name('contacts.index');
    Route::delete('/contacts/{id}', [AdminController::class, 'contactsDestroy'])->name('contacts.destroy');

    // Designations
    Route::get('/designations', [AdminController::class, 'designationsIndex'])->name('designations.index');
    Route::post('/designations', [AdminController::class, 'designationsStore'])->name('designations.store');
    Route::delete('/designations/{id}', [AdminController::class, 'designationsDestroy'])->name('designations.destroy');

    // Donations
    Route::get('/donations', [AdminController::class, 'donationsIndex'])->name('donations.index');
    Route::post('/donations/{id}/approve', [AdminController::class, 'donationsApprove'])->name('donations.approve');
    Route::post('/donations/{id}/reject', [AdminController::class, 'donationsReject'])->name('donations.reject');
    Route::delete('/donations/{id}', [AdminController::class, 'donationsDestroy'])->name('donations.destroy');
    Route::get('/donations/{id}/slip', [AdminController::class, 'donationSlip'])->name('donations.slip');


    // Settings (Razorpay, etc.)
    Route::get('/settings', [AdminController::class, 'settingsIndex'])->name('settings.index');
    Route::post('/settings', [AdminController::class, 'settingsUpdate'])->name('settings.update');
});

// For default auth routes like login, logout
require __DIR__.'/auth.php';
