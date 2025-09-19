<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpensesItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('auth.login');});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//settings
Route::resource('units', UnitController::class);
Route::resource('categories', CategoryController::class);
Route::resource('branches', BranchController::class);
Route::resource('warehouses', WarehouseController::class);
Route::resource('expenses-items', ExpensesItemController::class);
