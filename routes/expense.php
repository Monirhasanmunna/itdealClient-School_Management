<?php

use App\Http\Controllers\Backend\Expense\ExpenseCategoryController;
use App\Http\Controllers\Backend\Expense\ExpenseSubCategoryController;
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

    Route::group(['as' => 'sub-category.', 'prefix' => 'sub-category'], function(){
        Route::get('/', [ExpenseSubCategoryController::class, 'index'])->name('index');
        Route::get('/get-sub-category', [ExpenseSubCategoryController::class, 'getExpenseSubCategory'])->name('get-expenseSubCategory');
        Route::post('/store', [ExpenseSubCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ExpenseSubCategoryController::class, 'edit'])->name('edit');
        Route::post('/update', [ExpenseSubCategoryController::class, 'update'])->name('update');
        Route::any('/delete/{id}', [ExpenseSubCategoryController::class, 'destroy'])->name('delete');
    });

});