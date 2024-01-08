<?php

use App\Http\Controllers\Backend\HRM\DepartmentController;
use App\Http\Controllers\Backend\HRM\DesignationController;
use App\Http\Controllers\Backend\HRM\StaffController;
use App\Http\Controllers\Backend\HRM\TeacherController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix'=>'hrm'],function(){
    Route::group(['as'=>'department.', 'prefix'=>'department'],function(){
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/get-department', [DepartmentController::class, 'getDepartment'])->name('get-department');
        Route::post('/store', [DepartmentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
        Route::post('/update', [DepartmentController::class, 'update'])->name('update');
        Route::any('/delete/{id}', [DepartmentController::class, 'destroy'])->name('delete');
    });

    Route::group(['as'=>'designation.', 'prefix'=>'designation'],function(){
        Route::get('/', [DesignationController::class, 'index'])->name('index');
        Route::get('/get-designation', [DesignationController::class, 'getDesignation'])->name('get-designation');
        Route::post('/store', [DesignationController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DesignationController::class, 'edit'])->name('edit');
        Route::post('/update', [DesignationController::class, 'update'])->name('update');
        Route::any('/delete/{id}', [DesignationController::class, 'destroy'])->name('delete');
    });


    Route::group(['as'=>'staff.', 'prefix'=>'staff'],function(){
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::get('/create', [StaffController::class, 'create'])->name('create');
        Route::post('/get-staff', [StaffController::class, 'getStaff'])->name('get-staff');
        Route::post('/store', [StaffController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [StaffController::class, 'update'])->name('update');
        Route::any('/delete/{id}', [StaffController::class, 'destroy'])->name('delete');

        Route::get('/get-designations/{id}', [StaffController::class, 'getDesignation']);
    });

}); 