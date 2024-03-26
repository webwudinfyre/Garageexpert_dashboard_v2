<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Equipments;
use App\Http\Controllers\Admin\JobAllocation;
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

    Route::get('/registration/admin/profilemain/{id}', [RegistrationController::class, 'admin_profile_main'])->name('registration.admindprofilemain');


    Route::get('/registration/client', [RegistrationController::class, 'client_index'])->name('registration.clientdetails');
    Route::POST('/registration/client/create', [RegistrationController::class, 'client_create'])->name('registration.clientcreate');  //tech add
    Route::get('/check-email-availability-client', [RegistrationController::class, 'CheckEmailAvailabilityClient']);

    Route::get('/registration/client/profile/{id}', [RegistrationController::class, 'client_profile'])->name('registration.clientprofile');
     Route::post('/registration/client/profilecreatesocial/{id}', [RegistrationController::class, 'client_profilecreate_social'])->name('registration.client.profilecreatesocial');
    Route::post('/registration/client/profilecreate/{id}', [RegistrationController::class, 'client_profilecreate_social'])->name('registration.client.profilecreate');
    Route::post('/registration/client/profilebasic_details/{id}', [RegistrationController::class, 'client_profilebasic_details'])->name('registration.client.profilebasic_details');

    Route::post('/registration/client/suboffice/{id}', [RegistrationController::class, 'client_profilebasic_suboffice'])->name('registration.clientcreate.suboffice');


    Route::get('/registration/tech', [RegistrationController::class, 'tech_index'])->name('registration.techdetails');
    Route::POST('/registration/tech/create', [RegistrationController::class, 'tech_create'])->name('registration.techcreate');  //tech add

    Route::post('/registration/tech/profilecreatesocial/{id}', [RegistrationController::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreatesocial');
    Route::post('/registration/tech/profilecreate/{id}', [RegistrationController::class, 'tech_profilecreate_social'])->name('registration.tech.profilecreate');
    Route::post('/registration/tech/profilebasic_details/{id}', [RegistrationController::class, 'tech_profilebasic_details'])->name('registration.tech.profilebasic_details');
    Route::get('/registration/tech/profile/{id}', [RegistrationController::class, 'tech_profile'])->name('registration.techprofile');



    // ----------------------------------------equip---------------------------------//
    Route::get('/equipments/view', [Equipments::class, 'view'])->name('equipments.view');
    Route::post('/equipments/equipment_create', [Equipments::class, 'equipment_create'])->name('equipment.create');
    Route::post('/equipments/equipment_update', [Equipments::class, 'equipment_update'])->name('equipment.update');
    Route::get('/equipments_view/{id}', [Equipments::class, 'equipments_view']);
    Route::post('/equipments/equipment_delete', [Equipments::class, 'equipment_delete'])->name('equipment.delete');


    // ----------------------------------------Job Allocation---------------------------------//
    Route::get('/joballocation/view', [JobAllocation::class, 'view'])->name('joballocation.view');
    Route::get('/joballocation/find_client', [JobAllocation::class, 'find_client'])->name('joballocation.find_client');
    Route::get('/joballocation/product_code', [JobAllocation::class, 'product_code'])->name('joballocation.product_code');
    Route::get('/joballocation/serial_no', [JobAllocation::class, 'serial_no'])->name('joballocation.serial_no');
    Route::get('/joballocation/Equipment_job', [JobAllocation::class, 'Equipment_job'])->name('joballocation.Equipment_job');

    Route::get('/joballocation/update', [JobAllocation::class, 'update'])->name('joballocation.update');
    Route::get('/joballocation/job_list', [JobAllocation::class, 'job_list'])->name('joballocation.job_list');

    Route::get('/joballocation/job_list_view/{id}', [JobAllocation::class, 'job_list_view'])->name('joballocation.job_list_view');
    Route::get('/joballocation/search/', [JobAllocation::class, 'job_search'])->name('joballocation.search');


    Route::get('/joballocation/notification/', [JobAllocation::class, 'notificationmarak'])->name('joballocation.notification');
    Route::get('/joballocation/mark_as_read/{id}', [JobAllocation::class, 'mark_as_read'])->name('joballocation.mark_as_read');
    Route::get('/joballocation/job_pdf_dowmload/{id}', [JobAllocation::class, 'jobpdfdowmload'])->name('joballocation.job_pdf_dowmload');

    Route::get('/joballocation/job_list_each_task/{id}', [JobAllocation::class, 'job_list_each_task'])->name('joballocation.job_list_each_task');

    // href="{{ route('admin.joballocation.job_list_view', ['id' => encrypt($prdt_task->product_id)]) }}"
});

