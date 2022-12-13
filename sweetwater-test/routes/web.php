<?php

use App\Http\Controllers\TaskOne;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TaskOne::class)->group(function (){
    Route::get('/task1','index')->name('task1');
});

Route::get('/task2', function () {
    return view('task2');
});
