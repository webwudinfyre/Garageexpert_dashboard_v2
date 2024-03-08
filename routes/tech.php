<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Tech\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\tech\JobAllocation;
use App\Http\Controllers\Tech\profile;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['auth', 'user.type:tech'], 'prefix' => '/tech', 'as' => 'tech.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});



Route::middleware(['auth', 'user.type:tech'])
    ->prefix('tech')
    ->name('tech.')
    ->group(
        function () {




            Route::post('/registration/tech/profilecreatesocial/{id}', [profile::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreatesocial');
            Route::post('/registration/tech/profilecreate/{id}', [profile::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreate');
            Route::post('/registration/tech/profilebasic_details/{id}', [profile::class, 'tech_profilebasic_details'])->name('registration.tech.profilebasic_details');
            Route::get('/registration/tech/profile/{id}', [profile::class, 'tech_profile'])->name('registration.techprofile');

            Route::get('/registration/tech/profilemain/{id}', [profile::class, 'tech_profile_main'])->name('registration.techprofilemain');


            // ----------------------------------------Job Allocation---------------------------------//
            Route::get('/joballocation/view', [JobAllocation::class, 'view'])->name('joballocation.view');
            Route::get('/joballocation/find_client', [JobAllocation::class, 'find_client'])->name('joballocation.find_client');
            Route::get('/joballocation/Equipment_job', [JobAllocation::class, 'Equipment_job'])->name('joballocation.Equipment_job');

            Route::get('/joballocation/update', [JobAllocation::class, 'update'])->name('joballocation.update');

            
            Route::get('/joballocation/job_list', [JobAllocation::class, 'job_list'])->name('joballocation.job_list');

            Route::get('/joballocation/job_list_view/{id}', [JobAllocation::class, 'job_list_view'])->name('joballocation.job_list_view');
            Route::get('/joballocation/search/', [JobAllocation::class, 'job_search'])->name('joballocation.search');


            Route::get('/joballocation/notification/', [JobAllocation::class, 'notificationmarak'])->name('joballocation.notification');
            Route::get('/joballocation/mark_as_read/{id}', [JobAllocation::class, 'mark_as_read'])->name('joballocation.mark_as_read');
        }
    );
