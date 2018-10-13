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
use Illuminate\Support\Facades\DB;







Route::get('/', 'startPage@startPage');

Route::get('period/create', 'daysAndWeeks@createPeriod')->name('period.create');
Route::get('day/create', 'daysAndWeeks@createDays');
Route::get('invalidDay/create', 'daysAndWeeks@createInvalid')->name('invalid.create');
Route::get('invalidDay/update', 'daysAndWeeks@updateInvalid');

// Route::get('week/create', 'daysAndWeeks@createWeek');
// Route::get('week/{id}', 'daysAndWeeks@createWeek');
Route::get('weeks', 'daysAndWeeks@showWeeks')->name('weeks.all');
Route::get('weeks/{id}', 'daysAndWeeks@showOneWeek')->name('weeks.id');



Route::get('task/create', 'tasksAndHours@createTask')->name('task.create');
Route::get('generateTasks', 'tasksAndHours@generateTasks')->name('tasks.generate');
Route::get('task/update', 'tasksAndHours@addTask');

Route::get('taskHours/create', 'tasks@addTask');
