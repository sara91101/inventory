<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpensesItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class,'showLoginForm'])->name('login');
Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => 'auth'],function()
{

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //settings
    Route::resource('units', UnitController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('expenseItems', ExpensesItemController::class);

    //items
    Route::resource('items', ItemController::class);
    Route::get('/itemBarcode', [ItemController::class, 'itemBarcode'])->name('itemBarcode');

    //suppliers
    Route::resource('suppliers', SupplierController::class);

    //customers
    Route::resource('customers', CustomerController::class);

    //expenses
    Route::resource('expenses', ExpenseController::class);
});

