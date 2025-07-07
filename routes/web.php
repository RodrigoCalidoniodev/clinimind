<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HourController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\Admin;

// Home route
Route::get('/', HomeController::class)->name('home');

// Pages routesRoute::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');


// HourController routes
Route::resource('hours', HourController::class)->middleware(['auth', 'verified', 'admin'])->names('hours');

// ServiceController routes
Route::resource('services', ServiceController::class)->middleware(['auth', 'verified', 'admin'])->names('services');

// Appointment routes
Route::resource('appointments', AppointmentController::class)->middleware(['auth', 'verified', 'admin'])->names('appointments');

// Admin routes
Route::resource('admin', AdminController::class)->middleware(['auth', 'verified', 'admin'])->names('admin');

// Client routes
Route::resource('client', ClientController::class)->middleware(['auth', 'verified'])->names('client');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
