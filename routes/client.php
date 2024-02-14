<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::group(['middleware'=>['auth','user.type:user'],'prefix'=>'/client','as'=>'client.'],function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');
});
