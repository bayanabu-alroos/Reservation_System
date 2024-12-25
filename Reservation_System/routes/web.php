<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ViewController;


// Route::get('/', function () {
    // return view('welcome');
// });
Route::get('/', [ViewController::class, 'SelectAllProperties'])->name('home');
Route::get('/showproperty/{id}', [HomeController::class, 'PropertyReservation'])->name('showproperty');
Auth::routes();


// admin route
Route::middleware(['auth','user-access:admin'])->group(function(){
    Route::get('/admin_dashboard', action: [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::resource('properties', PropertyController::class);

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index'); // Home page with all bookings

Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create'); // Form for creating a new booking
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store'); // Store a new booking
Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show'); // Show a specific booking
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit'); // Form for editing an existing booking
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::post('/bookings/{id}/rejected', [BookingController::class, 'rejected'])->name('bookings.rejected');

Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy'); // Delete a booking

// user  route
Route::middleware(['auth','user-access:user'])->group(function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

});
