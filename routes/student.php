<?php

use App\Http\Controllers\Backend\Student\InitialSetup\SessionController;
use Illuminate\Support\Facades\Route;



Route::group(['as'=>'student.','prefix'=>'student'],function(){

    Route::group(['as'=>'setting.','prefix'=>'initial-setup'],function(){

        Route::group(['as'=>'session.','prefix'=>'academic-year'],function(){
            Route::get('/',[SessionController::class,'index'])->name('index');
        });

    });
});