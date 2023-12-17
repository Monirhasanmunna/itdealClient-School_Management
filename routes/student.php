<?php

use App\Http\Controllers\Backend\Student\InitialSetup\ClassController;
use App\Http\Controllers\Backend\Student\InitialSetup\GroupController;
use App\Http\Controllers\Backend\Student\InitialSetup\SectionController;
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


        Route::group(['as'=>'section.','prefix'=>'section'],function(){
            Route::get('/',[SectionController::class,'index'])->name('index');
            Route::get('/get-section',[SectionController::class,'getSection'])->name('get-section');
            Route::post('/store',[SectionController::class,'store'])->name('store');
            Route::get('/edit/{id}',[SectionController::class,'edit']);
            Route::post('/update',[SectionController::class,'update'])->name('update');
            Route::any('/delete/{id}',[SectionController::class,'destroy']);
        });


        Route::group(['as'=>'group.','prefix'=>'group'],function(){
            Route::get('/',[GroupController::class,'index'])->name('index');
            Route::get('/get-group',[GroupController::class,'getGroup'])->name('get-group');
            Route::post('/store',[GroupController::class,'store'])->name('store');
            Route::get('/edit/{id}',[GroupController::class,'edit']);
            Route::post('/update',[GroupController::class,'update'])->name('update');
            Route::any('/delete/{id}',[GroupController::class,'destroy']);
        });


        Route::group(['as'=>'class.','prefix'=>'class'],function(){
            Route::get('/',[ClassController::class,'index'])->name('index');
            Route::get('/get-class',[ClassController::class,'getClass'])->name('get-class');
            Route::post('/store',[ClassController::class,'store'])->name('store');
            Route::get('/edit/{id}',[ClassController::class,'edit']);
            Route::post('/update',[ClassController::class,'update'])->name('update');
            Route::any('/delete/{id}',[ClassController::class,'destroy']);
        });

    });
});