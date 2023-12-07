<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth', 'verified'])->group(function () {
    //dashboard route
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


require __DIR__.'/userManagement.php';

});


require __DIR__.'/auth.php';


