<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\profile;
use App\Http\Controllers\Client\Reports;
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


        //     --------------------------------------------------------------------------------------------------------------------------

        Route::get('/office/client/office_list/{id}', [Reports::class, 'office_list'])->name('client.office_list');


        Route::get('/joballocation/job_list_view/{id}', [Reports::class, 'job_list_view'])->name('joballocation.job_list_view');
        Route::get('/joballocation/mark_as_read/{id}', [Reports::class, 'mark_as_read'])->name('joballocation.mark_as_read');

        Route::get('report/prdct_view_task/{id}', [Reports::class, 'prdct_view_task'])->name('reports.prdct_view_task');
        Route::get('/report/task_list_view/{id}', [Reports::class, 'task_list_view'])->name('report.task_list_view');

        Route::get('/report/taskpdfdowmload/{id}', [Reports::class, 'taskpdfdowmload'])->name('report.taskpdfdowmload');
        Route::get('/joballocation/job_pdf_dowmload/{id}', [Reports::class, 'jobpdfdowmload'])->name('joballocation.job_pdf_dowmload');


        //     --------------------------------------------------------------------------------------------------------------------------

        Route::get('/client/Review/{id}', [Reports::class, 'client_review'])->name('client.client_review');
        Route::get('/client/Review_edit/{id}', [Reports::class, 'client_review_edit'])->name('client.client_review_edit');

        Route::Post('/client/update', [Reports::class, 'update'])->name('client.review.update');

        Route::get('/client/tracking_details', [Reports::class, 'tracking_details'])->name('client.tracking_details');


        Route::get('/joballocation/mark_as_read_all/{id}', [Reports::class, 'mark_as_read_all'])->name('joballocation.mark_as_read_all');



    });
