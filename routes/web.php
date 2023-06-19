<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('tasks')->controller(TaskController::class)->group(static function () {
    Route::get('/', 'index')->name('tasks.index');
    Route::get('/show/{task}', 'single')->name('tasks.show');
    Route::get('/create', 'create')->name('tasks.create');
    Route::post('/store', 'store')->name('tasks.store');
    Route::get('/edit/{task}', 'edit')->name('tasks.edit');
    Route::put('/update/{task}', 'update')->name('tasks.update');
    Route::delete('/delete/{task}', 'delete')->name('tasks.delete');
    Route::get('/search', 'search')->name('tasks.search');
    Route::put('/change-status/{task}', 'changeStatus')->name('tasks.change_status');
});
