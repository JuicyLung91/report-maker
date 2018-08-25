<?php

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


Route::get('/', 'startPage@startPage');

Route::get('period/create', 'daysAndWeeks@createPeriod')->name('period.create');
Route::get('day/create', 'daysAndWeeks@createDays');
Route::get('invalidDay/create', 'daysAndWeeks@createInvalid')->name('invalid.create');
Route::get('invalidDay/update', 'daysAndWeeks@updateInvalid');

Route::get('week/create', 'daysAndWeeks@createWeek');
Route::get('week/{id}', 'daysAndWeeks@createWeek');

Route::get('task/create', 'tasks@createTask');
Route::get('task/update', 'tasks@addTask');

Route::get('taskHours/create', 'tasks@addTask');
