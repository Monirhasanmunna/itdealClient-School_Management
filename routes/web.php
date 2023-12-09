<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\Student\Lottery\LotteryStudentController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])->group(function () {
    //dashboard route
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::group(['as'=>'lottery.','prefix'=>'lottery'],function(){
        Route::get('/student-entry',[LotteryStudentController::class,'index'])->name('student-entry');
        Route::post('/store',[LotteryStudentController::class,'store'])->name('store');
    });

require __DIR__.'/userManagement.php';
require __DIR__.'/student.php';

});


require __DIR__.'/auth.php';


