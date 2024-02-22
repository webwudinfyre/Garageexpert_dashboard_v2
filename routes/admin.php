<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RegistrationController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'user.type:admin'])
->prefix('admin')
->name('admin.')
->group(function ()
 {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/passwordchange/{id}', [RegistrationController::class, 'passwordchange'])->name('passwordchange');//password change | status ajax
    Route::post('/passwordupdae', [RegistrationController::class, 'passwordupdae'])->name('passwordupdate');
    Route::post('/updateStatus', [RegistrationController::class, 'updateStatus'])->name('updateStatus');


    // Use proper route name and correct route definition
    //user Admin
    Route::get('/registration/admin', [RegistrationController::class, 'admin_index'])->name('registration.admindetails');
    Route::POST('/registration/admin/create', [RegistrationController::class, 'admin_create'])->name('registration.admincreate');  //admin user add





    Route::get('/registration/client', [RegistrationController::class, 'client_index'])->name('registration.clientdetails');
    Route::POST('/registration/client/create', [RegistrationController::class, 'client_create'])->name('registration.clientcreate');  //tech add
    Route::get('/check-email-availability-client', [RegistrationController::class, 'CheckEmailAvailabilityClient']);


    Route::get('/registration/tech', [RegistrationController::class, 'tech_index'])->name('registration.techdetails');
    Route::POST('/registration/tech/create', [RegistrationController::class, 'tech_create'])->name('registration.techcreate');  //tech add




});

