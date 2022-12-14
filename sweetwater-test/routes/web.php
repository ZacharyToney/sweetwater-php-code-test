<?php

use App\Http\Controllers\TaskOne;
use App\Http\Controllers\TaskTwo;
use Illuminate\Support\Facades\Route;

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

Route::controller(TaskOne::class)->group(function (){
    Route::get('/','index')->name('task1');
    Route::get('/task1','index')->name('task1');
});

Route::controller(TaskTwo::class)->group(function (){
    Route::get('/task2','index')->name('task2');
});
