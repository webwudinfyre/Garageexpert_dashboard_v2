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

    // Use proper route name and correct route definition
    //user Admin
    Route::get('/registration/admin', [RegistrationController::class, 'admin_index'])->name('registration.admindetails');
    Route::POST('/registration/admin/create', [RegistrationController::class, 'admin_create'])->name('registration.admincreate');  //admin user add


    Route::get('/registration/client', [RegistrationController::class, 'client_index'])->name('registration.clientdetails');


    Route::get('/registration/tech', [RegistrationController::class, 'tech_index'])->name('registration.techdetails');
    Route::POST('/registration/tech/create', [RegistrationController::class, 'tech_create'])->name('registration.techcreate');  //tech add

});
