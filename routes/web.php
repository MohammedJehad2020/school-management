<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Sections\SectionController;
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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['auth','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::post('Classrooms/Filter_Classes', 'ClassroomController@filter_classes');

        Route::get('/', function () {
            return view('dashboard');
        });

        Route::group(['namespace' => 'Grades'], function() {
            Route::resource('grades', 'GradeController');
        });
        

        Route::group(['namespace' => 'Classrooms'], function() {
            Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
            Route::post('Filter_Classes', [ClassroomController::class, 'filter_classes'])->name('Filter_Classes');
            Route::resource('classrooms', 'ClassroomController');
        });



        Route::group(['namespace' => 'Sections'], function() {
            Route::resource('sections', 'SectionController');
        });

    }
);


require __DIR__.'/auth.php';