<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





Route::group(['middleware'=>['auth','user.type:admin'],'prefix'=>'/admin','as'=>'admin.'],function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');
});
