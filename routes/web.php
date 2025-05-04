<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Doctor;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Client\HealthRecordController;
use App\Http\Controllers\Client\BookingController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Client\ReviewController as ClientReviewController;
use App\Http\Controllers\Doctor\ReviewController as DoctorReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Client\FoodSearchController;


Route::get('/test', function () {

    $user = Auth::user();
    $client = UserService::resolveUserInstance($user);



    return $client->healthRecords()->latest()->take(3)->get();

});


Route::get('/', [DashboardController::class, 'homePage'])->name('home');
Route::get('/home', [DashboardController::class, 'homePage'])->name('home');

// Suspension notice and contact pages
Route::get('/suspension-notice', function() {
    return view('suspension-notice');
})->name('suspension.notice')->middleware('ensure.suspended');

Route::get('/activation-notice', function() {
    return view('activation-notice');
})->name('activation.notice')->middleware('ensure.inactive.doctor');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Profile update routes
    Route::put('/profile/update/basic', [ProfileController::class, 'updateBasicInfo'])->name('profile.update.basic');
    Route::put('/profile/update/contact', [ProfileController::class, 'updateContactInfo'])->name('profile.update.contact');
    Route::put('/profile/update/health', [ProfileController::class, 'updateHealthInfo'])->name('profile.update.health');
    Route::put('/profile/update/photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.update.photo');
    Route::put('/profile/update/professional', [ProfileController::class, 'updateProfessionalInfo'])->middleware('role:admin')->name('profile.update.professional');
    
    // Health Records routes
    Route::middleware('role:client')->group(function () {
        Route::resource('health-records', HealthRecordController::class)->except(['show']);
        Route::get('health-records/{healthRecord}', [HealthRecordController::class, 'show'])->name('health-records.show');
        Route::delete('/health-records/{healthRecord}/files/{file}', [HealthRecordController::class, 'deleteFile'])->name('health-records.files.delete');
    });
    
    // Doctor specific routes
    Route::middleware('role:doctor')->prefix('doctor')->name('doctor.')->group(function () {
        // Doctor schedules routes
        Route::get('schedules', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::post('schedules/day/{day}', [ScheduleController::class, 'updateDay'])->name('schedules.update-day');
        Route::post('schedules/update-all', [ScheduleController::class, 'updateAll'])->name('schedules.update-all');
        
        // Doctor appointments routes
        Route::get('appointments', [DoctorAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('appointments/{appointment}', [DoctorAppointmentController::class, 'show'])->name('appointments.show');
        Route::patch('appointments/{appointment}/status', [DoctorAppointmentController::class, 'updateStatus'])->name('appointments.update-status');
        
        // Reviews
        Route::get('/reviews', [DoctorReviewController::class, 'index'])->name('reviews.index');
    });
    
    // Admin specific routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // User management routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/suspended', [UserController::class, 'suspended'])->name('users.suspended');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/suspend', [UserController::class, 'suspend'])->name('users.suspend');
        Route::get('/users/{user}/unsuspend', [UserController::class, 'unsuspend'])->name('users.unsuspend');
        
        // Inactive doctors management
        Route::get('/doctors/inactive', [UserController::class, 'inactiveDoctors'])->name('doctors.inactive');
        Route::get('/users/{user}/activate', [UserController::class, 'activateDoctor'])->name('users.activate');
    });
    
    // Client routes
    Route::middleware(['auth', 'role:client'])->name('client.')->prefix('client')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'clientDashboard'])->name('dashboard');
        
        // Health Records
        Route::resource('health-records', HealthRecordController::class)->except(['show']);
        
        // Booking
        Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
        Route::get('/booking/doctor/{doctor}', [BookingController::class, 'doctor'])->name('booking.doctor');
        Route::get('/booking/doctor/{doctor}/schedule', [BookingController::class, 'schedule'])->name('booking.schedule');
        Route::post('/booking/appointments', [BookingController::class, 'storeAppointment'])->name('booking.store');
        Route::post('/booking/check-availability', [BookingController::class, 'checkAvailability'])->name('booking.check-availability');
        
        // Appointments
        Route::resource('appointments', ClientAppointmentController::class)->only(['index', 'show']);
        Route::delete('appointments/{appointment}/cancel', [ClientAppointmentController::class, 'cancel'])->name('appointments.cancel');
        
        // Reviews
        Route::post('/reviews', [ClientReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/reviews/{review}', [ClientReviewController::class, 'destroy'])->name('reviews.delete');
    });

    // Food search route
    Route::get('/food-search', [FoodSearchController::class, 'index'])->name('food.search');
    Route::post('/food-search/query', [FoodSearchController::class, 'search'])->name('food.search.query');
});
