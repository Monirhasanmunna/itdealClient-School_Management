<?php

use App\Http\Controllers\Backend\Expense\ExpenseCategoryController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'expense.', 'prefix' => 'expense'], function(){

    Route::group(['as' => 'category.', 'prefix' => 'category'], function(){
        Route::get('/', [ExpenseCategoryController::class, 'index'])->name('index');
        Route::get('/get-category', [ExpenseCategoryController::class, 'getExpenseCategory'])->name('get-expenseCategory');
        Route::post('/store', [ExpenseCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ExpenseCategoryController::class, 'edit'])->name('edit');
        Route::post('/update', [ExpenseCategoryController::class, 'update'])->name('update');
        Route::any('/delete/{id}', [ExpenseCategoryController::class, 'destroy'])->name('delete');
    });

});