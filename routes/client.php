<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\profile;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['auth', 'user.type:user'], 'prefix' => '/client', 'as' => 'client.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});


Route::middleware(['auth', 'user.type:user'])
    ->prefix('client')
    ->name('client.')
    ->group(function () {

        Route::get('/registration/client/profile/{id}', [profile::class, 'client_profile'])->name('registration.clientprofile');
        Route::get('/passwordchange/{id}', [profile::class, 'passwordchange'])->name('passwordchange'); //password change | status ajax
        Route::post('/passwordupdae', [profile::class, 'passwordupdae'])->name('passwordupdate');
        Route::post('/updateStatus', [profile::class, 'updateStatus'])->name('updateStatus');

        Route::get('/registration/client/profilemain/{id}', [profile::class, 'client_profile_main'])->name('registration.clientdprofilemain');
        Route::get('/check-email-availability-client', [profile::class, 'CheckEmailAvailabilityClient']);
        Route::post('/registration/client/profilecreatesocial/{id}', [profile::class, 'client_profilecreate_social'])->name('registration.client.profilecreatesocial');
        Route::post('/registration/client/profilecreate/{id}', [profile::class, 'client_profilecreate_social'])->name('registration.client.profilecreate');
        Route::post('/registration/client/profilebasic_details/{id}', [profile::class, 'client_profilebasic_details'])->name('registration.client.profilebasic_details');
        Route::post('/registration/client/suboffice/{id}', [profile::class, 'client_profilebasic_suboffice'])->name('registration.clientcreate.suboffice');
    });
