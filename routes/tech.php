<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Tech\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::group(['middleware'=>['auth','user.type:tech'],'prefix'=>'/tech','as'=>'tech.'],function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');
});
