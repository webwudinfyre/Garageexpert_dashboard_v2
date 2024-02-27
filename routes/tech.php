<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Tech\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tech\profile;
use Illuminate\Support\Facades\Route;




Route::group(['middleware'=>['auth','user.type:tech'],'prefix'=>'/tech','as'=>'tech.'],function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');
});



Route::middleware(['auth', 'user.type:tech'])
    ->prefix('tech')
    ->name('tech.')
    ->group(function () {




        Route::post('/registration/tech/profilecreatesocial/{id}', [profile::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreatesocial');
        Route::post('/registration/tech/profilecreate/{id}', [profile::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreate');
        Route::post('/registration/tech/profilebasic_details/{id}', [profile::class, 'tech_profilebasic_details'])->name('registration.tech.profilebasic_details');
        Route::get('/registration/tech/profile/{id}', [profile::class, 'tech_profile'])->name('registration.techprofile');

        Route::get('/registration/tech/profilemain/{id}', [profile::class, 'tech_profile_main'])->name('registration.techprofilemain');

    }
);
