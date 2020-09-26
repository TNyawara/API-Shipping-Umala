<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\showLocations;
use App\Http\Controllers\quoteController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[showLocations::class, 'welcome'])->name('welcome');
Route::post('/createLocation', [showLocations::class, 'createLocation'])->name('createLocation');
Route::post('/completeorder', [adminController::class, 'complete'])->name('completeOrder');
Route::middleware(['auth:sanctum', 'verified'])->get('/myorders', [orderController::class, 'index'])->name('myOrders');
Route::match(['get', 'post'],'/origin/{origin}/destination/{destination}',[showLocations::class, 'distance'])->name('calculateDistance');
Route::middleware(['auth:sanctum', 'verified'])->resource('orders', orderController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('quotes', quoteController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [adminController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/request',[showLocations::class, 'show'])->name('request');
