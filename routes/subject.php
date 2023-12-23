<?php

use App\Http\Controllers\Backend\Subject\SubjectController;
use Illuminate\Support\Facades\Route;



Route::group(['as'=>'subject.','prefix'=>'subject'],function(){

    Route::get('/',[SubjectController::class,'index'])->name('index');
    Route::get('/create',[SubjectController::class,'create'])->name('create');
    Route::post('/store',[SubjectController::class,'store'])->name('store');
    Route::get('/edit/{id}',[SubjectController::class,'edit'])->name('edit');
    Route::post('/update/',[SubjectController::class,'update'])->name('update');
    Route::any('/delete/{id}',[SubjectController::class,'destroy'])->name('delete');

    Route::get('/get-subject/',[SubjectController::class,'getSubject'])->name('get-subject');

});