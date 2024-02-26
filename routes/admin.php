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
    Route::get('/registration/admin/profile/{id}', [RegistrationController::class, 'admin_profile'])->name('registration.admindprofile');

    Route::post('/registration/admin/profilecreatesocial/{id}', [RegistrationController::class, 'admin_profilecreate_social'])->name('registration.profilecreatesocial');
    Route::post('/registration/admin/profilecreate/{id}', [RegistrationController::class, 'admin_profilecreate_social'])->name('registration.profilecreate');
    Route::post('/registration/admin/profilebasic_details/{id}', [RegistrationController::class, 'admin_profilebasic_details'])->name('registration.profilebasic_details');



    Route::get('/registration/client', [RegistrationController::class, 'client_index'])->name('registration.clientdetails');
    Route::POST('/registration/client/create', [RegistrationController::class, 'client_create'])->name('registration.clientcreate');  //tech add
    Route::get('/check-email-availability-client', [RegistrationController::class, 'CheckEmailAvailabilityClient']);

    Route::get('/registration/client/profile/{id}', [RegistrationController::class, 'client_profile'])->name('registration.clientprofile');
     Route::post('/registration/client/profilecreatesocial/{id}', [RegistrationController::class, 'client_profilecreate_social'])->name('registration.client.profilecreatesocial');
    Route::post('/registration/client/profilecreate/{id}', [RegistrationController::class, 'client_profilecreate_social'])->name('registration.client.profilecreate');
    Route::post('/registration/client/profilebasic_details/{id}', [RegistrationController::class, 'client_profilebasic_details'])->name('registration.client.profilebasic_details');

    
    Route::get('/registration/tech', [RegistrationController::class, 'tech_index'])->name('registration.techdetails');
    Route::POST('/registration/tech/create', [RegistrationController::class, 'tech_create'])->name('registration.techcreate');  //tech add

    Route::post('/registration/tech/profilecreatesocial/{id}', [RegistrationController::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreatesocial');
    Route::post('/registration/tech/profilecreate/{id}', [RegistrationController::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreate');
    Route::post('/registration/tech/profilebasic_details/{id}', [RegistrationController::class, 'tech_profilebasic_details'])->name('registration.tech.profilebasic_details');
    Route::get('/registration/tech/profile/{id}', [RegistrationController::class, 'tech_profile'])->name('registration.techprofile');


});

