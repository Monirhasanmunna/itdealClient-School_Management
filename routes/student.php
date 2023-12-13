<?php

use App\Http\Controllers\Backend\Student\InitialSetup\SessionController;
use Illuminate\Support\Facades\Route;



Route::group(['as'=>'student.','prefix'=>'student'],function(){

    Route::group(['as'=>'setting.','prefix'=>'initial-setup'],function(){

        Route::group(['as'=>'session.','prefix'=>'academic-year'],function(){
            Route::get('/',[SessionController::class,'index'])->name('index');
            Route::get('/get-sessions',[SessionController::class,'getSessions'])->name('get-sessions');
            Route::post('/store',[SessionController::class,'store'])->name('store');
            Route::get('/edit/{id}',[SessionController::class,'edit']);
            Route::post('/update',[SessionController::class,'update'])->name('update');
            Route::any('/delete/{id}',[SessionController::class,'destroy']);
        });

    });
});