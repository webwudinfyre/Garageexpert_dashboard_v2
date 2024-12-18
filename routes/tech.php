<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Tech\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tech\JobAllocation;
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

            Route::get('/joballocation/job_view/{id}', [JobAllocation::class, 'job_view'])->name('joballocation.job_view');

            Route::get('/joballocation/job_taken/', [JobAllocation::class, 'job_taken'])->name('joballocation.job_taken');
            Route::get('/joballocation/Technician_name/', [JobAllocation::class, 'Technician_name'])->name('joballocation.Technician_name');
            Route::get('/joballocation/job_assign/', [JobAllocation::class, 'job_assign'])->name('joballocation.job_assign');


            Route::get('/joballocation/myjob_list', [JobAllocation::class, 'myjob_list'])->name('joballocation.myjob_list');
            Route::get('/joballocation/myjob_search/', [JobAllocation::class, 'myjob_search'])->name('joballocation.myjobsearch');


            Route::get('/joballocation/search_client_names', [JobAllocation::class, 'search_client_names'])->name('joballocation.search_client_names');

            Route::get('/joballocation/jobinstall/{id}', [JobAllocation::class, 'jobinstall'])->name('joballocation.jobinstall');

            Route::get('/joballocation/job_pdf_dowmload/{id}', [JobAllocation::class, 'jobpdfdowmload'])->name('joballocation.job_pdf_dowmload');

            Route::get('/joballocation/myjob_list_each_task/{id}', [JobAllocation::class, 'myjob_list_each_task'])->name('joballocation.myjob_list_each_task');



            Route::post('/save-signature', [JobAllocation::class, 'signature_save'])->name('signature.save');

            Route::get('/joballocation/mark_as_read_all/{id}', [JobAllocation::class, 'mark_as_read_all'])->name('joballocation.mark_as_read_all');
        }
    );
Route::get('/tasks_1', [JobAllocation::class, 'index_task']);

Route::get('/get_event_details_1', [JobAllocation::class, 'get_event_details']);
