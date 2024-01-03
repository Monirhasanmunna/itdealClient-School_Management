<?php

use App\Http\Controllers\Backend\HRM\DepartmentController;
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
});